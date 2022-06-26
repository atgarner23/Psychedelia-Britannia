<aside>
        <form action="search.php" method="get" class="searchform">
            <label for="" class="screen-reader-text">Search</label>
            <input type="search" name="phrase" id="phrase">
            <button type="submit">Search</button>
        </form>


        <?php 
        $result = $DB->prepare('SELECT users.user_id, users.profile_pic, users.username, users.bio, posts.post_id, posts.user_id
                                FROM users, posts
                                WHERE posts.user_id = users.user_id
                                AND posts.post_id = ?
                                LIMIT 1');
        $result->execute(array($post_id));
        if($result->rowCount() >= 1){
            while($row = $result->fetch()){
                extract($row);
         ?>
        <div class="author">
            <div class="flex">
                    <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                    <h4 class="author-name"><?php echo $username; ?></h4>
            </div>
            <p class="bio"><?php echo $bio; ?></p>
            <button>FOLLOW</button>
            <?php
               }
            }
            ?>
                    
        </div><!-- end author div-->


        <div class="trending-articles">
            <h2>Trending Articles</h2>

            <!-- insert a few recent articles -->
            <?php //get up to 3 published posts, newest first
	$result = $DB->prepare('SELECT posts.*
							FROM posts
							WHERE posts.is_published = 1
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
            <?php 
            //get 6 random topics and display them here
            $result = $DB->prepare('SELECT * FROM topics ORDER BY RAND() LIMIT 6');
            $result->execute();
            if($result->rowCount() >= 1){
                while($row = $result->fetch()){
                    //make variables from the array keys
                    extract($row);
            ?>
            <ul class="topics">
                <li class="topic"><a href="TOPIC"><?php echo $t_name ?></a></li>
            </ul>
            <?php 
                }//end while
            }else{
                //no rows found
                echo 'No Topics Found';
            }//end else
            ?>
            
        </div>
        <!--End Topics Div-->
        

        <div class="footer">
            <?php require('includes/footer.php'); ?>
        </div>

    </aside>