<?php
require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();

//This is the logged in user profile
if ($logged_in_user) {
	$user_id = $logged_in_user['user_id'];
} else {
	header('Location: login.php');
}
require('includes/header.php');
?>
<main class="account-content">
	
<div class="local-nav flex align-c">
        <ul class="gap-half justify-c flex">
            <li><a href="account.php">Posts</a></li><!--Public Posts-->
            <li><a href="account-journal.php">Journal</a></li><!--Private Posts-->
        </ul>
        <!-- <a href="new-post.php" class="button new-post">New Post</a> -->

		<!-- Multi action button -->
		<div class="mab flex">
			<button type="button" class="mab__button mab__button--menu btn material-symbols-outlined">add_box</button>
			

			<div class="mab__list">
				<a href="new-post.php" class="mab__button mab__button--secondary">
					<span class="mab__text">Journal Post</span>
				</a>
				<a href="new-post.php" class="mab__button mab__button--secondary">
					<span class="mab__text">Public Post</span>
				</a>
			</div>
    	</div>

		<!-- End Multi Action Button -->
		
        <button class="more btn material-symbols-outlined">
more_vert</button>
    </div>
		<?php

		//get this user's posts 	
		$result = $DB->prepare('SELECT posts.*, topics.*, plants.*
							FROM posts, topics, plants
							WHERE posts.is_published = 1
							AND posts.is_public = 1
                            AND posts.topic_id = topics.topic_id
							AND posts.plant_id = plants.plant_id
							AND posts.user_id = ?
							ORDER BY posts.date DESC
							LIMIT 20');

		$result->execute(array($user_id));

		if ($result->rowCount() >= 1) {
		?>
			<div class="grid">
				<?php
				while ($row = $result->fetch()) {
					extract($row);
				?>
			<div class="card">
            	<div class="card-content flex justify-sp-bt">
					<div class="card-body">
						<h2 class="post-title"><?php echo $title; ?></h2>
						<p class="post-descrip"><?php echo $body; ?> </p>
					</div> <!-- end card body -->
					<?php show_post_image($image, 'small', $title); ?>
            	</div><!-- end card-content div-->
            
           		 <a href="single.php?post_id=<?php echo $post_id; ?>">Read More &rarr;</a>
            
        	</div><!-- end card div-->

				<?php } //end while loop
				?>
			</div><!-- .grid -->
		<?php } else { ?>

			<div class="feedback info">
				<p>You don't have any public posts.</p>
			</div>

	<?php
		} //end if posts found 
	?>
<script src="js/multi-button.js" defer></script>
</main>
<?php
require('includes/aside-account.php'); ?>
