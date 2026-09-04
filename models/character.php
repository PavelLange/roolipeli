<?php
require_once "../models/db.php";
require_once "../models/users.php";
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

function AddItem($campaignid,$item, $amount,$desc) {
    $pdo = connectDB();
    $data = [$campaignid, $item, $amount, $desc];
    $sql = "INSERT INTO Esineet (Kampanjaid, Esine, Maara,Kuvaus) VALUES (?,?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function updateItem($item, $amount,$desc, $id){
    $pdo = connectDB();
    $data = [$item, $amount, $desc, $id];
    $sql = "UPDATE Esineet SET Esine = ?, Maara = ?, Kuvaus = ? WHERE ID = ?";
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

function getItemByIdEdit($id){
    $pdo = connectDB();
    $sql = "SELECT * FROM Esineet WHERE ID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$id]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}


function listAllCharactersItems ($campaignid) {
    $pdo = connectDB();
    $sql = "SELECT * FROM Esineet WHERE Kampanjaid = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$campaignid]);
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);
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

function setDead($id) {
    $pdo = connectDB();
    $data = [$id];
    $sql = "UPDATE Hahmo SET Status = 'Dead'  WHERE ID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function setAlive($id) {
    $pdo = connectDB();
    $data = [$id];
    $sql = "UPDATE Hahmo SET Status = 'Alive'  WHERE ID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}
