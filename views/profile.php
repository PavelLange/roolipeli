<?php require_once "../models/users.php";

$id = $_SESSION["userid"];
$userinfo = getAllInfo($id); 
echo "<h3>Käyttäjänimi: " . $userinfo["Kayttajanimi"] . "</h3>";
echo "<h3>Sähköposti: " . $userinfo["Sahkoposti"] . "</h3>";
?>
</div>
