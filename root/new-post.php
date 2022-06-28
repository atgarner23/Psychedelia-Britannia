<?php 
//pre-define vars
$errors = array();

require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();
$user_id = $logged_in_user['user_id'];

require('includes/parse-new-post.php');

require('includes/header.php');
//kill the page if not logged in
if (!$logged_in_user) {
    header("Location:index.php");
}
?>

<main class="new-post-content card">
    
    <h2>Create a New Post:</h2>
    <?php show_feedback($feedback, $feedback_class, $errors); ?>
    <form action="new-post.php" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">

        <label for="subtitle">Subtitle:</label>
        <input type="text" name="subtitle" id="subtitle">

        <!-- add image uploader -->

        <label for="body">Body:</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>

        <input type="checkbox" name="is_public" id="is_public" value="1">
        <label for="is_public">Make post public</label>
        
        <input type="checkbox" name="allow_comments" id="allow_comments" value="1">
        <label for="allow_comments">Allow Comments</label>


        <?php topic_dropdown();
        plant_dropdown(); ?>
        <!-- checkbox for is public
            checkbox for allow comments
            dropdown for plant id
            dropdown for topic id -->

        <input type="submit" value="Next &rarr;">
        <input type="hidden" name="did_submit">
    </form>
</main>
<?php require('includes/aside-account.php'); ?>