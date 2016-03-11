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
    $userEmail = unserialize($_SESSION['userEmail']);
    
    $_SESSION['userEmail'] = serialize($userEmail);
   
}
?>
<nav class="navbar navbar-default navbar-stati-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li> 
            <? if(isset($_SESSION['userRole']) && $_SESSION['userRole']=='employer'): ?>
            <li><a href="#">View Applications</a></li>
            <li><a href="addinternship.php">Add Internship</a></li> 
            <? elseif(isset($_SESSION['userRole']) && $_SESSION['userRole']=='student'): ?>
            <li><a href="#"></a></li>
            <li><a href="#">Page 2</a></li> 
            <? endif ?>
        </ul>

        <ul class="nav navbar-nav pull-right">

            <? if (!isset($_SESSION['logged_in'])): ?>
            <li id="login"><a href="login.php">Login</a>
            <li id="register "class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Register</a>
          <ul class="dropdown-menu" role="menu">
              <li>
                  <button>Hello</button>
              </li>
              <li>
                  <button>HI</button>
              </li>
          </ul>
        </li>
               <? elseif (isset($_SESSION['logged_in'])): ?>
            <li id="logout"><a href="logout.php">Logout</a>
                <? endif; ?>


        </ul>
    </div>
</nav>