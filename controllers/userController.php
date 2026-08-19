<?php
require_once "../models/users.php";
require_once '../libraries/cleaners.php';

$error = "";
$error2 = "";
function registerController(){
    if(isset($_POST['username'], $_POST['email'], $_POST['password'])){
        $username = cleanUpInput($_POST['username']);
        $email = cleanUpInput($_POST['email']);
        $password = cleanUpInput($_POST['password']);
        if(dupeUser($username)){
            $error = "Username already in use!";
        }elseif(dupeMail($email)) {
            $error2 = "E-mail already in use!";
        }
        else {
            try {
            AddUser($username, $email, $password);
            header("Location: /login"); 
        } catch (PDOException $e){
            echo "Error while saving to database: " . $e->getMessage();
        }
        }
       
    }
    require "../views/register.php";
    
}

function loginController(){
    if(isset($_POST['username'], $_POST['password'],)){
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);
        
        $result = login($username, $password);
        if($result){
            $_SESSION['username'] = $result['Kayttajanimi'];
            $_SESSION['user_id'] = $result['ID'];
            $_SESSION['session_id'] = session_id();
            header("Location: /"); 
        } else {
            require "../views/login.php";
        }
    } else {
        require "../views/login.php";
    }
}

function logoutController(){
    session_unset(); //poistaa kaikki muuttujat
    session_destroy();
    setcookie(session_name(),'',0,'/'); //poistaa evästeen selaimesta
    session_regenerate_id(true);
    header("Location: /"); // forward eli uudelleenohjaus
    die();
}