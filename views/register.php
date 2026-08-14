<?php require "../partials/header.php"; ?>

<h2>Register</h2>

<form action="/register" method="post">
    <label for="username">Username:</label> 
    <input id="username" type="text" name="username" maxlength=30>
    <label for="email">Email:</label>
    <input id="email" type="email" name="email">
    <label for="password">Password:</label>
    <input id="password" type="password" name="password" maxlength=30>
    <input id="sendbutton" type="submit" value="Lähetä">
</form>

<?php require "../partials/footer.php"; ?>