<?php
require_once "../models/campaigns.php";
require_once "../models/character.php";
require_once "../models/users.php";
require_once "../libraries/cleaners.php";
function addCampaignController(){
    if(isset($_POST['name'], $_POST['notes'],)){
        $name = cleanUpInput($_POST['name']);
        $notes = cleanUpInput($_POST['notes']);               
        $gmaster = $_SESSION["user"];
        $_SESSION["message"] = "Campaign has been created!";
        if(strlen($name) > 1 || strlen($notes) > 1)  {
        addCampaign($name, $creator, $notes); 
        header("Location: /my-campaigns"); 
    }
    else {
        require "../views/add_campaign.php";
    }
    } else {
        require "../views/add_campaign.php";
    }
}


function updateCampaignController(){
    if(isset($_POST['name'], $_POST['notes'])){
        $name = cleanUpInput($_POST['name']);
        $notes = cleanUpInput($_POST['notes']);   
        $id = cleanUpInput($_POST['id']);
        try{
            updateCampaign($name, $notes, $id);
            $_SESSION["message"] = "Campaign has been updated!";
            header("Location: /my-campaigns");    
        } catch (PDOException $e){
                echo "Virhe kampanjaa päivitettäessä: " . $e->getMessage();
        }
    } else {
        header("Location: /my-campaigns");
        exit;
    }
}

function deleteCampaignController(){
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            $master = getAllCampaigns($id);
            if($master["Pelinjohtaja"] === $_SESSION["username"]) {
            deleteCampaign($id);
            $_SESSION["message"] = "Campaign has been deleted!";  
            }
            
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe kampanjaa poistettaessa: " . $e->getMessage();
    }



    header("Location: /my-campaigns");
    exit;
}

function editCampaignController(){
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            $campaign = getAllCampaigns($id);
        }
        if ($_SESSION["username"] !== $campaign["Pelinjohtaja"]){
            header("Location: /");
        }
    } catch (PDOException $e){
        echo "Virhe kampanjaa haettaessa: " . $e->getMessage();
    }
    if($campaign) {
        require "../views/edit_campaign.php";
    } else {
        header("Location: /");
        exit;
    }
}


function viewCampaignsController(){
    $id = $_SESSION["user_id"];
    $userinfo = getAllInfo($id); 
    $allowned = getAllOwnedCampaigns($userinfo['Kayttajanimi']);
    $alljoined = getAllJoinedCampaigns($userinfo['Kayttajanimi']);
    require "../views/my_campaign.php";
}

function viewCampaignController() {
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            $campaign = getAllCampaigns($id);
        }
        if ($_SESSION["username"] !== $campaign["Pelinjohtaja"] && (empty($campaign["Pelaajat"]) || !str_contains($campaign["Pelaajat"],$_SESSION["username"]))){
            header("Location: /");
        }
    } catch (PDOException $e){
        echo "Virhe kampanjaa haettaessa: " . $e->getMessage();
    }
    if($campaign) {
        $campaignCharacters = getCampaignCharacters($id);
        $availableCharacters = getAllOwnCharacters($_SESSION["username"]);
        
        // Get invitation data FIRST
        $pendingInvitations = getPendingInvitationsForCampaign($id);
        $acceptedInvitations = getAcceptedInvitationsForCampaign($id);
        
        $allUsers = getAllUsers();
        $invitedUsernames = array_map(function($inv) { return $inv["Vastaanottaja"]; }, $pendingInvitations);
        
        // Filter out current user and game master
        $availablePlayers = array_filter($allUsers, function($user) use ($campaign, $invitedUsernames) {
            // Filter out current user
            if ($user["Kayttajanimi"] === $_SESSION["username"]) {
                return false;
            }
            // Filter out game master
            if ($user["Kayttajanimi"] === $campaign["Pelinjohtaja"]) {
                return false;
            }
            // Filter out already in campaign
            if (!empty($campaign["Pelaajat"]) && str_contains($campaign["Pelaajat"], $user["Kayttajanimi"])) {
                return false;
            }
            // Filter out already invited
            if (in_array($user["Kayttajanimi"], $invitedUsernames)) {
                return false;
            }
            return true;
        });
        $availablePlayers = array_values($availablePlayers); // Re-index array
        
        // Get invitation data
        $pendingInvitations = getPendingInvitationsForCampaign($id);
        $acceptedInvitations = getAcceptedInvitationsForCampaign($id);
        
        require "../views/view_campaign.php";
    } else {
        header("Location: /");
        exit;
    }
}

function addCharacterToCampaignController() {
    if (
        !isset($_POST['campaign_id'], $_POST['character_id'])
    ) {
        http_response_code(400);
        echo json_encode([
            "error" => "Campaign ID and character ID are required"
        ]);
        exit;
    }

    $campaignId = cleanUpInput($_POST['campaign_id']);
    $characterId = cleanUpInput($_POST['character_id']);

    addCharacterToCampaign($campaignId, $characterId);

    header("Content-Type: application/json");

    $character = getAllCharacterInfo($characterId);

    echo json_encode([
        "success" => true,
        "character" => [
            "id" => $character["ID"],
            "name" => $character["Nimi"],
            "race" => $character["Rotu"],
            "className" => $character["Hahmoluokka"],
            "hp" => $character["Elamapisteet"],
            "mana" => $character["Magiapisteet"],
            "status" => $character["Status"]
        ]
    ]);

}

