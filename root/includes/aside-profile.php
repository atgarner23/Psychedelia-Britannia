<aside>
        <form action="search.php" method="get" class="searchform">
            <label for="" class="screen-reader-text">Search</label>
            <input type="search" name="phrase" id="phrase">
            <button type="submit">Search</button>
        </form>

        <?php 
        $result = $DB->prepare('SELECT user_id, profile_pic, username, bio
                                FROM users
                                WHERE user_id = ?
                                LIMIT 1');
        $result->execute(array($user_id));
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


        <div class="footer">
            <?php require('includes/footer.php'); ?>
        </div>

    </aside>