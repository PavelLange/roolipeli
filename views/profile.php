<?php require_once "../models/users.php";

$id = $_SESSION["user_id"];
$userinfo = getAllInfo($id); 
echo "<h3>Username: " . $userinfo["Kayttajanimi"] . "</h3>";
echo "<h3>e-mail: " . $userinfo["Sahkoposti"] . "</h3>";
?>
</div>
