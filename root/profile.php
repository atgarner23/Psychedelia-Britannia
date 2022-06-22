<?php
require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();
require('includes/header.php');

//whose profile is this?
if (isset($_GET['user_id'])) {
	$user_id = clean_int($_GET['user_id']);
} elseif ($logged_in_user) {
	$user_id = $logged_in_user['user_id'];
} else {
	exit('Invalid User Account');
}

?>
<main class="content">
	<?php
	//get the user info
	$result = $DB->prepare('SELECT * FROM  users
								WHERE user_id = ?
								LIMIT 1');
	$result->execute(array($user_id));

	if ($result->rowCount() >= 1) {
		$row = $result->fetch();
		extract($row);
	?>
		<section class="user author-profile">
			<?php show_profile_pic($profile_pic, 100); ?>
			<h2><?php echo $username ?></h2>
			<p><?php echo $bio; ?></p>
			
			<hr>
		</section>
		<?php

		//get this user's posts 	
		$result = $DB->prepare('SELECT posts.*, topics.name
							FROM posts, topics
							WHERE posts.is_published = 1
                            AND posts.topic_id = topics.topic_id
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
					<div class="one-post card">
						<a href="single.php?post_id=<?php echo $post_id; ?>">
							<?php show_post_image($image, 'small') ?>

						</a>
						<h2><?php echo $row['title']; ?></h2>

						<span class="topic"><?php echo $name; ?></span>
						<span class="date"><?php echo time_ago($date); ?></span>
						<span class="comment-count"><?php echo count_comments($post_id); ?> Comments</span>
					</div>

				<?php } //end while loop
				?>
			</div><!-- .grid -->
		<?php } else { ?>

			<div class="feedback info">
				<p>This user hasn't posted any public images</p>
			</div>

	<?php
		} //end if posts found 
	} else {
		echo 'Sorry, that user account doesn\'t exist';
	} ?>

</main>
<?php
require('includes/aside-profile.php'); ?>