function removeCharacterFromCampaignController() {
    if (
        !isset($_POST['campaign_id'], $_POST['character_id'])
    ) {
        http_response_code(400);
        echo json_encode([
            "error" => "Campaign ID and character ID are required"
        ]);
        exit;
    }

    $campaignId = cleanUpInput($_POST['campaign_id']);
    $characterId = cleanUpInput($_POST['character_id']);

    removeCharacterFromCampaign($campaignId, $characterId);

    header("Content-Type: application/json");
    echo json_encode(["success" => true]);
}

function sendInvitationController() {
    if (!isset($_POST['player_id'], $_POST['campaign_id'])) {
        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Player ID and campaign ID are required"]);
        exit;
    }

    $playerId = cleanUpInput($_POST['player_id']);
    $campaignId = cleanUpInput($_POST['campaign_id']);

    try {
        // Get campaign info
        $campaign = getAllCampaigns($campaignId);
        
        // Verify current user is the game master
        if ($campaign["Pelinjohtaja"] !== $_SESSION["username"]) {
            http_response_code(403);
            header("Content-Type: application/json");
            echo json_encode(["error" => "Only the game master can send invitations"]);
            exit;
        }

        // Get recipient username from player ID
        $recipient = getUsername($playerId);
        if (!$recipient) {
            http_response_code(404);
            header("Content-Type: application/json");
            echo json_encode(["error" => "Player not found"]);
            exit;
        }
        $recipientUsername = $recipient['Kayttajanimi'];

        // Clean up any old invitations for this user/campaign combo
        // This handles the case where a player was invited, accepted, then removed
        deleteAllInvitationsForUserAndCampaign($recipientUsername, $campaignId);

        // Check if already invited
        if (checkIfAlreadyInvited($recipientUsername, $campaignId)) {
            http_response_code(400);
            header("Content-Type: application/json");
            echo json_encode(["error" => "Player already has a pending invitation for this campaign"]);
            exit;
        }

        // Check if already in campaign
        if (!empty($campaign["Pelaajat"]) && str_contains($campaign["Pelaajat"], $recipientUsername)) {
            http_response_code(400);
            header("Content-Type: application/json");
            echo json_encode(["error" => "Player is already in this campaign"]);
            exit;
        }

        // Send invitation
        sendInvite(
            $_SESSION["username"],
            $recipientUsername,
            $campaign["Nimi"],
            $campaignId
        );

        header("Content-Type: application/json");
        echo json_encode([
            "success" => true,
            "message" => "Invitation sent to " . htmlspecialchars($recipientUsername)
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
}

function cancelInvitationController() {
    if (!isset($_POST['invitation_id'])) {
        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Invitation ID is required"]);
        exit;
    }

    $invitationId = cleanUpInput($_POST['invitation_id']);

    try {
        // Get invitation to verify ownership
        $invitation = getInviteById($invitationId);
        
        if (!$invitation) {
            http_response_code(404);
            header("Content-Type: application/json");
            echo json_encode(["error" => "Invitation not found"]);
            exit;
        }

        // Verify current user is the game master
        $campaign = getAllCampaigns($invitation["Kampanjanid"]);
        if ($campaign["Pelinjohtaja"] !== $_SESSION["username"]) {
            http_response_code(403);
            header("Content-Type: application/json");
            echo json_encode(["error" => "Only the game master can cancel invitations"]);
            exit;
        }

        // Delete the invitation
        deleteInvitation($invitationId);

        header("Content-Type: application/json");
        echo json_encode(["success" => true, "message" => "Invitation canceled"]);
    } catch (PDOException $e) {
        http_response_code(500);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
}

function removePlayerFromCampaignController() {
    if (!isset($_POST['player_name'], $_POST['campaign_id'])) {
        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Player name and campaign ID are required"]);
        exit;
    }

    $playerName = cleanUpInput($_POST['player_name']);
    $campaignId = cleanUpInput($_POST['campaign_id']);

    try {
        $campaign = getAllCampaigns($campaignId);
        
        // Verify current user is the game master
        if ($campaign["Pelinjohtaja"] !== $_SESSION["username"]) {
            http_response_code(403);
            header("Content-Type: application/json");
            echo json_encode(["error" => "Only the game master can remove players"]);
            exit;
        }

        // Parse the player list and remove the player
        $playerList = array_map('trim', explode(',', $campaign["Pelaajat"]));
        $playerList = array_filter($playerList, function($p) use ($playerName) {
            return $p !== $playerName;
        });
        $updatedPlayerList = implode(', ', $playerList);

        // Update the campaign
        $pdo = connectDB();
        $sql = "UPDATE Kampanjat SET Pelaajat = ? WHERE ID = ?";
        $stm = $pdo->prepare($sql);
        $stm->execute([$updatedPlayerList ?: NULL, $campaignId]);

        header("Content-Type: application/json");
        echo json_encode(["success" => true, "message" => "Player removed from campaign"]);
    } catch (PDOException $e) {
        http_response_code(500);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
}

function InvitationController() {
    if (isset($_POST["accept"])) {
        $id = $_POST["accept"];
        $campaign = getInviteById($id);
        $success = addUserToCampaign($_SESSION["username"] ,$campaign["Kampanjanid"]);
        if($success) {
            deleteInvitation($id);
            $_SESSION["message"] = "You have joined the campaign!";
            header("Location: /my-campaigns");
        }

    }
    if (isset($_POST["decline"])) {
        $id = $_POST["decline"];
        deleteInvitation($id);
        header("Refresh: 0");
    }
require "../views/front.php";
}
