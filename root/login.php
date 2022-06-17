<?php 
require('includes/CONFIG.php');
require_once('includes/functions.php');
require('includes/parse-login.php');
require('includes/parse-logout.php');

require('includes/header-no-login.php');

?>

<div class="card container">
    <h2 class="login">Log In:</h2>
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username">

        <label for="password">Password</label>
        <input type="password" name="password">

        <input type="submit" value="Log In">

        <input type="hidden" name="did_login" value="true">
    </form>
</div>










<?php 
require('includes/footer.php')
?>