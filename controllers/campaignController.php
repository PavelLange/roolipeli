<?php
require_once "../models/campaigns.php";
require_once "../models/character.php";
require_once "../libraries/cleaners.php";
function addCampaignController(){
    if(isset($_POST['name'], $_POST['notes'],)){
        $name = cleanUpInput($_POST['name']);
        $notes = cleanUpInput($_POST['notes']);               
        $gmaster = $_SESSION["user"];
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
    if($campaign) {
        require "../views/view_campaign.php";
    } else {
        header("Location: /");
        exit;
    }
}

function InvitationController() {
    if (isset($_POST["accept"])) {
        $id = $_POST["accept"];
        $campaign
        addUserToCampaign($_SESSION["username"] ,$id);
        

    }
require "../views/front.php";
}