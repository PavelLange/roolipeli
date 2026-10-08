<?php
require_once "../models/character.php";
require_once "../models/campaigns.php";
require_once "../libraries/cleaners.php";
require_once "../libraries/cleaners.php";
require_once "../libraries/auth.php";

$characterTypes = [

    'fighter' => [
        'name' => 'Fighter',
        'race' => 'Orc'
    ],

    'villain' => [
        'name' => 'Villain',
        'race' => 'Gnome'
    ],

    'mage' => [
        'name' => 'Mage',
        'race' => 'Human'
    ],

    'paladin' => [
        'name' => 'Paladin',
        'race' => 'Human'
    ],

    'bard' => [
        'name' => 'Bard',
        'race' => 'Dwarf'
    ],

    'priest' => [
        'name' => 'Priest',
        'race' => 'Human'
    ],

    'ranger' => [
        'name' => 'Ranger',
        'race' => 'Elf'
    ]

];

function addCharacterController()
{
    /*
     * =========================================
     * ONLY POST REQUESTS
     * =========================================
     */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        require "../views/new_character.php";
        return;
    }

    /*
     * =========================================
     * LOGIN CHECK
     * =========================================
     */

    if (!isLoggedIn()) {

        header("Location: /login");
        exit;
    }


    /*
     * =========================================
     * REQUIRED FIELDS
     * =========================================
     */

    $requiredFields = [
        'name',
        'race',
        'class',
        'notes',
        'health',
        'mana',
        'strength',
        'constitution',
        'agility',
        'intelligence',
        'charisma',
        'avatar_type'
    ];


    foreach ($requiredFields as $field) {

        if (!isset($_POST[$field])) {

            echo '<h1 class="centered">
                    Missing required character data.
                  </h1>';

            return;
        }
    }


    /*
     * =========================================
     * CLEAN BASIC INPUT
     * =========================================
     */

    $name = cleanUpInput($_POST['name'], LIMIT_NAME);
    $race = cleanUpInput($_POST['race'], LIMIT_SHORT);
    $class = cleanUpInput($_POST['class'], LIMIT_SHORT);
    $notes = cleanUpInput($_POST['notes'], LIMIT_NOTES);


    /*
     * =========================================
     * NAME VALIDATION
     * =========================================
     */

    if ($name === '') {

        echo '<h1 class="centered">
                Please enter a character name.
              </h1>';

        return;
    }


    if (strlen($name) < 2) {

        echo '<h1 class="centered">
                Character name must be at least 2 characters.
              </h1>';

        return;
    }


    if (strlen($name) > 30) {

        echo '<h1 class="centered">
                Character name cannot be longer than 30 characters.
              </h1>';

        return;
    }


    /*
     * =========================================
     * ALLOWED RACES
     * =========================================
     */

    $allowedRaces = [
        'Human',
        'Orc',
        'Elf',
        'Dwarf',
        'Gnome'
    ];


    if (!in_array($race, $allowedRaces, true)) {

        echo '<h1 class="centered">
                Invalid race.
              </h1>';

        return;
    }


    /*
     * =========================================
     * ALLOWED CLASSES
     * =========================================
     */

    $allowedClasses = [
        'fighter',
        'villain',
        'mage',
        'paladin',
        'bard',
        'priest',
        'ranger'
    ];


    if (!in_array($class, $allowedClasses, true)) {

        echo '<h1 class="centered">
                Invalid class.
              </h1>';

        return;
    }


    /*
     * =========================================
     * ABILITY STATS
     * =========================================
     */

    $statFields = [
        'health',
        'mana',
        'strength',
        'constitution',
        'agility',
        'intelligence',
        'charisma'
    ];


    $stats = [];


    foreach ($statFields as $field) {

        /*
         * Must exist
         */

        if (!isset($_POST[$field])) {

            echo '<h1 class="centered">
                    Missing ability value.
                  </h1>';

            return;
        }


        /*
         * Must be an integer
         */

        $value = filter_var(
            $_POST[$field],
            FILTER_VALIDATE_INT
        );


        if ($value === false) {

            echo '<h1 class="centered">
                    Invalid ability value.
                  </h1>';

            return;
        }


        /*
         * Allowed range
         */

        if ($value < 10 || $value > 40) {

            echo '<h1 class="centered">
                    Ability values must be between 10 and 40.
                  </h1>';

            return;
        }


        $stats[$field] = $value;
    }


    /*
     * =========================================
     * EXACTLY 30 ABILITY POINTS
     * =========================================
     */

    $totalAbilityPoints = 0;


    foreach ($stats as $value) {

        $totalAbilityPoints +=
            ($value - 10);
    }


    if ($totalAbilityPoints !== 30) {

        echo '<h1 class="centered">
                You must spend exactly 30 ability points.
              </h1>';

        return;
    }


    /*
     * =========================================
     * CHARACTER STATS
     * =========================================
     */

    $hp = $stats['health'];
    $hpmax = $hp;

    $mp = $stats['mana'];
    $mpmax = $mp;

    $str = $stats['strength'];
    $con = $stats['constitution'];
    $dex = $stats['agility'];
    $int = $stats['intelligence'];
    $chr = $stats['charisma'];


    /*
     * =========================================
     * CREATOR
     * =========================================
     */

    $creator =
        $_SESSION['username'];


    /*
     * =========================================
     * AVATAR
     * =========================================
     */

    $avatar = "";


    $avatarType =
        cleanUpInput($_POST['avatar_type']);


    /*
     * =========================================
     * ALLOWED LIBRARY AVATARS
     * =========================================
     */

    $allowedLibraryAvatars = [

        "images/fighter.jpg",
        "images/villain.jpg",
        "images/mage.jpg",
        "images/paladin.jpg",
        "images/bard.jpg",
        "images/priest.jpg",
        "images/ranger.jpg",
        "images/orc.jpg",
        "images/dwarf.jpg",
        "images/gnome.jpg"

    ];


    /*
     * =========================================
     * LIBRARY AVATAR
     * =========================================
     */

    if ($avatarType === 'library') {

        if (
            !isset($_POST['avatar']) ||
            $_POST['avatar'] === ''
        ) {

            echo '<h1 class="centered">
                    Please select an avatar.
                  </h1>';

            return;
        }


        $selectedAvatar =
            str_replace(
                "\\",
                "/",
                $_POST['avatar']
            );


        $selectedAvatar =
            ltrim(
                $selectedAvatar,
                "/"
            );


        /*
         * Only allow avatars from whitelist
         */

        if (
            !in_array(
                $selectedAvatar,
                $allowedLibraryAvatars,
                true
            )
        ) {

            echo '<h1 class="centered">
                    Invalid avatar selection.
                  </h1>';

            return;
        }


        /*
         * Check that the file really exists
         */

        $fullPath =
            realpath(
                $_SERVER['DOCUMENT_ROOT']
                    . "/"
                    . $selectedAvatar
            );


        if (
            $fullPath === false ||
            !is_file($fullPath)
        ) {

            echo '<h1 class="centered">
                    Selected avatar does not exist.
                  </h1>';

            return;
        }


        $avatar =
            $selectedAvatar;
    }


    /*
     * =========================================
     * CUSTOM UPLOAD
     * =========================================
     */ elseif ($avatarType === 'upload') {

        /*
         * File must exist
         */

        if (
            !isset($_FILES['custom_avatar'])
        ) {

            echo '<h1 class="centered">
                    Please upload an avatar.
                  </h1>';

            return;
        }


        $file =
            $_FILES['custom_avatar'];


        /*
         * Upload must be successful
         */

        if (
            $file['error'] !== UPLOAD_ERR_OK
        ) {

            echo '<h1 class="centered">
                    Avatar upload failed.
                  </h1>';

            return;
        }


        /*
         * Maximum 5 MB
         */

        if (
            $file['size'] <= 0 ||
            $file['size'] > 5 * 1024 * 1024
        ) {

            echo '<h1 class="centered">
                    Avatar must be smaller than 5 MB.
                  </h1>';

            return;
        }


        /*
         * Allowed MIME types
         */

        $allowedTypes = [

            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp'

        ];


        /*
         * Detect real MIME type
         */

        $finfo =
            finfo_open(
                FILEINFO_MIME_TYPE
            );


        if ($finfo === false) {

            echo '<h1 class="centered">
                    Could not validate uploaded image.
                  </h1>';

            return;
        }


        $mimeType =
            finfo_file(
                $finfo,
                $file['tmp_name']
            );


        finfo_close($finfo);


        /*
         * MIME must be allowed
         */

        if (
            !isset(
                $allowedTypes[$mimeType]
            )
        ) {

            echo '<h1 class="centered">
                    Only JPG, PNG or WEBP images are allowed.
                  </h1>';

            return;
        }


        /*
         * Make sure it is actually an image
         */

        if (
            getimagesize(
                $file['tmp_name']
            ) === false
        ) {

            echo '<h1 class="centered">
                    Uploaded file is not a valid image.
                  </h1>';

            return;
        }


        /*
         * Generate random filename
         */

        try {

            $filename =
                bin2hex(
                    random_bytes(16)
                )
                . "."
                . $allowedTypes[$mimeType];
        } catch (Exception $e) {

            echo '<h1 class="centered">
                    Could not generate avatar filename.
                  </h1>';

            return;
        }


        /*
         * Upload directory
         */

        $uploadDirectory =
            $_SERVER['DOCUMENT_ROOT']
            . "/uploads/avatars/";


        /*
         * Create directory if needed
         */

        if (
            !is_dir(
                $uploadDirectory
            )
        ) {

            if (
                !mkdir(
                    $uploadDirectory,
                    0755,
                    true
                )
            ) {

                echo '<h1 class="centered">
                        Could not create upload directory.
                      </h1>';

                return;
            }
        }


        /*
         * Destination
         */

        $destination =
            $uploadDirectory
            . $filename;


        /*
         * Move uploaded file
         */

        if (
            !move_uploaded_file(
                $file['tmp_name'],
                $destination
            )
        ) {

            echo '<h1 class="centered">
                    Could not save uploaded avatar.
                  </h1>';

            return;
        }


        $avatar =
            "uploads/avatars/"
            . $filename;
    }


    /*
     * =========================================
     * INVALID AVATAR TYPE
     * =========================================
     */ else {

        echo '<h1 class="centered">
                Please select an avatar.
              </h1>';

        return;
    }


    /*
     * =========================================
     * FINAL AVATAR CHECK
     * =========================================
     */

    if ($avatar === '') {

        echo '<h1 class="centered">
                Please select an avatar.
              </h1>';

        return;
    }


    /*
     * =========================================
     * CREATE CHARACTER
     * =========================================
     */

    // Consumed here rather than at the top of the function, so that a
    // validation failure above does not use up the token and leave the
    // user unable to resubmit after going back.
    if (!useFormToken("new_character")) {
        header("Location: /my-characters");
        exit;
    }

    try {

        addCharacter(
            $name,
            $race,
            $class,
            $notes,
            1,
            $hp,
            $hpmax,
            $mp,
            $mpmax,
            $str,
            $con,
            $dex,
            $int,
            $chr,
            $creator,
            $avatar
        );


        $_SESSION["message"] =
            "Character has been created!";


        header(
            "Location: /my-characters"
        );

        exit;
    } catch (PDOException $e) {

        /*
         * Do not show database errors
         * to the user.
         */

        error_log(
            "Character creation error: "
                . $e->getMessage()
        );


        echo '<h1 class="centered">
                Character could not be created.
              </h1>';

        return;
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
    $notes = cleanUpInput($_POST['notes'], LIMIT_NOTES);

    $newLevel = cleanUpNumber($_POST['level'], LIMIT_LEVEL);

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
            ? cleanUpNumber($_POST["level"], LIMIT_LEVEL)
            : $currentLevel;


        if ($newLevel < $currentLevel) {

            echo '<h1 class="centered">
            Character level cannot be decreased after saving.
          </h1>';

            return;
        }


        $name = $character["Nimi"];

        $newHp = isset($_POST['health'])
            ? cleanUpNumber($_POST['health'], LIMIT_POINTS)
            : (int)$character['Elamamax'];

        $newMp = isset($_POST['mana'])
            ? cleanUpNumber($_POST['mana'], LIMIT_POINTS)
            : (int)$character['Magiamax'];

        $newStr = isset($_POST['strength'])
            ? cleanUpNumber($_POST['strength'], LIMIT_STAT)
            : (int)$character['Voima'];


        $newCon = isset($_POST['constitution'])
            ? cleanUpNumber($_POST['constitution'], LIMIT_STAT)
            : (int)$character['Kestavyys'];


        $newDex = isset($_POST['agility'])
            ? cleanUpNumber($_POST['agility'], LIMIT_STAT)
            : (int)$character['Ketteryys'];


        $newInt = isset($_POST['intelligence'])
            ? cleanUpNumber($_POST['intelligence'], LIMIT_STAT)
            : (int)$character['Alykkyys'];


        $newChr = isset($_POST['charisma'])
            ? cleanUpNumber($_POST['charisma'], LIMIT_STAT)
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

        /*
 * =========================================
 * AVATAR
 * =========================================
 */

        $avatar =
            $character["Avatar"] ?? "";


        /*
* Portrait library
*/

        if (
            isset($_POST["avatar_type"]) &&
            $_POST["avatar_type"] === "library" &&
            !empty($_POST["avatar"])
        ) {

            $selectedAvatar =
                str_replace(
                    "\\",
                    "/",
                    $_POST["avatar"]
                );

            $selectedAvatar =
                ltrim(
                    $selectedAvatar,
                    "/"
                );


            $allowedLibraryAvatars = [

                "images/fighter.jpg",
                "images/villain.jpg",
                "images/mage.jpg",
                "images/paladin.jpg",
                "images/bard.jpg",
                "images/priest.jpg",
                "images/ranger.jpg",
                "images/orc.jpg",
                "images/dwarf.jpg",
                "images/gnome.jpg"

            ];


            if (
                in_array(
                    $selectedAvatar,
                    $allowedLibraryAvatars,
                    true
                )
            ) {

                $fullPath =
                    realpath(
                        $_SERVER["DOCUMENT_ROOT"]
                            . "/"
                            . $selectedAvatar
                    );


                if (
                    $fullPath !== false &&
                    is_file($fullPath)
                ) {

                    $avatar =
                        $selectedAvatar;
                }
            }
        }


        /*
* Custom upload
*/

        if (
            isset($_POST["avatar_type"]) &&
            $_POST["avatar_type"] === "upload" &&
            isset($_FILES["custom_avatar"]) &&
            $_FILES["custom_avatar"]["error"]
            === UPLOAD_ERR_OK
        ) {

            $file =
                $_FILES["custom_avatar"];


            $allowedTypes = [

                "image/jpeg" => "jpg",
                "image/png" => "png",
                "image/webp" => "webp"

            ];


            $finfo =
                finfo_open(
                    FILEINFO_MIME_TYPE
                );


            $mimeType =
                finfo_file(
                    $finfo,
                    $file["tmp_name"]
                );


            finfo_close($finfo);


            if (
                isset(
                    $allowedTypes[$mimeType]
                ) &&
                $file["size"] <= 5 * 1024 * 1024
            ) {

                $extension =
                    $allowedTypes[$mimeType];


                $filename =
                    bin2hex(
                        random_bytes(16)
                    )
                    . "."
                    . $extension;


                $uploadDirectory =
                    $_SERVER["DOCUMENT_ROOT"]
                    . "/uploads/avatars/";


                if (
                    !is_dir(
                        $uploadDirectory
                    )
                ) {

                    mkdir(
                        $uploadDirectory,
                        0755,
                        true
                    );
                }


                $destination =
                    $uploadDirectory
                    . $filename;


                if (
                    move_uploaded_file(
                        $file["tmp_name"],
                        $destination
                    )
                ) {

                    $avatar =
                        "uploads/avatars/"
                        . $filename;
                }
            }
        }


        foreach ($stats as $statName => $stat) {

            $maxValue = ($statName === 'health' || $statName === 'mana')
                ? 1000
                : 100;

            if ($stat['new'] < 0 || $stat['new'] > $maxValue) {

                echo '<h1 class="centered">
                        Invalid stat value.
                      </h1>';

                return;
            }
        }

        $totalDecrease = 0;
        $totalIncrease = 0;


        foreach ($stats as $statName => $stat) {

            $difference =
                $stat['new'] - $stat['old'];


            if ($difference < 0) {

                $decrease =
                    abs($difference);


                // Health and Magic can be decreased by 50 points.
                // Other stats can be decreased by 5 points.
                $maxDecrease =
                    ($statName === 'health' || $statName === 'mana')
                    ? 50
                    : 5;


                if ($decrease > $maxDecrease) {

                    echo '<h1 class="centered">
                    Invalid stat change.
                  </h1>';

                    return;
                }


                $totalDecrease += $decrease;
            } elseif ($difference > 0) {

                $totalIncrease += $difference;
            }
        }


        $hp = $newHp;
        $mp = $newMp;
        updateCharacter(
            $name,
            $notes,
            $newLevel,
            $hp,
            $newHp,
            $mp,
            $newMp,
            $newStr,
            $newCon,
            $newDex,
            $newInt,
            $newChr,
            $avatar,
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

function addItemController()
{
    if (isset($_POST["name"], $_POST["desc"], $_POST["amount"])) {
        $campaignid = cleanUpInput($_GET["id"]);

        // A repeated submit carries an already-used token; drop it.
        if (!useFormToken("new_item")) {
            header("Location: /view-items?id=$campaignid");
            exit;
        }

        $name = cleanUpInput($_POST["name"], LIMIT_NAME);
        $desc = cleanUpInput($_POST["desc"], LIMIT_NOTES);
        $amount = cleanUpNumber($_POST["amount"], LIMIT_AMOUNT);
        $ownerid = cleanUpInput($_POST["owner"]);
        try {
            addItem($ownerid, $campaignid, $name, $amount, $desc);
            $_SESSION["message"] = "Item has been added!";
            header("Location:view-campaign?id=$campaignid");
        } catch (PDOException $e) {
            echo "Error adding item: " . $e->getMessage();
            exit;
        }
    }
    require "../views/new_item.php";
}
function viewItemController()
{
    $campaignid = cleanUpInput($_GET["id"]);
    $allItems = listAllCharactersItems($campaignid);
    require "../views/view_items.php";
}

function editItemController()
{
    if (isset($_SESSION["username"])) {
        $cid = $_GET["cid"];
        $id = $_GET["id"];
        $user = $_SESSION["username"];
        if (isInCampaign($cid, $user) == true) {
            $iteminfo = getItemByIdEdit($id);
            $campaignchars = getCampaignCharacters($cid);
            require "../views/edit_item.php";
        } else {
            header("Location:/");
        }
    } else {
        header("Location:/login");
    }
}
function updateItemController()
{
    if (isset($_POST["name"], $_POST["desc"], $_POST["amount"])) {
        $name = cleanUpInput($_POST["name"], LIMIT_NAME);
        $desc = cleanUpInput($_POST["desc"], LIMIT_NOTES);
        $amount = cleanUpNumber($_POST["amount"], LIMIT_AMOUNT);
        $ownerid = cleanUpInput($_POST["owner"]);
        $id = $_GET["id"];
        $cid = $_GET["cid"];
        try {
            updateItem($ownerid, $name, $amount, $desc, $id);
            $_SESSION["message"] = "Item has been updated!";
            header("Location: /view-items?id=$cid");
        } catch (PDOException $e) {
            echo "Error updating item: " . $e->getMessage();
            exit;
        }
    }
}


function deleteItemController()
{
    if (!isset($_GET["id"], $_GET["cid"])) {
        exit;
    }
    try {
        $id = cleanUpInput($_GET["id"]);
        $cid = cleanUpInput($_GET["cid"]);
        $user = $_SESSION["username"];
        if (isInCampaign($cid, $user) == true) {
            deleteItem($id);
            $_SESSION["message"] = "Item has been deleted!";
            header("Location: /view-items?id=" . $cid);
            exit;
        } else {
            header("Location: /");
        }
    } catch (PDOException $e) {
        echo "Virhe esinetta poistettaessa: " . $e->getMessage();
    }
}

function manageCharacterController()
{
    $id = $_GET["id"];
    $cid = $_GET["cid"];
    $character = getAllCharacterInfo($id);
    if (isset($_POST["hpamount"], $_POST["mpamount"], $_POST["charstatus"])) {
        $hp = cleanUpNumber($_POST["hpamount"], LIMIT_POINTS);
        $mp = cleanUpNumber($_POST["mpamount"], LIMIT_POINTS);
        $status = cleanUpInput($_POST["charstatus"], LIMIT_SHORT);

        try {
            manageCharacter($hp, $mp, $status ,$id);
            $_SESSION["message"] = "Character has been updated!";
            header("Location: /view-campaign?id=$cid");
        } catch (PDOException $e) {
            echo "Error updating character: " . $e->getMessage();
            exit;
        }
    }
    require "../views/manage_character.php";
}

function addNPCController()
{
    if (isset($_POST["name"], $_POST["desc"], $_POST["level"], $_POST["health"], $_POST["mana"], $_POST["str"], $_POST["const"], $_POST["agility"], $_POST["int"], $_POST["char"], $_POST["type"])) {
        $id = cleanUpInput($_GET["id"]);

        // A repeated submit carries an already-used token; drop it.
        if (!useFormToken("new_NPC")) {
            header("Location: /view-NPCs?id=$id");
            exit;
        }

        $name = cleanUpInput($_POST["name"], LIMIT_NAME);
        $desc = cleanUpInput($_POST["desc"], LIMIT_NOTES);
        $lvl = cleanUpNumber($_POST["level"], LIMIT_LEVEL);
        $hp = cleanUpNumber($_POST["health"], LIMIT_POINTS);
        $hpmax = $hp;
        $mp = cleanUpNumber($_POST["mana"], LIMIT_POINTS);
        $mpmax = $mp;
        $str = cleanUpNumber($_POST["str"], LIMIT_STAT);
        $const = cleanUpNumber($_POST["const"], LIMIT_STAT);
        $agility = cleanUpNumber($_POST["agility"], LIMIT_STAT);
        $int = cleanUpNumber($_POST["int"], LIMIT_STAT);
        $char = cleanUpNumber($_POST["char"], LIMIT_STAT);
        $type = cleanUpInput($_POST["type"], LIMIT_SHORT);

        try {
            addNPC($id, $name, $desc, $lvl, $hp, $hpmax, $mp, $mpmax, $str, $const, $agility, $int, $char, $type);
            $_SESSION["message"] = "NPC has been created!";
            header("Location: /view-campaign?id=$id");
        } catch (PDOException $e) {
            echo "Error adding NPC: " . $e->getMessage();
            exit;
        }
    }
    require "../views/new_NPC.php";
}

function viewNPCController()
{
    $campaignid = cleanUpInput($_GET["id"]);
    $allNPCs = listAllNPCs($campaignid);
    require "../views/view_NPCs.php";
}
function editNPCController()
{
    $id = $_GET["id"];
    $npcinfo = listAllNPCsID($id);
    require "../views/edit_NPC.php";
}

function updateNPCController()
{
    if (isset($_POST["name"], $_POST["desc"], $_POST["level"], $_POST["health"], $_POST["mana"], $_POST["str"], $_POST["const"], $_POST["agility"], $_POST["int"], $_POST["char"], $_POST["type"])) {
        $id = cleanUpInput($_GET["id"]);
        $cid = cleanUPInput($_GET["cid"]);
        $name = cleanUpInput($_POST["name"], LIMIT_NAME);
        $desc = cleanUpInput($_POST["desc"], LIMIT_NOTES);
        $lvl = cleanUpNumber($_POST["level"], LIMIT_LEVEL);
        $hp = cleanUpNumber($_POST["health"], LIMIT_POINTS);
        $hpmax = $hp;
        $mp = cleanUpNumber($_POST["mana"], LIMIT_POINTS);
        $mpmax = $mp;
        $str = cleanUpNumber($_POST["str"], LIMIT_STAT);
        $const = cleanUpNumber($_POST["const"], LIMIT_STAT);
        $agility = cleanUpNumber($_POST["agility"], LIMIT_STAT);
        $int = cleanUpNumber($_POST["int"], LIMIT_STAT);
        $char = cleanUpNumber($_POST["char"], LIMIT_STAT);
        $type = cleanUpInput($_POST["type"], LIMIT_SHORT);
        try {
            updateNPC($name, $desc, $lvl, $hp, $hpmax, $mp, $mpmax, $str, $const, $agility, $int, $char, $type, $id);
            $_SESSION["message"] = "NPC has been updated!";
            header("Location: /view-NPCs?id=$cid");
        } catch (PDOException $e) {
            echo "Error updating NPC: " . $e->getMessage();
            exit;
        }
    }
}

function manageNPCController()
{
    $id = $_GET["id"];
    $cid = $_GET["cid"];
    $npc = listAllNPCsID($id);
    if (isset($_POST["hpamount"], $_POST["mpamount"])) {
        $hp = cleanUpNumber($_POST["hpamount"], LIMIT_POINTS);
        $mp = cleanUpNumber($_POST["mpamount"], LIMIT_POINTS);
        try {
            manageNPC($hp, $mp, $id);
            $_SESSION["message"] = "NPC has been updated!";
            header("Location: /view-NPCs?id=$cid");
        } catch (PDOException $e) {
            echo "Error updating NPC: " . $e->getMessage();
            exit;
        }
    }
    require "../views/manage_NPC.php";
}

function deleteNPCController()
{
    if (!isset($_GET["id"], $_GET["cid"])) {
        exit;
    }
    try {
        $id = cleanUpInput($_GET["id"]);
        $cid = cleanUpInput($_GET["cid"]);
        $user = $_SESSION["username"];
        if (isInCampaign($cid, $user) == true) {
            deleteNPC($id);
            $_SESSION["message"] = "Item has been deleted!";
            header("Location: /view-NPCs?id=$cid");
            exit;
        } else {
            header("Location: /");
        }
    } catch (PDOException $e) {
        echo "Virhe esinetta poistettaessa: " . $e->getMessage();
    }
}

function deleteAllCharactersController(){
    if (!useFormToken("delete_all_characters")) {
        header("Location: /my-characters");
        exit;
    }

    try {
        $count = deleteAllOwnCharacters($_SESSION["username"]);

        $_SESSION["message"] = $count === 0
            ? "You had no characters to delete."
            : $count . " character(s) deleted.";
    } catch (PDOException $e) {
        $_SESSION["message"] = "The characters could not be deleted. Please try again.";
    }

    header("Location: /my-characters");
    exit;
}
