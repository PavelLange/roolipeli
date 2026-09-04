<?php
require_once "../models/campaigns.php";
require_once "../models/character.php";
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
        if ($_SESSION["username"] !== $campaign["Pelinjohtaja"] && !str_contains($campaign["Pelaajat"],$_SESSION["username"])){
            header("Location: /");
        }
    } catch (PDOException $e){
        echo "Virhe kampanjaa haettaessa: " . $e->getMessage();
    }
    if(isset($_POST["alive"])) {
        $id = $_POST["alive"];
        setDead($id);
        header("Refresh: 0");
    }
    if(isset($_POST["dead"])) {
        $id = $_POST["dead"];
        setAlive($id);
        header("Refresh: 0");
    }
    if($campaign) {
        $campaignCharacters = getCampaignCharacters($id);
        $availableCharacters = getAllOwnCharacters($_SESSION["username"]);
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
