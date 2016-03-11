<?php
require_once 'generic.php';
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
        <?php if (isset($_SESSION['logged_in'])) : ?>
            <?php $user = unserialize($_SESSION['userEmail']); ?>
            Hello, <?php echo $user ?>. You are logged in. <a href="logout.php">Logout</a>
        <?php else : ?>
            You are not logged in. <a href="login.php">Log In</a> | <a href="register.php">Register</a>
        <?php endif; ?>

        <?php
        $db = new database();
        $result = $db->select('internship', "deadline >= CAST(CURRENT_TIMESTAMP AS DATE)");
        ?>
        <div class="container">

            <div class="row">




<?php
foreach ($result as $value) {
    $jobid = $value['jobid'];
    echo
    "<div class='col-md-3'>
        <div class='well'>
               Company Name:<h4 class='text-danger'>". $value['companyname'] . "</h4><br>
               Profile:<h4 class='text-danger'><span class='label label-danger pull-right'>".$value['deadline']."</span>" . $value['profile'] . "</h4><br>
               Company Name:<h4 class='text-danger'>". $value['duration'] . "</h4><br>
               Company Name:<h4 class='text-danger'>". $value['duration'] . "</h4><br>
<button class='btn btn-default' id='$jobid'>Apply</button>        
</div>
        
     </div>"
      ;
}

?>

            </div>
        </div>
        <script>
            $(function () {
                $('.column').click(function () {
                    $.ajax({
                        url: 'somefile.php',
                        type: 'post',
                        data: {clickeddiv: $(this).attr('id')},
                        success: function (e) {
                            alert('saved');
                        } // or whatever you want as success, maybe here nothing 

                    });
                });
            });
        </script>

    </body>
</html>