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

function listAllClasses() {
    $pdo = connectDB();
    $sql = "SELECT * FROM Hahmoluokat";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

function listAllRaces() {
    $pdo = connectDB();
    $sql = "SELECT * FROM Rodut";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

function AddCharacter($name, $race, $class, $notes, $level, $hp, $mp, $str, $con, $dex, $int, $chr, $creator) {

    $pdo = connectDB();
    $data = [$name, $race, $class, $notes, $level, $hp, $mp, $str, $con, $dex, $int, $chr, $creator];
    $sql = "INSERT INTO Hahmo (Nimi, Rotu, Hahmoluokka, Muistiinpanot, Taso, Elamapisteet, Magiapisteet, Voima, Kestavyys, Ketteryys, Alykkyys, Karisma, Tekija) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}


function updateCharacter($name, $notes, $hp, $mp, $str, $con, $dex, $int, $chr, $id
) {
    $pdo = connectDB();

    $sql = "UPDATE Hahmo
            SET
                Nimi = ?,
                Muistiinpanot = ?,
                Elamapisteet = ?,
                Magiapisteet = ?,
                Voima = ?,
                Kestavyys = ?,
                Ketteryys = ?,
                Alykkyys = ?,
                Karisma = ?
            WHERE ID = ?";

    $stm = $pdo->prepare($sql);

    return $stm->execute([
        $name,
        $notes,
        $hp,
        $mp,
        $str,
        $con,
        $dex,
        $int,
        $chr,
        $id
    ]);
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
    $sql = "INSERT INTO Esineet (Hahmo, Esine, Maara ) VALUES (?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function updateItem($character,$item, $amount, $id){
    $pdo = connectDB();
    $data = [$character, $item, $amount, $id];
    $sql = "UPDATE Esineet SET Hahmo = ? , Esine = ?, Maara = ?  WHERE ID = ?";
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
function getCharacterByCreator($creator) {
    $pdo = connectDB();

    $sql = "SELECT * FROM Hahmo WHERE Tekija = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$creator]);

    return $stm->fetch(PDO::FETCH_ASSOC);
} 

function getAllOwnCharacters($username) {
 
    $pdo = connectDB();
 
    $sql = "SELECT * FROM Hahmo WHERE Tekija LIKE ?";
 
    $stm = $pdo->prepare($sql);
 
    $stm->execute(["%$username%"]);
 
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);
 
    return $user;
}
