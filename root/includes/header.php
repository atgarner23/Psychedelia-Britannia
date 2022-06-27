<?php 
//includes
// require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();
$user_id = $logged_in_user['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psychedelia Britannia</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<div class="container">
    <header class="main-header">
        <nav>
            <ul class="main-nav">
                <li><a href="main-feed.php">Home</a></li>
                <li><a href="PLANTS PAGE">Plants</a></li>
                <li><a href="TOPICS PAGE">Topics</a></li>
                <li><a href="account-journal.php">Journal</a></li>
                <li><a href="account.php">Posts</a></li>
                <li><a href="BOOKMARKS PAGE">Bookmarks</a></li>
                <li><a href="LISTS PAGE">Lists</a></li>
                <li><a href="NOTIFICATIONS PAGE">Notifications</a></li>
                <li><a href="profile.php?user_id=<?php echo $user_id; ?>">Profile</a></li>
            </ul>
        </nav>
    </header>