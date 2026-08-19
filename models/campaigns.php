<?php
require_once "../models/db.php";

function getAllCampaigns ($id) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Kampanjat WHERE ID=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function AddCampaign($name, $master,$notes) {
    $pdo = connectDB();
    $data = [$name, $master, $notes];
    $sql = "INSERT INTO Kampanjat (Nimi, Pelinjohtaja, Muistiinpanot, ) VALUES (?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function getAllOwnCampaigns ($id) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Kampanjat WHERE Pelaajat=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function deleteCampaign($id){
    $pdo = connectDB();
    $sql = "DELETE FROM Kampanjat WHERE ID=?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$id]);
}

function updateCampaign($name, $notes, $id){
    $pdo = connectDB();
    $data = [$name, $notes, $id];
    $sql = "UPDATE Kampanjat SET Nimi = ? , Muistiinpanot = ?  WHERE ID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function getAllOwnedCampaigns($name) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Kampanjat WHERE Pelinjohtaja=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function addUserToCampaign($uname, $id){
    $pdo = connectDB();
    $data = [$uname, $id];
    $sql = "UPDATE Kampanjat SET Pelaajat = ? + Pelaajat WHERE ID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

