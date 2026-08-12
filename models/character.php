<?php
require_once "../models/db.php";

function getAllCharacters ($id) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Hahmo WHERE ID=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function listAllClasses () {
    $pdo = connectDB();
    $sql = "SELECT * FROM Hahmoluokat";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function listAllRaces () {
    $pdo = connectDB();
    $sql = "SELECT * FROM Rodut";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function AddCharacter($name, $race,$class, $notes, $level, $hp, $mp, $str, $dex, $int, $chr, $creator) {
    $pdo = connectDB();
    $data = [$name, $master, $notes];
    $sql = "INSERT INTO Hahmot (Nimi, Rotu, Hahmoluokka ,Muistiinpanot, Taso, Elämäpisteet, Magiapisteet, Voima, Ketteryys, Älykkyys, Karisma, Tekija ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function updateCharacter($name, $race,$class, $notes, $level, $hp, $mp, $str, $dex, $int, $chr, $id){
    $pdo = connectDB();
    $data = [$name, $race,$class, $notes, $level, $hp, $mp, $str, $dex, $int, $chr, $id];
    $sql = "UPDATE Hahmo SET Nimi = ? , Rotu = ?, Hahmoluokka = ?, Muistiinpanot = ?, Taso = ?, Elämäpisteet = ?, Magiapisteet = ?, Voima = ?, Ketteryys = ?, Älykkyys = ?, Karisma = ?  WHERE ID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function deleteCharacter($id){
    $pdo = connectDB();
    $sql = "DELETE FROM Hahmo WHERE ID=?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$id]);
}

function AddItem($character,$item, $amount ) {
    $pdo = connectDB();
    $data = [$character, $item, $amount];
    $sql = "INSERT INTO Esineet (Hahmo, Esine, Määrä ) VALUES (?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function updateItem($character,$item, $amount, $id){
    $pdo = connectDB();
    $data = [$character, $item, $amount, $id];
    $sql = "UPDATE Esineet SET Hahmo = ? , Esine = ?, Määrä = ?  WHERE ID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function deleteItem($id){
    $pdo = connectDB();
    $sql = "DELETE FROM Esineet WHERE ID=?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$id]);
}