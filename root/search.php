<?php
require('includes/CONFIG.php');
require_once('includes/functions.php');

//page configuration
$per_page = 4;

//sanitize the search phrase
if (isset($_GET['phrase'])) {
    $phrase = clean_string($_GET['phrase']);
} else {
    $phrase = '';
}
require('includes/header.php');



?>

<main class="content">
    <?php //get all the posts that match the phrase
    if ($phrase != '') {
        $query = 'SELECT posts.*, users.user_id, users.profile_pic, users.username, plants.*, topics.*
                    FROM posts, users, plants, topics
                    WHERE (title LIKE :phrase
                    OR body LIKE :phrase
                    OR topics.t_name LIKE :phrase
                    OR plants.p_name LIKE :phrase)
                    AND posts.user_id = users.user_id
                    AND posts.topic_id = topics.topic_id
                    AND posts.plant_id = plants.plant_id
                    AND is_published = 1
                    AND is_public = 1
                    ORDER BY date DESC';

        $result = $DB->prepare($query);
        $result->execute(array('phrase' => "%$phrase%"));

        //total number of matching posts
        $total = $result->rowCount();

        //how many pages? ceil means always round up to a full page
        $max_pages = ceil($total / $per_page);

        //pre-set current page
        $current_page = 1;

        //what page are we on? URL will be search.php?phrase=cat&page=2
        if (isset($_GET['page'])) {
            $current_page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
        }
        //validate the current page
        if ($current_page < 1 or $current_page > $max_pages) {
            $current_page = 1;
        }

        //figure out the offset for the LIMIT
        $offset = ($current_page - 1) * $per_page;
        //run the query again, applying the new limit
        $query .= ' LIMIT :offset, :per_page';
        $result = $DB->prepare($query);
        //bind parameters because LIMIT requires integers
        $wildcard_phrase = "%$phrase%";
        $result->bindParam('phrase', $wildcard_phrase, PDO::PARAM_STR);
        $result->bindParam('offset', $offset, PDO::PARAM_INT);
        $result->bindParam('per_page', $per_page, PDO::PARAM_INT);
        //
        $result->execute();
        //debug_statement($result);

    ?>
        <section class="title">
            <h2>Search Results for <?php echo $phrase; ?></h2>
            <h3><?php echo $total; ?> posts found. Showing page <?php echo $current_page; ?> of <?php echo $max_pages; ?>.</h3>
        </section>

        <?php if ($total >= 1) { ?>
            <section class="grid">
                <?php while ($row = $result->fetch()) {
                    extract($row); ?>
                    <div class="card">
                        <div class="card-content flex justify-sp-bt">
                            <div class="card-info">
                                <div class="author-info">
                                    <?php show_profile_pic($profile_pic, 'round', $username, 25); ?>
                                    <h4 class="author-name"><?php echo $username; ?></h4>
                                    <h5 class="post-date"><?php echo convert_date($date); ?></h5>
                                </div><!-- end author-info div-->
                                <h2 class="post-title"><?php echo $title; ?></h2>
                                <p class="post-descrip"><?php echo $body; ?> </p>
                                <p>Topic: <?php echo $t_name; ?></p>
                                <p>Plant: <?php echo $p_name; ?></p>
                            </div>
                            <?php show_post_image($image, 'small', $title); ?>
                        </div><!-- end card-content div-->
                        
                        <a href="single.php?post_id=<?php echo $post_id; ?>">Read More &rarr;</a>
                        <!-- C/O https://placeholder.com/ -->
                    </div><!-- end card div-->
                <?php } //end while loop
                ?>
            </section> <!-- .grid -->
            <section class="pagination">
                <?php
                $prev = $current_page - 1;
                $next = $current_page + 1; ?>

                <?php if ($current_page > 1) { ?>
                    <a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $prev; ?>" class="button">&larr; Previous</a>
                <?php } //end previous if statement 
                ?>

                <?php for ($i = 1; $i <= $max_pages; $i++) {
                    if ($i == $current_page) {
                        $class = '';
                    } else {
                        $class = 'button-outline';
                    }
                ?>
                    <a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $i; ?>" class="button <?php echo $class; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php } //end for loop 
                ?>

                <?php if ($current_page < $max_pages) { ?>
                    <a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $next; ?>" class="button">Next &rarr;</a>
                <?php } //end next if statement 
                ?>
            </section><!-- .pagination -->
        <?php } //end if posts found 
        ?>
    <?php
    } else {
        $message = 'Search is Blank';
        $class = 'error';
        show_feedback($message, $class);
    }
    
    ?>
</main>
<?php
require('includes/aside.php');
?>