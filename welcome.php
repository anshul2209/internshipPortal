<?php
require_once 'generic.php';

//check to see if they're logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

//get the user object from the session
$userEmail = unserialize( $_SESSION['userEmail']);
?>

<html>
    <head>
        <title>Welcome <?php echo $userEmail; ?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>


    <body>
        <script src="js/jquery-2.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        Hey there, <?php echo $userEmail; ?>. You've been registered and logged in as <?php echo $_SESSION['userRole'] ?> . Welcome! <a href="logout.php">Log Out</a> | <a href="index.php">Return to Homepage</a>
    </body>
</html>