<?php require_once "../partials/header.php"; ?>

<h2>Login</h2>

<form action="/login" method="post">
    <label for="username">Käyttäjänimi:</label> 
    <input id="username" type="text" name="username" maxlength=30>
    <label for="password">Salasana:</label>
    <input id="password" type="password" name="password" maxlength=30>
    <input id="sendbutton" type="submit" value="Lähetä">
</form>

<?php require_once "../partials/footer.php"; ?>