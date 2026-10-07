<?php

function cleanDump($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

/*
 * Maximum lengths for user-typed text.
 *
 * The database runs in STRICT_TRANS_TABLES mode, which means MySQL
 * REJECTS a value that is too long for its column instead of quietly
 * cutting it. An over-long name therefore throws a PDOException and
 * shows the user an error page. Cutting the value here keeps that from
 * ever reaching the database.
 *
 * Every limit below is at or under the real column size, listed next
 * to it, so there is room to spare.
 */
const LIMIT_USERNAME = 30;     // Kayttajat.Kayttajanimi   varchar(100)
const LIMIT_EMAIL    = 100;    // Kayttajat.Sahkoposti     varchar(100)
const LIMIT_PASSWORD = 72;     // hashed before storing; bcrypt ignores bytes past 72
const LIMIT_NAME     = 60;     // Kampanjat/Hahmo/NPCS.Nimi, Esineet.Esine
const LIMIT_SHORT    = 40;     // Rotu, Hahmoluokka, Status, NPCS.Type
const LIMIT_NOTES    = 1000;   // Muistiinpanot / Kuvaus   varchar(1000)

/*
 * Maximum values for numbers.
 *
 * Every number column in this database is a 4-byte INT. The width shown
 * in the column type - int(11), int(255) - is only a display hint, NOT a
 * range, so they all stop at 2147483647 regardless. Going past that is
 * what produces "Numeric value out of range" (SQLSTATE 22003).
 *
 * The caps below sit far inside that limit. They are picked to be
 * sensible for a role-playing game rather than to be the largest number
 * MySQL happens to accept.
 */
const LIMIT_LEVEL  = 999;
const LIMIT_POINTS = 999999;   // HP and MP
const LIMIT_STAT   = 9999;     // strength, constitution, agility, ...
const LIMIT_AMOUNT = 999999;   // how many of an item

/**
 * Trim whitespace, strip HTML tags, and optionally cut the value to a
 * maximum length. Leaving $maxLength out keeps the original behaviour,
 * so existing calls are unaffected.
 */
function cleanUpInput($userinput, $maxLength = null){
    // A field submitted as an array (e.g. name[]=x) would make
    // strip_tags() throw, so refuse anything that is not a plain value.
    if (!is_scalar($userinput)) {
        return "";
    }

    $clean = trim(strip_tags((string) $userinput));

    if ($maxLength !== null && mb_strlen($clean) > $maxLength) {
        $clean = mb_substr($clean, 0, $maxLength);
    }

    return $clean;
}

function cleanUpOutput($useroutput){
    return htmlspecialchars(
        trim($useroutput),
        ENT_QUOTES,
        'UTF-8'
    );
}
/**
 * Turn user input into a whole number inside [$min, $max].
 *
 * Anything that is not a number at all (empty field, text, an array)
 * becomes $min, which keeps empty form fields behaving as 0.
 */
function cleanUpNumber($value, $max, $min = 0){
    if (!is_scalar($value) || !is_numeric($value)) {
        return $min;
    }

    // Compare as a float first. Casting a huge value straight to int
    // can overflow and wrap to a nonsense number before we clamp it.
    $number = (float) $value;

    if ($number < $min) {
        return $min;
    }

    if ($number > $max) {
        return $max;
    }

    return (int) $number;
}
