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
    $master = $_SESSION["username"];
    $pdo = connectDB();
    $data = [$name, $master, $notes];
    $sql = "INSERT INTO Kampanjat (Nimi, Pelinjohtaja, Muistiinpanot) VALUES (?,?,?)";
    $stm = $pdo->prepare($sql);
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function getAllJoinedCampaigns($username) {
 
    $pdo = connectDB();
 
    $sql = "SELECT * FROM Kampanjat WHERE Pelaajat LIKE ?";
 
    $stm = $pdo->prepare($sql);
 
    $stm->execute(["%$username%"]);
 
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);
 
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
    $stm->execute([$name]);
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function addUserToCampaign($uname, $id){
    $pdo = connectDB();
    $data = [$uname, $id];
    $sql = "UPDATE Kampanjat SET Pelaajat = ? + Pelaajat WHERE ID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function deleteAllOwnedCampaigns($name) {
    $pdo = connectDB();
    $sql = "DELETE FROM Kampanjat WHERE Pelinjohtaja=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$name]);
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function addCharacterToCampaign($campaignId, $characterId) {
    $pdo = connectDB();

    $sql = "
        INSERT INTO Kampanjahahmot (KampanjaID, HahmoID)
        VALUES (?, ?)
    ";

    $statement = $pdo->prepare($sql);

    return $statement->execute([
        $campaignId,
        $characterId
    ]);
}

function removeCharacterFromCampaign($campaignId, $characterId) {
    $pdo = connectDB();

    $sql = "
        DELETE FROM Kampanjahahmot
        WHERE KampanjaID = ? AND HahmoID = ?
    ";

    $statement = $pdo->prepare($sql);

    return $statement->execute([
        $campaignId,
        $characterId
    ]);
}

function getCampaignCharacters($campaignId) {
    $pdo = connectDB();

    $sql = "
        SELECT Hahmo.*
        FROM Hahmo
        INNER JOIN Kampanjahahmot
            ON Hahmo.ID = Kampanjahahmot.HahmoID
        WHERE Kampanjahahmot.KampanjaID = ?
    ";

    $statement = $pdo->prepare($sql);
    $statement->execute([$campaignId]);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}