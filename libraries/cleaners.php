<?php

function cleanDump($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function cleanUpInput($userinput){
    return trim(strip_tags($userinput));
}

function cleanUpOutput($useroutput){
    return htmlspecialchars(
        trim($useroutput),
        ENT_QUOTES,
        'UTF-8'
    );
}