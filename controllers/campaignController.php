<?php
require_once "../models/character.php";
require_once "../libraries/cleaners.php";
function addCampaignController(){
    if(isset($_POST['name'], $_POST['notes'],)){
        $name = cleanUpInput($_POST['name']);
        $notes = cleanUpInput($_POST['notes']);               
        $gmaster = $_SESSION["user"];
        if(strlen($name) > 1 || strlen($notes) > 1)  {
        addCharacter($name, $notes, $creator); 
        header("Location: /front.php"); 
    }
    else {
        echo '<h1 class="centered">Täytä kohtiin enemmän tietoa!</h1>';
        require "../views/new_character.php";
    }
    } else {
        require "../views/new_character.php";
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
            $character = getRecipeByIdEdit($id);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe hahmoa haettaessa: " . $e->getMessage();
    }
    if($character){
        $id = $character["ID"];
        $name = $character["Nimi"];
        $race = $character["Rotu"];
        $class = $character["Hahmoluokka"];
        $notes = $character["Muistiinpanot"];
        $level = $character["Taso"];
        $hp = $character["Elämäpisteet"];
        $mp = $character["Magiapisteet"];
        $str = $character["Voima"];
        $dex = $character["Ketteryys"];
        $int = $character["Älykkyys"];
        $chr = $character["Karisma"];
        require "../views/edit_character.php";
    } else {
        header("Location: /");
        exit;
    }
}