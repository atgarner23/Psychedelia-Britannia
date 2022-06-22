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
	
    <div class="top-nav flex">
        <ul class="local-nav flex">
            <li><a href="POSTS">Posts</a></li><!--Public Posts-->
            <li><a href="JOURNAL">Journal</a></li><!--Private Posts-->
        </ul>
        <button class="new-post">New Post</button>
        <button class="more">more</button>
    </div>
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
	?>

</main>
<?php
require('includes/aside-account.php'); ?>
