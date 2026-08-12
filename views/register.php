<?php require "partials/header.php"; ?>

<h2>Rekisteröidy</h2>

<form action="/register" method="post">
    <label for="username">Käyttäjänimi:</label> 
    <input id="username" type="text" name="username" maxlength=30>
    <label for="email">Sähköposti:</label>
    <input id="email" type="email" name="email">
    <label for="password">Salasana:</label>
    <input id="password" type="password" name="password" maxlength=30>
    <input id="sendbutton" type="submit" value="Lähetä">
</form>

<?php require "../partials/footer.php"; ?>