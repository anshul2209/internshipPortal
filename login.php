<?php
require_once 'generic.php';

$error = "";
$email = "";
$password = "";

//check to see if they've submitted the login form
if (isset($_POST['submit-login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $session = new session();
    if ($session->login($email, $password)) {
        header("Location: index.php");
    } else {
        $error = "Incorrect username or password. Please try again.";
    }
}
?>

<html>
    <head>
        <title>Internship Project</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <script src="js/jquery-2.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <?php
        if ($error != "") {
            echo $error . "<br/>";
        }
        ?>
        <div class="container">
            <div class="col-md-6" id="employerregister">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3  class=" panel-title pull-left">
            <strong> Login</strong>
        </h3>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <form action="login.php" method="post" role="form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" value="<?php echo $email; ?>" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" value="<?php echo $password; ?>"  class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-default" name="submit-login">Login</button>
        </form>
    </div>
    <div class="panel-footer">
        <div class="pull-right"><strong>New User ?</strong>&nbsp;&nbsp&nbsp;&nbsp;<a href="register.php"><button type="button" class="btn btn-success">Register</button></a></div>
    <div class="clearfix"></div>
    </div>
</div>

            </div>
        </div>
    </body>
</html>

