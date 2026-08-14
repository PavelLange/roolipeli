<?php require_once "../libraries/auth.php"?>
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

            <a href="/" class="nav-link active">
                Home
            </a>

            <a href="/campaigns" class="nav-link">
                Campaigns
            </a>

            <a href="/new-character" class="nav-link">
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
            <a href="/profile" class="nav-button">
                Profile
            </a>
            <?php endif ?>
        </div>
            
    </div>

</header>