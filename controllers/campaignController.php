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
            header("Location: /front");    
        } catch (PDOException $e){
                echo "Virhe hahmoa päivitettäessä: " . $e->getMessage();
        }
    } else {
        header("Location: /front");
        exit;
    }
}

function deleteCampaignController(){
    try {
        if(isset($_GET["ID"])){
            $id = cleanUpInput($_GET["ID"]);
            deleteCampaign($id);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe kampanjaa poistettaessa: " . $e->getMessage();
    }



    header("Location: /front");
    exit;
}

function editCampaignController(){
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            $campaign = getAllCampaigns($id);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe hahmoa haettaessa: " . $e->getMessage();
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