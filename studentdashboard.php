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
            <input type="hidden" id="useremail" value="<?php echo unserialize($_SESSION['userEmail']); ?>"/>
            <input type="hidden" id="userrole" value="<?php echo $_SESSION['userRole']; ?>"/>
            Hello, <?php echo $user ?>. You are logged in. <a href="logout.php">Logout</a>
        <?php endif; ?>

        <div class="container-fluid">

            <div class = "row">
                <?php
                $user = unserialize($_SESSION['userEmail']);
                $db = new database();
                $sql = "SELECT * FROM internship WHERE jobid NOT IN(SELECT jobid FROM studentinternship WHERE email='$user')";
                
              
                $queryresult = mysql_query($sql)or die(mysql_error());
                $result = $db->process($queryresult);
                foreach ($result as $value) {
                    
                    $jobid = $value['jobid'];
                    
                    echo
                    "<div class='col-md-3'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>
                                <h3 class='panel-title pull-left'>"
                    . $value['companyname'] .
                    " </h3>
                                
                                <button class='btn btn-default pull-right post' id='$jobid'>Apply</button>
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
                                    <div class='col-md-8'>" . $value['duration'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'>Profile :</div>
                                    <div class='col-md-8'>" . $value['profile'] . "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'>Deadline : :</div>
                                    <div class='col-md-8'>" . $value['deadline'] . "</div>
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
                  $('.post').click(function () {
                $.ajax({
                    url: 'saveinternship.php',
                    type: 'post',
                    data: {clickeddiv: $(this).attr('id'),
                        email: $("#useremail").val()
                    },
                    success: function (success) {
                        if(success == 0)
                        alert("Please try after sometime");
                    else
                        window.location="studentdashboard.php";
                    } // or whatever you want as success, maybe here nothing 

                });
            });

            </script>
    </body>
</html>