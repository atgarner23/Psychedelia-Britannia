<?php 
//includes
require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();

require('includes/header.php');

//kill the page if not logged in
if (!$logged_in_user) {
    header("Location:index.php");
}
?>
    
		<div class="card">
            <h2>Get in touch!</h2>
            <?php require('includes/parse-contact.php'); ?>
        <form action="contact.php" method="post">
            <label for="fname">Name:</label>
            <input type="text" id="fname" name="fname" >
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" >

            <label for="message">What can we help you with?</label>
            <textarea name="message" id="messsage" cols="30" rows="10"></textarea>

            <input type="submit" value="Submit">
            <input type="hidden" name="did_submit" value="1">
        </form>
        </div><!-- end card div-->
        

    </main>
    <?php require('includes/aside.php'); ?>
</div>
</body>

</html>