<?php
require_once "../models/users.php" ;
function hashPassword($password) {
    $password = trim($password);
    $hashedpassword = password_hash($password,PASSWORD_DEFAULT);
    return $hashedpassword;
}

function isLoggedIn(){
    if(isset($_SESSION['username'], $_SESSION['user_id']) && ($_SESSION['session_id'] == session_id())) {
        return true;
    }  else {
        return false;
    }
}

function isMaster (){
    $user = $_SESSION['username'];
    $role = getRole($user);

    if($role['Pelinjohtaja'] === $_SESSION['username']) {
        return True;
    }  else {
        return false;
    }
}