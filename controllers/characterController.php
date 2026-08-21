<?php
require_once "../models/character.php";
require_once "../libraries/cleaners.php";

$characterTypes = [

    'fighter' => [
        'name' => 'Fighter',
        'race' => 'Orc',
        'health' => 90,
        'mana' => 10,
        'strength' => 45,
        'constitution' => 35,
        'agility' => 10,
        'intelligence' => 5,
        'charisma' => 5
    ],

    'villain' => [
        'name' => 'Villain',
        'race' => 'Gnome',
        'health' => 50,
        'mana' => 50,
        'strength' => 15,
        'constitution' => 5,
        'agility' => 20,
        'intelligence' => 30,
        'charisma' => 30
    ],

    'mage' => [
        'name' => 'Mage',
        'race' => 'Human',
        'health' => 35,
        'mana' => 65,
        'strength' => 5,
        'constitution' => 10,
        'agility' => 10,
        'intelligence' => 40,
        'charisma' => 35
    ],

    'paladin' => [
        'name' => 'Paladin',
        'race' => 'Human',
        'health' => 60,
        'mana' => 40,
        'strength' => 30,
        'constitution' => 30,
        'agility' => 10,
        'intelligence' => 10,
        'charisma' => 20
    ],

    'bard' => [
        'name' => 'Bard',
        'race' => 'Dwarf',
        'health' => 50,
        'mana' => 50,

        'strength' => 15,
        'constitution' => 15,
        'agility' => 20,
        'intelligence' => 20,
        'charisma' => 30
    ],

    'priest' => [
        'name' => 'Priest',
        'race' => 'Human',
        'health' => 30,
        'mana' => 70,
        'strength' => 10,
        'constitution' => 10,
        'agility' => 10,
        'intelligence' => 40,
        'charisma' => 30
    ],

    'ranger' => [
        'name' => 'Ranger',
        'race' => 'Elf',
        'health' => 60,
        'mana' => 40,
        'strength' => 20,
        'constitution' => 15,
        'agility' => 43,
        'intelligence' => 15,
        'charisma' => 7
    ]

];

function addCharacterController()
{
    global $characterTypes;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['name'], $_POST['class'], $_POST['notes'])
        ) {
            $name = cleanUpInput($_POST['name']);
            $class = cleanUpInput($_POST['class']);
            $notes = cleanUpInput($_POST['notes']);

            if (!isset($characterTypes[$class])) {
                echo '<h1 class="centered">Invalid character class.</h1>';
                return;
            }

            $character = $characterTypes[$class];

            $race = $character['race'];
            $level = 1;

            $hp = $character['health'];
            $mp = $character['mana'];

            $str = $character['strength'];
            $con = $character['constitution'];
            $dex = $character['agility'];
            $int = $character['intelligence'];
            $chr = $character['charisma'];
            $creator = $_SESSION["username"];

            if (strlen($name) > 1) {
                addCharacter($name, $race, $class, $notes, $level, $hp, $mp, $str, $con, $dex, $int, $chr, $creator);
                header("Location: /");
                exit;
            } else {
                echo '<h1 class="centered">Please enter a character name.</h1>';
                require "../views/new_character.php";
            }
        }
    } else {
        require "../views/new_character.php";
    }
}

function updateCharacterController(){
    if(isset($_POST['name'],$_POST['race'], $_POST['class'], $_POST['notes'], $_POST['level'], $_POST['health'], $_POST['mana'], $_POST['strength'], $_POST['constitution'], $_POST['agility'], $_POST['intelligence'], $_POST['charisma'])){
        $notes = cleanUpInput($_POST['notes']);   
        $level = cleanUpInput($_POST['level']);  
        $hp = cleanUpInput($_POST['health']);    
        $mp = cleanUpInput($_POST['mana']);   
        $str = cleanUpInput($_POST['strength']);
        $con = cleanUpInput($_POST['constitution']);
        $dex = cleanUpInput($_POST['agility']);
        $int = cleanUpInput($_POST['intelligence']);
        $chr = cleanUpInput($_POST['charisma']);   
        $id = cleanUpInput($_POST['id']);

        try{
            updateCharacter($notes, $level, $hp, $mp, $str, $con, $dex, $int, $chr, $id);
            header("Location: /front");    
        } catch (PDOException $e){
                echo "Virhe hahmoa päivitettäessä: " . $e->getMessage();
        }
    } else {
        header("Location: /");
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

    header("Location: /");
    exit;
}

function editCharacterController(){
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            $character = getCharacterByIdEdit($id);
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
        $con = $character["Kestävyys"];
        $dex = $character["Ketteryys"];
        $int = $character["Älykkyys"];
        $chr = $character["Karisma"];
        require "../views/edit_character.php";
    } else {
        header("Location: /");
        exit;
    }
}