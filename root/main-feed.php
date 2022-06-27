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
	$result = $DB->prepare('SELECT posts.*, users.username, users.profile_pic, users.user_id, plants.*, topics.*
							FROM posts, users, topics, plants
							WHERE posts.user_id = users.user_id
                            AND posts.plant_id = plants.plant_id
                            AND posts.topic_id = topics.topic_id
							AND posts.is_published = 1
                            AND posts.is_public = 1
							ORDER BY posts.date DESC
							LIMIT 20');
	$result->execute();
	//check if any rows were found
	if ($result->rowCount() >= 1) {
		while ($row = $result->fetch()) {
			//make variables from the array keys
			extract($row);
	?>
        <div class="card">
            	<div class="card-content flex justify-sp-bt">
					<div class="card-body">
                        <div class="author-info">
                            <span class="flex align-c gap">
                            <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                            <h4 class="author-name"><?php echo $username; ?></h4>
                            </span>
                            <h5 class="post-date"><?php echo convert_date($date); ?></h5>
                        </div><!-- end author-info div-->
						<h2 class="post-title"><?php echo $title; ?></h2>
						<p class="post-descrip"><?php echo $body; ?> </p>
					</div> <!-- end card body -->
					<?php show_post_image($image, 'small', $title); ?>
            	</div><!-- end card-content div-->
            
           		 <a href="single.php?post_id=<?php echo $post_id; ?>">Read More &rarr;</a>
            
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
</div>
</body>

</html>