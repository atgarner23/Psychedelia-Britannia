<aside>
        <form action="search.php" method="get" class="searchform">
            <input type="search" name="phrase" id="phrase" class="search-input" placeholder="Search..">
            <button type="submit" class="search-btn btn material-symbols-outlined">search</button>
        </form>
        <div class="trending-articles">
            <h2>Trending Articles</h2>

            <!-- insert a few recent articles -->
            <?php //get up to 3 published posts, newest first
	$result = $DB->prepare('SELECT posts.*
							FROM posts
							WHERE posts.is_published = 1
                            AND posts.is_public = 1
							ORDER BY posts.date DESC
							LIMIT 3');
	$result->execute();
	//check if any rows were found
	if ($result->rowCount() >= 1) {
		while ($row = $result->fetch()) {
			//make variables from the array keys
			extract($row);
	?>
            <div>
                <h4><?php echo $title; ?></h4>
                <p class="post-descrip"><?php echo $body; ?></p>
            </div>
            <?php
		} //end while	
	} else {
		//no rows found from our query
		echo 'No posts found';
	} //end else 
	?>
        </div>
        <!--End trending-articles div-->
        <div class="topics">
            <h2>Hot Topics</h2>
            <ul class="topics grid col-2">
            <?php 
            //get 6 random topics and display them here
            $result = $DB->prepare('SELECT * FROM topics ORDER BY RAND() LIMIT 6');
            $result->execute();
            if($result->rowCount() >= 1){
                while($row = $result->fetch()){
                    //make variables from the array keys
                    extract($row);
            ?>
            
                <li class="topic"><a href="TOPIC"><?php echo $t_name ?></a></li>
            
            <?php 
                }//end while
            }else{
                //no rows found
                echo 'No Topics Found';
            }//end else
            ?>
            </ul>
        </div>
        <!--End Topics Div-->
        <div class="suggested-follow">
            <h2>Who to Follow</h2>

            <?php 
            //get 3 random users and display them here
            $result = $DB->prepare('SELECT * FROM users ORDER BY RAND() LIMIT 3');
            $result->execute();
            if($result->rowCount() >= 1){
                while($row = $result->fetch()){
                    //make variables from the array keys
                    extract($row);
            ?>
            <div class="follow-user">
                <a href="profile.php?user_id=<?php echo $user_id; ?>">
                    <span>
                        <span class="flex gap">
                        <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                        <h4 class="author-name"><?php echo $username; ?></h4>
                    </span>
                        <p><?php echo $bio; ?></p>
                    </span>
                </a>
                <button>FOLLOW</button>
            </div>
            <?php 
                }//end while
            }else{
                //no rows found
                echo 'No Topics Found';
            }//end else
            ?>
            <!--End Follow User-->
        </div>
        <!--End Who to follow-->

        <div class="footer">
            <?php require('includes/footer.php'); ?>
        </div>

    </aside>