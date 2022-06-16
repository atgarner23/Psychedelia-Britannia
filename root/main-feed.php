<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psychedelia Britannia</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
    <header class="main-header">
        <nav>
            <ul class="main-nav">
                <li><a href="main-feed.php">Home</a></li>
                <li><a href="PLANTS PAGE">Plants</a></li>
                <li><a href="NOTIFICATIONS PAGE">Notifications</a></li>
                <li><a href="BOOKMARKS PAGE">Bookmarks</a></li>
                <li><a href="TOPICS PAGE">Topics</a></li>
                <li><a href="JOURNAL PAGE">Journal</a></li>
                <li><a href="MY POSTS PAGE">Posts</a></li>
                <li><a href="LISTS PAGE">Lists</a></li>
                <li><a href="MY PROFILE PAGE">Profile</a></li>
            </ul>
        </nav>
    </header>
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
    <aside>
        <form action="search.php" method="get" class="searchform">
            <label for="" class="screen-reader-text">Search</label>
            <input type="search" name="phrase" id="phrase">
            <button type="submit">Search</button>
        </form>
        <div class="trending-articles">
            <h2>Trending Articles</h2>

            <!-- insert a few recent articles -->
            <div>
                <img src="images/default-profile-pic.jpg" height="25px" width="25px" style="border-radius: 50%;"  alt="USERNAME">
                <h4>USERNAME</h4>
                <h2>ARTICLE TITLE</h2>
            </div>
        </div>
        <!--End trending-articles div-->
        <div class="topics">
            <ul class="topics">
                <li class="topic"><a href="TOPIC">TOPIC</a></li>
            </ul>
        </div>
        <!--End Topics Div-->
        <div class="suggested-follow">
            <div class="follow-user">
                <img src="images/default-profile-pic.jpg" height="25px" width="25px" style="border-radius: 50%;"  alt="USERNAME">
                <h3>USERNAME</h3>
                <p>BIO</p>
                <button>FOLLOW</button>
            </div>
            <!--End Follow User-->
        </div>
        <!--End Who to follow-->

        <div class="footer">
            FOOTER LEGAL BS GOES HERE LIKE TOS CUSTOMER SUPPORT HELP CONTACT
        </div>

    </aside>
</div>
</body>

</html>