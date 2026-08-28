<?php require_once "../libraries/auth.php"?>
<?php require_once "../controllers/campaignController.php" ?>
<?php require_once "../libraries/auth.php";
$message = "";
$currentPage = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Roolipeli</title>

    <link rel="stylesheet" href="/styles.css">
</head>

<body>

<header class="site-header">

    <div class="header-inner">

        <!-- Logo -->
        <a href="/" class="logo" aria-label="Roolipeli home">
            <span class="logo-mark">✦</span>
            <span class="logo-text">Roolipeli</span>
        </a>


        <!-- Main navigation -->
        <nav class="main-nav" aria-label="Main navigation">

            <a href="/" class="nav-link <?= $currentPage === '/' ? 'active' : '' ?>">
                Home
            </a>

            <a href="/campaigns" class="nav-link <?= str_starts_with($currentPage, '/campaigns') ? 'active' : '' ?>">
                Campaigns
            </a>

            <a href="/characters" class="nav-link <?= str_starts_with($currentPage, '/characters') ? 'active' : '' ?>">
                Characters
            </a>

        </nav>


        <!-- User actions -->
        <div class="header-actions">

            <?php if(!isLoggedIn()): ?>
            <a href="/login" class="login-link">
                Log in
            </a>

            <a href="/register" class="nav-button">
                Get Started
            </a>

            <?php else: ?>
            <a href="/logout" class="login-link">
                Logout
            </a>

            <button class="nav-button" id="invite" type="button" onclick="toggleInvites()">
                <img src="/images/invites.png" class="invite-img">
            </button>

            
            <script>
            function toggleInvites() {
                const invites = document.getElementById("Invite-div");
                if (invites.style.display === "none") {
                    invites.style.display = "grid";
                } else {
                    invites.style.display = "none";
                }
            }
            </script>    

            <a href="/profile" class="nav-button">
                Profile
            </a>
            

            <?php endif ?>
        </div>
            
    </div>
    

</header>
<div id="Invite-div" style="display:none;">
            <?php $allinvites = getInvites($_SESSION["username"]); ?>
            <?php if(empty($allinvites)) :?>
            <h1>Looks like you dont have any invites.</h1>
            <?php else: ?>
            <?php foreach($allinvites as $invite):?>
            <form method="POST">
            <div  class="invite">
            <h1><?= $invite["Lahettaja"] ?> invited you to a campaign</h1>
            <h2>Campaign: <?= $invite["Kampanja"] ?></h2>
            <?php $id = $invite["ID"]?>
            <button class="accept" name="accept" value="<?=$id?>" >Accept </button><button class="decline" name="decline" value="<?=$id?>">Decline</button>
            <hr style="width:100%"/>
            </form>
            </div>

            <?php endforeach ?>
            <?php endif?>    
            </div>
</div>
<br>
<?php if(isset($_SESSION["message"])):?>
<div class="message-div">
    <div class="message-div" id="message">
        <h2 name="message"><?=$_SESSION["message"]?></h2>
    </div>
</div>
<?php unset($_SESSION["message"]);?>
<?php endif?>