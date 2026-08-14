<?php
require_once "../models/db.php";

function getAllCharacterInfo ($id) {
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
    $stm->execute();
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function AddCharacter($name, $race,$class, $notes, $level, $hp, $mp, $str, $con, $dex, $int, $chr, $creator) {
    $pdo = connectDB();
    $data = [$name, $race, $class, $notes, $level, $hp, $mp, $str, $con, $dex, $int, $chr, $creator];
    $sql = "INSERT INTO Hahmot (Nimi, Rotu, Hahmoluokka ,Muistiinpanot, Taso, Elämäpisteet, Magiapisteet, Voima, Kestävyys ,Ketteryys, Älykkyys, Karisma, Tekija ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function updateCharacter($notes, $level, $hp, $mp, $str, $con ,$dex, $int, $chr, $id){
    $pdo = connectDB();
    $data = [$notes, $level, $hp, $mp, $str, $con,$dex, $int, $chr, $id];
    $sql = "UPDATE Hahmo SET  Muistiinpanot = ?, Taso = ?, Elämäpisteet = ?, Magiapisteet = ?, Voima = ?,Kestävyys = ?, Ketteryys = ?, Älykkyys = ?, Karisma = ?  WHERE ID = ?";
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

function getCharacterByIdEdit($id){
    $pdo = connectDB();
    $sql = "SELECT * FROM Hahmo WHERE ID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$id]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}

function listAllCharactersItems ($charname) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Esineet WHERE Hahmo = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$charname]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    return $user;
}