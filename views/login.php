<?php require "../partials/header.php"; ?>

<h2>Login</h2>

<form action="/login" method="post">
    <label for="username">Username:</label> 
    <input id="username" type="text" name="username" maxlength=30>
    <label for="password">Password:</label>
    <input id="password" type="password" name="password" maxlength=30>
    <input id="sendbutton" type="submit" value="Lähetä">
</form>

<?php require "../partials/footer.php"; ?>