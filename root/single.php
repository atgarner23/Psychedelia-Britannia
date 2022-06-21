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
            <div class="post-head flex jc-sb">
                <div class="author flex">
                    <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                    <h4 class="author-name"><?php echo $username; ?></h4>
                    <h5 class="post-date"><?php echo convert_date($date); ?></h5>
                </div><!-- end author div-->
                <div class="share">
                    <ul>
                        <li><a href="BOOKMARK">BOOKMARK</a></li>
                        <li><a href="LIKE">LIKE</a></li>
                        <li><a href="SHARE">SHARE</a></li>
                        <li><a href="TWITTER">TWITTER</a></li>
                        <li><a href="FACEBOOK">FACEBOOK</a></li>
                    </ul>
                </div><!-- end share div-->
            </div><!-- end post-head div-->
            <div class="post-title">
                <h2><?php echo $title; ?></h2>
                <h4><?php echo $subtitle; ?></h4>
            </div><!-- end post-title div--> 
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
            <p class="post-body"><?php echo $body; ?></p>


            <!-- TODO: Add comments form
                       Add comments section
                        Add shareable and likes -->



        </div><!-- end card div-->
        


        <?php
		} //end while	
	} else {
		//no rows found from our query
		echo 'No posts found';
	} //end else 
	?>




    </main>
    <?php require('includes/aside.php'); ?>
    <?php require('includes/debug-output.php'); ?>
</div>
</body>

</html>