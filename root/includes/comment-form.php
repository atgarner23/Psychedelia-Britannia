<?php 
//pre-define vars
$errors = '';
?>

<section class="comment-form">
    <h2>Leave a Comment:</h2>

    <?php show_feedback($feedback, $feedback_class, $errors); ?>

    <form action="single.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="post">
        <textarea name="body" id="body" cols="30" rows="10"></textarea>

        <input class="button" type="submit" value="Submit">
        <input type="hidden" name="did_comment" value="1">

    </form>
</section>