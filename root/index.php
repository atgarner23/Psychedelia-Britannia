<?php 
//includes
require('includes/CONFIG.php');
require_once('includes/functions.php');

$logged_in_user = check_login();
if(isset($logged_in_user['user_id'])){
    header('Location: main-feed.php');
}
require('includes/header-no-login.php');
?>

    <main>
        <div class="main-content card">
            <div class="hero">
                <div class="hero-content">
                    <h2 class="hero-logo">Psychedelia Brittania</h2>
                    <p class="hero-body">100&percnt; Private. 100&percnt; Secure. 100&percnt; Free. The ultimate online resource for research, integration, and community surrounding plant medicines.</p>
                    <a href="register.php" class="button">Start Your Free Journal</a>
                </div>
            </div>
            <section class="integration">
                <h3>Everything you need all in one place.</h3>
                <p>Whether you are tracking your microdosing or integrating large break throughs from a recent ceremony, Psychedelia Brittania has everything you need all in one place. We offer customized trackers, journals, and metrics to help you keep track of your plant medicine journey. Every account has a private journal where you can write freely. You can also create community blog posts to help others do research or share a revelation you recently had.</p>
            </section>
            <section class="research">
                <h3>Community Driven Research</h3>
                <p>Who better to learn from than first hand experience? We encourage our community members to share their experiences, successes, and trials. This helps keep the greater community safer by learning from the missteps of others. We highly encourage mental health professionals working in or curious about the world of psychedelic plant medicines to get involved and offer up any science-backed research as well. <b>As always, be cautious when working with plant medicines. Seek the advice of a Medical Professional. Do your own research.</b></p>
            </section>
            <section class="security">
                <h3>Privacy and Security You Can Trust</h3>
                <p>Due to the sensitive subject matter of our site, <b>We take security very seriously</b>. We collect very minimal personal data, and what we do collect is encrypted and stored with the most advanced encryption technology to date. With that being said, psychedelic plant medicines are illegal in many localities. We reccommend using throw away emails, VPNs, and minimally identifiable information when posting. <b>Use caution and check the laws in your local area.</b></p>
            </section>
            <div class="closing-cta">
                <h2>Join Our Community and Start Journaling Today!</h2>
                <a href="register.php" class="button">Sign Up</a>
            </div>
        </div>
    </main>
    
    <?php require('includes/footer.php'); ?>