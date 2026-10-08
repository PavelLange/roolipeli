<?php

function formToken($formName){
    if (empty($_SESSION["form_tokens"][$formName])) {
        $_SESSION["form_tokens"][$formName] = bin2hex(random_bytes(16));
    }

    return $_SESSION["form_tokens"][$formName];
}


function formTokenField($formName){
    return '<input type="hidden" name="form_token" value="'
        . htmlspecialchars(formToken($formName), ENT_QUOTES, "UTF-8")
        . '">';
}


function useFormToken($formName){
    $sent     = $_POST["form_token"] ?? "";
    $expected = $_SESSION["form_tokens"][$formName] ?? "";

    if (!is_string($sent) || $sent === "" || $expected === "") {
        return false;
    }

    if (!hash_equals($expected, $sent)) {
        return false;
    }

    unset($_SESSION["form_tokens"][$formName]);

    return true;
}