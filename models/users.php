<?php
require_once "../models/db.php";
require_once "../libraries/auth.php";
function getAllInfo($id) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Kayttajat WHERE ID=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function getUsername($id) {
    $pdo = connectDB();
    $sql = "SELECT Kayttajanimi FROM Kayttajat WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function searchCharacters($usern) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Hahmo WHERE Tekija=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$usern]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function login($username, $password) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Kayttajat WHERE Kayttajanimi=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$username]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        return false;
    }
    $hashedpassword = $user["Salasana"];
    if($hashedpassword && password_verify($password, $hashedpassword)) {
        return $user;
    } else {
        return false;
    }

}

function AddUser($username,$email,$password) {
    $pdo = connectDB();
    $hashedpassword = hashPassword($password);
    $joined = date("F Y");
    $data = [$username,$email,$hashedpassword,$joined];
    $sql = "INSERT INTO Kayttajat (Kayttajanimi,Sahkoposti,Salasana,Tehty) VALUES (?,?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function dupeUser($username){
    $pdo = connectDB();
    $sql = "SELECT Kayttajanimi FROM Kayttajat WHERE Kayttajanimi=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$username]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    if($user) {
        return true;
    } else {
        return false;
    }
}
function dupeMail($email){
    $pdo = connectDB();
    $sql = "SELECT Sahkoposti FROM Kayttajat WHERE Sahkoposti=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$email]);
    $mail = $stm->fetch(PDO::FETCH_ASSOC);
    if($mail) {
        return true;
    } else {
        return false;
    }
}

function getMaster($user){
    $pdo = connectDB();
    $sql = "SELECT Pelinjohtaja FROM Kampanjat WHERE Pelinjohtaja=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$user]);
    $role = $stm->fetch(PDO::FETCH_ASSOC);
    return $role;
    
} 

function getRole($user){
    $pdo = connectDB();
    $sql = "SELECT Pelinjohtaja FROM Kampanjat WHERE Pelinjohtaja=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$user]);
    $role = $stm->fetch(PDO::FETCH_ASSOC);
    return $role;
    
}

function deleteUser($id) {
    $pdo = connectDB();
    $sql = "DELETE FROM Kayttajat WHERE ID=?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$id]);
}

function getAllUsers() {
    $pdo = connectDB();
    $sql = "SELECT ID, Kayttajanimi FROM Kayttajat ORDER BY Kayttajanimi ASC";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $users = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}