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
    <main class="main-content">
        <div class="local-nav">
            <ul class="flex">
                <li><a href="FOLLOWING">Following</a></li>
                <li><a href="TRENDING">Trending</a></li>
                <li><a href="TOPICS">Topics</a></li>
                <li><a href="PLANTS">Plants</a></li>
            </ul>
        </div>



        <?php //get up to 20 published posts, newest first
	$result = $DB->prepare('SELECT posts.*, users.username, users.profile_pic, users.user_id
							FROM posts, users
							WHERE posts.user_id = users.user_id
							AND posts.is_published = 1
							ORDER BY posts.date DESC
							LIMIT 20');
	$result->execute();
	//check if any rows were found
	if ($result->rowCount() >= 1) {
		while ($row = $result->fetch()) {
			//make variables from the array keys
			extract($row);
	?>
		<div class="card flex justify-sp-bt">
            <div class="card-content">
                <div class="author-info">
                    <!-- <img src="images/default-profile-pic.jpg" height="25px" width="25px" style="border-radius: 50%;" alt="USERNAME" class="author-image-card"> -->

                    <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                    <h4 class="author-name"><?php echo $username; ?></h4>
                    <h5 class="post-date"><?php echo convert_date($date); ?></h5>
                </div><!-- end author-info div-->
                <h2 class="post-title"><?php echo $title; ?></h2>
                <p class="post-descrip"><?php echo $body; ?> </p>
            </div><!-- end card-content div-->
            <img src="<?php echo $image; ?>" alt="POST_IMAGE_ALT" class="post-image-card">
            <a href="single.php?post_id=<?php echo $post_id; ?>">Read More &rarr;</a>
            <!-- C/O https://placeholder.com/ -->
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