<?php
require_once "../models/character.php";
require_once "../libraries/cleaners.php";
function addCharacterController(){
    if(isset($_POST['name'],$_POST['race'], $_POST['class'], $_POST['notes'], $_POST['level'], $_POST['hp'], $_POST['mp'], $_POST['str'], $_POST['dex'], $_POST['int'], $_POST['chr'])){
        $name = cleanUpInput($_POST['name']);
        $race = cleanUpInput($_POST['race']);
        $class = cleanUpInput($_POST['class']);
        $notes = cleanUpInput($_POST['notes']);   
        $level = cleanUpInput($_POST['level']);  
        $hp = cleanUpInput($_POST['hp']);    
        $mp = cleanUpInput($_POST['mp']);   
        $str = cleanUpInput($_POST['str']);
        $dex = cleanUpInput($_POST['dex']);
        $int = cleanUpInput($_POST['int']);
        $chr = cleanUpInput($_POST['chr']);            
        $creator = $_SESSION["user"];
        if(strlen($name) > 1 || strlen($race) > 1 || strlen($class) > 1 || strlen($notes) > 1 || strlen($level) >= 1 || strlen($hp) >= 1 || strlen($mp) >= 1 || strlen($str) >= 1 || strlen($dex) >= 1 || strlen($int) >= 1 || strlen($chr) >= 1)  {
        addCharacter($name, $race, $class, $notes, $level, $hp, $mp, $str, $dex, $int, $chr, $creator); 
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


function updateCharacterController(){
    if(isset($_POST['name'],$_POST['race'], $_POST['class'], $_POST['notes'], $_POST['level'], $_POST['hp'], $_POST['mp'], $_POST['str'], $_POST['dex'], $_POST['int'], $_POST['chr'])){
        $name = cleanUpInput($_POST['name']);
        $race = cleanUpInput($_POST['race']);
        $class = cleanUpInput($_POST['class']);
        $notes = cleanUpInput($_POST['notes']);   
        $level = cleanUpInput($_POST['level']);  
        $hp = cleanUpInput($_POST['hp']);    
        $mp = cleanUpInput($_POST['mp']);   
        $str = cleanUpInput($_POST['str']);
        $dex = cleanUpInput($_POST['dex']);
        $int = cleanUpInput($_POST['int']);
        $chr = cleanUpInput($_POST['chr']);   
        $id = cleanUpInput($_POST['id']);

        try{
            updateCharacter($name, $race, $class, $notes, $level, $hp, $mp, $str, $dex, $int, $chr, $id);
            header("Location: /front");    
        } catch (PDOException $e){
                echo "Virhe hahmoa päivitettäessä: " . $e->getMessage();
        }
    } else {
        header("Location: /front");
        exit;
    }
}

function deleteCharacterController(){
    try {
        if(isset($_GET["ID"])){
            $id = cleanUpInput($_GET["ID"]);
            deleteCharacter($id);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe hahmoa poistettaessa: " . $e->getMessage();
    }

    $allCampaigns = getAllCampaigns();

    header("Location: /front");
    exit;
}

function editCharacterController(){
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