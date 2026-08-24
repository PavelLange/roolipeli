<?php require_once "../models/users.php";?>
<?php
$id = $_SESSION["user_id"];
$userinfo = getAllInfo($id); 
?>
<div class="profile-div">
<img src="/images/profile_pic.jpg" class="profile-pic">

    <div class="profile-text">
    <h1 class="profile-info">Username:</h1>
    <h2> <?= $userinfo["Kayttajanimi"] ?> </h2>
    <br>
    <h1 class="profile-info">E-mail:</h1>
    <h2> <?= $userinfo["Sahkoposti"] ?> </h2>
    <br>
    <h1 class="profile-info">Member since:</h1> 
    <h2> <?= $userinfo["Tehty"] ?> </h2>
    <br>
    <a
                        href="/delete-account?id=<?= $id ?>"
                        class="button button-primary"
                        onClick="return confirm('Are you sure you want to delete this account?');"
                    >
                        Delete account
                    </a>
    </div>

</div>
