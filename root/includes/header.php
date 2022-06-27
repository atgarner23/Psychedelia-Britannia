<?php 
//includes
// require('includes/CONFIG.php');
require_once('includes/functions.php');
$logged_in_user = check_login();
$user_id = $logged_in_user['user_id'];
$profile_pic = $logged_in_user['profile_pic'];
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
        <nav class="flex flex-col justify-sp-bt align-c">
            <a href="main-feed.php"><h1>Home</h1></a>
            <ul class="main-nav">
                
                <li><a href="PLANTS PAGE">Plants</a></li>
                <li><a href="TOPICS PAGE">Topics</a></li>
                <li><a href="account-journal.php">Journal</a></li>
                <li><a href="account.php">Posts</a></li>
                <li><a href="BOOKMARKS PAGE">Bookmarks</a></li>
                <!-- <li><a href="LISTS PAGE">Lists</a></li> -->
                <li><a href="NOTIFICATIONS PAGE">Notifications</a></li>
                
            </ul>
            <a href="profile.php?user_id=<?php echo $user_id; ?>"><?php show_profile_pic($profile_pic, 'round', 'Profile', 25) ?></a>
        </nav>
    </header>