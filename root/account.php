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
        <a href="new-post.php" class="button new-post">New Post</a>
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
					<div class="card">
            <div class="card-content flex justify-sp-bt">
               <div class="card-body">
                <h2 class="post-title"><?php echo $title; ?></h2>
                <p class="post-descrip"><?php echo $body; ?> </p>
				</div> 
				<?php show_post_image($image, 'small', $title); ?>
            </div><!-- end card-content div-->
            
            <a href="single.php?post_id=<?php echo $post_id; ?>">Read More &rarr;</a>
            <!-- C/O https://placeholder.com/ -->
        </div><!-- end card div-->

				<?php } //end while loop
				?>
			</div><!-- .grid -->
		<?php } else { ?>

			<div class="feedback info">
				<p>This user doesn't have any public posts</p>
			</div>

	<?php
		} //end if posts found 
	?>

</main>
<?php
require('includes/aside-account.php'); ?>
