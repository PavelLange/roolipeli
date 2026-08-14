<?php
require_once "../models/users.php";
require_once 'libraries/cleaners.php';

function registerController(){
    if(isset($_POST['username'], $_POST['email'], $_POST['password'])){
        $username = cleanUpInput($_POST['username']);
        $email = cleanUpInput($_POST['email']);
        $password = cleanUpInput($_POST['password']);

        if(empty($username) || empty($email) || empty($password)){
            $error = "Please fill in all fields.";
        }

        try {
            addUser($username, $email, $password);
            header("Location: /"); 
        } catch (PDOException $e){
            echo "Error while saving to database: " . $e->getMessage();
        }
    } else {
        require "views/register.view.php";
    }
}

function loginController(){
    if(isset($_POST['username'], $_POST['password'],)){
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);
  
        $result = loginUser($username, $password);
        if($result){
            $_SESSION['username'] = $result['username'];
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['session_id'] = session_id();
            header("Location: /"); 
        } else {
            require "views/login.view.php";
        }
    } else {
        require "views/login.view.php";
    }
}