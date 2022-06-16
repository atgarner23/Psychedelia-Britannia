<?php 
//includes
require('includes/header.php');
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
        <div class="card flex justify-sp-bt">
            <div class="card-content">
                <div class="author-info">
                    <img src="images/default-profile-pic.jpg" height="25px" width="25px" style="border-radius: 50%;" alt="USERNAME" class="author-image-card">
                    <h4 class="author-name">USERNAME</h4>
                    <h5 class="post-date">POST DATE</h5>
                </div><!-- end author-info div-->
                <h2 class="post-title">POST TITLE</h2>
                <p class="post-descrip">POST DESCRIPTION </p>
            </div><!-- end card-content div-->
            <img src="https://via.placeholder.com/150" alt="POST_IMAGE_ALT" class="post-image-card">
            <!-- C/O https://placeholder.com/ -->
        </div><!-- end card div-->
    </main>
    <?php require('includes/aside.php') ?>
</div>
</body>

</html>