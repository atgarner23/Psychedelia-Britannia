<aside>
<form action="search.php" method="get" class="searchform">
            <input type="search" name="phrase" id="phrase" class="search-input" placeholder="Search..">
            <button type="submit" class="search-btn btn material-symbols-outlined">search</button>
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
        <div class="flex justify-sp-bt align-c">
                <div class="flex gap align-c">
                    <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                    <h4 class="author-name"><?php echo $username; ?></h4>
                    </div>
                    
            </div>
            <p class="bio"><?php echo $bio; ?></p>
            <div class="flex gap">
            <button class="btn material-symbols-outlined">settings</button>
            <button class="btn material-symbols-outlined">mail</button>
            </div>
            
            <?php
               }
            }
            ?>
                    
        </div><!-- end author div-->
        <ul class="aside-nav">
            <li><a href="LISTS">LISTS</a></li>
            <li><a href="INSIGHTS">INSIGHTS</a></li>
            <li><a href="BOOKMARKS">BOOKMARKS</a></li>
            <li><a href="account-journal.php">JOURNAL</a></li>
            <li><a href="account.php">POSTS</a></li>
        </ul>

        <a href="login.php?action=logout" class="button log-out">Log Out</a>

        <div class="footer">
            <?php require('includes/footer.php'); ?>
        </div>

    </aside>