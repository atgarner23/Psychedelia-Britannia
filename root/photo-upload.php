<?php
require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();
require('includes/header.php');
//kill the page if not logged in
if (!$logged_in_user) {
    header('Location:index.php');
}
?>

<main class="content">
    <div class="card">
    <?php require('includes/parse-upload.php'); ?>
    <h2>Add Post Photo</h2>
    <?php echo show_feedback($feedback, $feedback_class, $errors);
    ?>
    <form action="photo-upload.php?post_id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
        <label for="">Upload a .jpg, .gif or .png image</label>
        <input type="file" name="uploadedfile" id="uploadedfile" accept="image/*" required>

        <input type="submit" value="Publish Post">
        <input type="hidden" name="did_upload" value="1">
    </form>
    </div>
    <div class="card">
        <?php require('includes/debug-output.php'); ?>
    </div>
</main>
<?php
require('includes/aside.php');
?>