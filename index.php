<?php
require_once 'generic.php';
if (isset($_SESSION['logged_in']) && $_SESSION["userRole"] == 'student') {
    header("Location: studentdashboard.php");
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
                    <label class="pull-right text-primary">Hello, <?php echo $user ?>. You are logged in.</label>
                <?php endif; ?>
            </div>
            <div class="row">
                <br>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">

                        <div class="item active"> 
                            <img src="./resources/2.jpg" alt="2"  class="img-responsive center-block" >

                        </div>

                        <div class="item">
                            <img src="./resources/1.jpg" alt="1"   class="img-responsive center-block" >

                        </div>

                        <div class="item">
                            <img src="./resources/3.jpg" alt="3"  class="img-responsive center-block" >

                        </div>

                        <div class="item">
                            <img src="./resources/4.jpg" alt="4"  class="img-responsive center-block" >

                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>




            <br><br>
            <?php
            $db = new database();
            $result = $db->select('internship', "jobid > 0 ");
            ?>


            <div class = "row">
                <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="text-danger"><strong>Current Openings</strong></h3><br>
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
                                    <div class='col-md-4'><label class='text-success'><strong>City :</strong></label></div>
                                    <div class='col-md-8'>" . $value['city'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'><label class='text-success'><strong>Start Date :</strong></label></div>
                                    <div class='col-md-8'>" . $value['startdate'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'><label class='text-success'><strong>Duration :</strong></label></div>
                                    <div class='col-md-8'>" . $value['duration'] . "  months</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'><label class='text-success'><strong>Profile :</strong></label></div>
                                    <div class='col-md-8'>" . $value['profile'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'><label class='text-success'><strong>Deadline :</strong></label></div>
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
                
                
                
                
                </div>   
                
               


            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.carousel').carousel({
                    interval: 1000 * 2
                });
                if ($("#userrole").val() == 'employer') {
                    $('.post').hide();

                }
                $('.post').click(function () {

                    window.location = "login.php";
                });

            });


        </script>
        <p id="result"></p>
    </body>
</html>


