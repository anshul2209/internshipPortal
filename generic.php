<?php
require_once './classes/database.class.php';
require_once './classes/register.class.php';
require_once './classes/session.class.php';

//connect to the database
$db = new database();
$db->connect();

//initialize UserTools object
$session = new session();

//start the session
session_start();

//refresh session variables if logged in
if (isset($_SESSION['logged_in'])) {
    $userEmail = unserialize($_SESSION['userEmail']);

    $_SESSION['userEmail'] = serialize($userEmail);
}
?>
<nav class="navbar navbar-default navbar-stati-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand pull-left"  href="index.php"><samp><strong class="text-primary">THE INTERNSHIP</strong></samp></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <?php if(isset($_SESSION['logged_in']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=='employer'): ?>
            <li class="bg-danger"><a href="viewapplication.php"><strong>View Applications</strong></a></li>
            <li class="bg-danger"><a href="addinternship.php"><strong>Add Internship</strong></a></li> 
            <?php elseif(isset($_SESSION['logged_in']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=='student'): ?>
            <li class="bg-danger"><a href="viewapplication.php"><strong>My Applications</strong></a></li>
            <?php endif ?>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contactus.php">Contact Us</a></li> 
            
        </ul>

        <ul class="nav navbar-nav pull-right">

            <?php if (!isset($_SESSION['logged_in'])): ?>
            <li id="login" ><a href="login.php"><strong>Login</strong></a>
            <li id="register "><a href="register.php"><strong>Register</strong></a>

                <?php elseif (isset($_SESSION['logged_in'])): ?>
            <li id="logout" ><a href="logout.php"><strong>Logout</strong></a>
                <?php endif; ?>


        </ul>
    </div>

</nav>
