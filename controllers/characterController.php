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

        if (isset($_POST['name'], $_POST['class'], $_POST['notes'])) {
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
                $_SESSION["message"] = "Character has been created!";
                header("Location: /my-characters");
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

function updateCharacterController()
{
    if (!isset(
        $_POST['id'],
        $_POST['notes'],
        $_POST['level']
    )) {
        header("Location: /my-characters");
        exit;
    }


    $id = cleanUpInput($_POST['id']);
    $notes = cleanUpInput($_POST['notes']);

    $newLevel = (int)$_POST['level'];

    if ($newLevel < 1) {

        echo '<h1 class="centered">
                Level cannot be below 1.
              </h1>';

        return;
    }

    try {

        $character = getCharacterByIdEdit($id);

        if (!$character) {
            header("Location: /my-characters");
            exit;
        }

        if ($character["Tekija"] !== $_SESSION["username"]) {
            header("Location: /my-characters");
            exit;
        }

        $currentLevel = (int)$character["Taso"];

        $newLevel = isset($_POST["level"])
            ? (int)$_POST["level"]
            : $currentLevel;


        if ($newLevel < $currentLevel) {

            echo '<h1 class="centered">
            Character level cannot be decreased after saving.
          </h1>';

            return;
        }


        $name = $character["Nimi"];

        $newHp = isset($_POST['health'])
            ? (int)$_POST['health']
            : (int)$character['Elamapisteet'];


        $newMp = isset($_POST['mana'])
            ? (int)$_POST['mana']
            : (int)$character['Magiapisteet'];


        $newStr = isset($_POST['strength'])
            ? (int)$_POST['strength']
            : (int)$character['Voima'];


        $newCon = isset($_POST['constitution'])
            ? (int)$_POST['constitution']
            : (int)$character['Kestavyys'];


        $newDex = isset($_POST['agility'])
            ? (int)$_POST['agility']
            : (int)$character['Ketteryys'];


        $newInt = isset($_POST['intelligence'])
            ? (int)$_POST['intelligence']
            : (int)$character['Alykkyys'];


        $newChr = isset($_POST['charisma'])
            ? (int)$_POST['charisma']
            : (int)$character['Karisma'];

        $stats = [

            'health' => [
                'old' => (int)$character['Elamapisteet'],
                'new' => $newHp
            ],

            'mana' => [
                'old' => (int)$character['Magiapisteet'],
                'new' => $newMp
            ],

            'strength' => [
                'old' => (int)$character['Voima'],
                'new' => $newStr
            ],

            'constitution' => [
                'old' => (int)$character['Kestavyys'],
                'new' => $newCon
            ],

            'agility' => [
                'old' => (int)$character['Ketteryys'],
                'new' => $newDex
            ],

            'intelligence' => [
                'old' => (int)$character['Alykkyys'],
                'new' => $newInt
            ],

            'charisma' => [
                'old' => (int)$character['Karisma'],
                'new' => $newChr
            ]

        ];

        foreach ($stats as $stat) {

            if ($stat['new'] < 0 || $stat['new'] > 100) {

                echo '<h1 class="centered">
                        Stats must be between 0 and 100.
                      </h1>';

                return;
            }
        }

        $totalDecrease = 0;
        $totalIncrease = 0;


        foreach ($stats as $stat) {

            $difference =
                $stat['new'] - $stat['old'];


            if ($difference < 0) {

                $totalDecrease += abs($difference);
            } elseif ($difference > 0) {

                $totalIncrease += $difference;
            }
        }

        if ($totalDecrease > 5) {

            echo '<h1 class="centered">
                    You can transfer a maximum of 5 stat points.
                  </h1>';

            return;
        }

        updateCharacter(
            $name,
            $notes,
            $newLevel,
            $newHp,
            $newMp,
            $newStr,
            $newCon,
            $newDex,
            $newInt,
            $newChr,
            $id
        );


        $_SESSION["message"] =
            "Character has been updated!";


        header("Location: /my-characters");
        exit;
    } catch (PDOException $e) {

        echo "Virhe hahmoa päivitettäessä: "
            . $e->getMessage();
    }
}


function deleteCharacterController()
{
    if (!isset($_GET["id"])) {
        header("Location: /my-characters");
        exit;
    }

    try {
        $id = cleanUpInput($_GET["id"]);

        deleteCharacter($id);
        $_SESSION["message"] = "Character has been deleted!";
        header("Location: /my-characters");
        exit;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function editCharacterController()
{
    try {

        if (!isset($_GET["id"])) {
            header("Location: /my-characters");
            exit;
        }

        $id = cleanUpInput($_GET["id"]);

        $character = getCharacterByIdEdit($id);

        if (!$character) {
            header("Location: /my-characters");
            exit;
        }

        if ($character["Tekija"] !== $_SESSION["username"]) {
            header("Location: /my-characters");
            exit;
        }

        require "../views/edit_character.php";
    } catch (PDOException $e) {
        echo "Virhe hahmoa haettaessa: " . $e->getMessage();
    }
}

function myCharacterController()
{
    if (!isLoggedIn()) {
        header("Location: /login");
        exit;
    }

    try {

        $username = $_SESSION["username"];

        $characters = getAllOwnCharacters($username);

        $totalCharacters = count($characters);

        $highestLevel = 0;
        $totalHp = 0;

        foreach ($characters as $character) {

            $level = (int)$character["Taso"];
            $hp = (int)$character["Elamapisteet"];

            if ($level > $highestLevel) {
                $highestLevel = $level;
            }

            $totalHp += $hp;
        }

        require "../views/my_characters.php";
    } catch (PDOException $e) {

        echo "Error loading characters: " . $e->getMessage();
        exit;
    }
}

function viewCharacterController()
{
    if (!isLoggedIn()) {
        header("Location: /login");
        exit;
    }

    if (!isset($_GET["id"])) {
        header("Location: /my-characters");
        exit;
    }

    try {

        $id = cleanUpInput($_GET["id"]);

        $character = getCharacterByIdEdit($id);

        if (!$character) {
            header("Location: /my-characters");
            exit;
        }

        if ($character["Tekija"] !== $_SESSION["username"]) {
            header("Location: /my-characters");
            exit;
        }

        require "../views/view_character.php";

    } catch (PDOException $e) {

        echo "Error loading character: " . $e->getMessage();
        exit;
    }
}