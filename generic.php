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
if(isset($_SESSION['logged_in'])) {
    $user = unserialize($_SESSION['user']);
    $_SESSION['user'] = serialize($session->get($user->email));
}
?>
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li> 
      <li><a href="#">Page 3</a></li> 
    </ul>
      <ul class="nav navbar-nav pull-right">
          <li id="login"><a href="#">Login</a>
          <li id="register"><a href="register.php">Register</a>
          
      </ul>
  </div>
</nav>