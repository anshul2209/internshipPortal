<?php
require_once 'generic.php';
if(isset($_SESSION['logged_in']) && $_SESSION["userRole"] == 'student'){
            header ("Location: studentdashboard.php");
        //successful login, redirect them to a page
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
        <div class="container-fluid">
            <div class="row">
                <?php if (isset($_SESSION['logged_in'])) : ?>
                    <?php $user = unserialize($_SESSION['userEmail']); ?>
                    <input type="hidden" id="useremail" value="<?php echo unserialize($_SESSION['userEmail']); ?>"/>
                    <input type="hidden" id="userrole" value="<?php echo $_SESSION['userRole']; ?>"/>
                    <label class="pull-right  bg-success">Hello, <?php echo $user ?>. You are logged in.</label>
                <?php endif; ?>
            </div>
            <?php
            $db = new database();
            $result = $db->select('internship', "deadline >= CAST(CURRENT_TIMESTAMP AS DATE)");
            ?>


            <div class = "row">
                <?php
                foreach ($result as $value) {
                    $jobid = $value['jobid'];
                    echo
                    "<div class='col-md-3'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>
                                <h1 class='panel-title pull-left'><strong class='text-danger'>"
                    . $value['profile'] .
                    "</strong> </h1>
                        
                                <button class='btn btn-default pull-right post' id='$jobid'>Apply</button><br>
                                    <h3 class='panel-title pull-left'><strong>"
                    . $value['companyname'] .
                    "</strong> </h3>
                                
                                <div class='clearfix'></div>
                            </div>
                            <div class='panel-body'>
                                <div class='row'>
                                    <div class='col-md-4'>City :</div>
                                    <div class='col-md-8'>" . $value['city'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'>Start Date :</div>
                                    <div class='col-md-8'>" . $value['startdate'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'>Duration :</div>
                                    <div class='col-md-8'>" . $value['duration'] . "  months</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'>Profile :</div>
                                    <div class='col-md-8'>" . $value['profile'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'>Deadline :</div>
                                    <div class='col-md-8'><label class='bg-primary'>" . $value['deadline'] . "</label></div>
                                </div>
                            </div>
                        </div>
                    </div>"

                    ;
                }
                ?>
                

            </div>
        </div>
        <script>
            $(document).ready(function () {
                if ($("#userrole").val() == 'employer') {
                    $('.post').hide();

                }
                $('.post').click(function () {
                    
                    window.location="login.php";
                });

  });

          
        </script>
        <p id="result"></p>
    </body>
</html>

