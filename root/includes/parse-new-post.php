<?php

$errors = array();
$allow_comments = false;
$is_public = false;

//parse the form if they hit submit
if (isset($_POST['did_submit'])) {
    //sanitize everything
    $title = clean_string($_POST['title']);
    $subtitle = clean_string($_POST['subtitle']);
    $body = clean_string($_POST['body']);
    $topic_id = clean_int($_POST['topic_id']);
    $plant_id = clean_int($_POST['plant_id']);
    $allow_comments = clean_boolean($_POST['allow_comments']);
    $is_public = clean_boolean($_POST['is_public']);
    //$is_published = clean_boolean($_POST['is_published']);
    //validate
    $valid = true;
    //title blank or longer than 50
    if ($title == '' or strlen($title) > 50) {
        $valid = false;
        $errors['title'] = 'Create a title between 1 &ndash; 50 characters long.';
    }
    //body longer than 500
    if (strlen($body) > 10000) {
        $valid = false;
        $errors['body'] = 'Post caption must be shorter than 10,000 characters';
    }
    //topic must be positive int
    if ($topic_id < 1) {
        $valid = false;
        $errors['topic_id'] = 'Choose a valid topic';
    }
    //plant must be positive int
    if ($plant_id < 1) {
        $valid = false;
        $errors['plant_id'] = 'Choose a valid plant';
    }

    //if valid, update the post in the DB
    if ($valid) {
        $result = $DB->prepare('INSERT INTO posts
                                (date, body, is_public, is_published, allow_comments, image, title, topic_id, user_id, plant_id, subtitle)
                                VALUES
                                (now(), :body, :public, 1, :comments, "", :title, :topic, :user, :plant, :subtitle)');
        $result->execute(array(
            'body' => $body,
            'public' => $is_public,
            'comments' => $allow_comments,
            'title' => $title,
            'topic' => $topic_id,
            'user' => $logged_in_user['user_id'],
            'plant' => $plant_id,
            'subtitle' => $subtitle,
        ));
        if ($result->rowCount()) {
            //what post just got added?
            $post_id = $DB->lastInsertId();
            header("Location:photo-upload.php?post_id=$post_id");
        } else {
            //error - no changes made
            $feedback = 'Something went wrong. Please try again.';
            $feedback_class = 'info';
        } //end if rowCount
    } else {
        //handle feedback
        $feedback = 'Couldn\'t upload your post. Please fix the following:';
        $feedback_class = 'error';
    }
} //end if did edit

//author of the post or the admin
/*$result = $DB->prepare('SELECT *
                        FROM posts
                        WHERE user_id = :user_id
                        LIMIT 1');
$result->execute(array(
    //'post_id' => $post_id,
    'user_id' => $logged_in_user['user_id'],
));
if ($result->rowCount()) {
    $row = $result->fetch();
    //set up the variables to pre-fill the form
    extract($row);
} else {
    //security! you aren't the author of this post
    exit('You are not allowed to edit this post.');
}*/
