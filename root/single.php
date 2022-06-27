<?php 
//includes
require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();

//which post are we trying to show? URL will look like single.php?post_id=X
$post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);
//VALIDATE - MAKE SURE WE GOT A POSITIVE INTEGER
if ($post_id < 0) {
    $post_id = 0;
}

require('includes/header.php');
require('includes/parse-comment.php');

//kill the page if not logged in
if (!$logged_in_user) {
    header("Location:index.php");
}
?>
    <main class="main-content">
        <div class="local-nav">
            <ul class="flex">
                <li><a href="FOLLOWING">Following</a></li>
                <li><a href="TRENDING">Trending</a></li>
                <li><a href="TOPICS">Topics</a></li>
                <li><a href="PLANTS">Plants</a></li>
            </ul>
        </div>



        <?php //Show the post that is clicked on
	$result = $DB->prepare('SELECT users.username, users.profile_pic, users.user_id, posts.*
							FROM posts, users
							WHERE posts.user_id = users.user_id
                            AND posts.is_published = 1
                            AND posts.is_public = 1
                            AND posts.post_id = ?
							LIMIT 1');
	$result->execute(array($post_id));
	//check if any rows were found
	if ($result->rowCount() >= 1) {
		while ($row = $result->fetch()) {
			//make variables from the array keys
			extract($row);
	?>
		<div class="card">
            <div class="post-head flex justify-sp-bt">
                <div class="author">
                    <div class="profile_section flex align-c">
                        <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                        <h4 class="author-name"><?php echo $username; ?></h4>
                    </div>
                    <h5 class="post-date"><?php echo convert_date($date); ?></h5>
                </div><!-- end author div-->
                <div class="share">
                    <ul class="flex gap-half align-c">
                        <li><a href="BOOKMARK"><img src="images/bookmark-flat-icon.svg" alt="Bookmarks" class="icon"></a></li>
                        <li><a href="LIKE"><img src="images/like-icon.svg" alt="Likes" class="icon"></a></li>
                        <li><a href="SHARE"><img src="images/share-icon.svg" alt="Share" class="icon"></a></li>
                        <li><a href="TWITTER"><img src="images/twitter-icon.svg" alt="Twitter" class="icon"></a></li>
                        <li><a href="FACEBOOK"><img src="images/facebook-icon.svg" alt="Facebook" class="icon"></a></li>
                    </ul>
                </div><!-- end share div-->
            </div><!-- end post-head div-->
            <div class="post-title">
                <h2><?php echo $title; ?></h2>
                <h4><?php echo $subtitle; ?></h4>
            </div><!-- end post-title div--> 
            <?php show_post_image($image, 'medium', $title); ?>
            <p class="post-body"><?php echo $body; ?></p>


            <div class="comment-section">
            <?php 
            
            //only show the comment form if this post has comments enabled
            if ($allow_comments) {
                if ($logged_in_user) {
                    include('includes/comment-form.php');
                } else {
                    echo 'Please Log In to leave a comment.';
                }
            } else {
                echo '<div class ="message">Comments Closed.</div>';
            } //close if allow_comments

            ?>
            <!-- TODO:
                       Add comments section
                        Add shareable and likes -->
            </div>


        </div><!-- end card div-->
        
            

        <?php

        include('includes/comments.php');

		} //end while	
	} else {
		//no rows found from our query
		echo 'No posts found';
	} //end else 
	?>




    </main>
    <?php require('includes/aside-single.php'); ?>
</div>
</body>

</html>