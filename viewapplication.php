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

        <div class="container">
            <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole']=='student'): ?>
            <div class = "row">
                <?php
                $user = unserialize($_SESSION['userEmail']);
                $db = new database();
                $sql = "SELECT  internship.* FROM internship RIGHT JOIN studentinternship ON internship.jobid = studentinternship.jobid WHERE email ='$user'";
                $queryresult = mysql_query($sql)or die(mysql_error());

                $result = $db->process($queryresult);
                foreach ($result as $value) {
                    $jobid = $value['jobid'];
                    echo
                    "<div class='col-md-4'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>
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

            <?php elseif(isset($_SESSION['userRole']) && $_SESSION['userRole']=='employer'): ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="text-danger"><strong>Applications Received</strong></h3><br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-condensed small">

                    <thead>
                        <tr>
                            <th class="text-primary text-center"><strong>Internship Id</strong></th>
                            <th class="text-primary text-center"><strong>Profile</strong></th>
                            <th class="text-primary text-center"><strong>Company Name</strong></th>
                            <th class="text-primary text-center"><strong>Student Email</strong></th>
                        </tr>
                    </thead>
                    <?php
                    $db1 = new database();
                    $user1 = unserialize($_SESSION['userEmail']);

                    $sql1 = "SELECT  * FROM internship RIGHT JOIN studentinternship ON internship.jobid = studentinternship.jobid WHERE employeremail ='$user1'";
                    
                    $queryresult1 = mysql_query($sql1)or die(mysql_error());
                    $result1 = $db1->process($queryresult1);
                    foreach ($result1 as $value1) {
                        $jobid = $value1['jobid'];
                        echo "<tr>
            <td class='text-center'>".$value1['jobid']."</td>
            <td class=' text-center'>".$value1['profile']."</td>
            <td class=' text-center'>".$value1['companyname']."</td>
            <td class=' text-center'>".$value1['email']."</td>
        </tr>";
                    }
                    ?>
                </table>
            </div>
                </div>
        </div>
            <?php else : ?>
            <p>Nothing To display</p>
            <?php endif ?>



        </div>
        


    </body>
</html>