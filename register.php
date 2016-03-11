
<?php
//register.php
require_once 'generic.php';
//initialize php variables used in the form
$studentfullname="";
$studentemail = "";
$studentpassword = "";
$studentconfirmpassword = "";
$qualification = "";
$profile = "";
$city = "";
$studentphone = "";
$error = "";
$employerfullname="";
$employeremail="";
$employerpassword="";
$employerconfirmpassword="";
$employerphone="";
$companyname="";
 
//check to see that the form has been submitted
if(isset($_POST['submit-studentform'])) { 
 
    //retrieve the $_POST variables
    $studentfullname = $_POST['studentfullname'];
    $studentemail = $_POST['studentemail'];
    $studentpassword = $_POST['studentpassword'];
    $studentconfirmpassword = $_POST['studentconfirmpassword'];
    $qualification = $_POST['qualification'];
    $profile = $_POST['profile'];
    $city = $_POST['city'];
    $studentphone = $_POST['studentphone'];
 
    //initialize variables for form validation
    $success = true;
    $session = new session();
 
    //validate that the form was filled out correctly
    //check to see if user name already exists
    if($session->checkEmailExists($studentemail))
    {
        $error .= "That Email is already registered please login.<br/> \n\r";
        $success = false;
    }
 
    //check to see if passwords match
    if($studentpassword != $studentconfirmpassword) {
        $error .= "Passwords do not match.<br/> \n\r";
        $success = false;
    }
 
    if($success)
 {
        //prep the data for saving in a new user object
        $data['studentfullname'] = $studentfullname;
        $data['studentemail'] = $studentemail;
        $data['studentpassword'] = md5($studentpassword); //encrypt the password for storage
        $data['qualification'] = $qualification;
        $data['profile'] = $profile;
        $data['city'] = $city;
        $data['studentphone'] = $studentphone;
       
        //create the new user object
        $newStudent= new student($data);

        //save the new user to the database
        $newStudent->save();

        //log them in
        if($session->login($studentemail, $studentpassword)){

        //redirect them to a welcome page
        header("Location: welcome.php");
        }
    }
}
if(isset($_POST['submit-employerform'])) { 
 
    //retrieve the $_POST variables
    $employerfullname = $_POST['employerfullname'];
    $employeremail = $_POST['employeremail'];
    $employerpassword = $_POST['employerpassword'];
    $employerconfirmpassword = $_POST['employerconfirmpassword'];
    $employerphone = $_POST['employerphone'];
    $companyname= $_POST['companyname'];
    //initialize variables for form validation
    $success = true;
    $session = new session();
 
    //validate that the form was filled out correctly
    //check to see if user name already exists
    if($session->checkEmailExists($employeremail))
    {
        $error .= "That Email is already registered please login.<br/> \n\r";
        $success = false;
    }
 
    //check to see if passwords match
    if($employerpassword != $employerconfirmpassword) {
        $error .= "Passwords do not match.<br/> \n\r";
        $success = false;
    }
 
    if($success)
 {
        //prep the data for saving in a new user object
        $data['employerfullname'] = $employerfullname;
        $data['employeremail'] = $employeremail;
        $data['employerpassword'] = md5($employerpassword); //encrypt the password for storage
        $data['employerphone'] = $employerphone;
        $data['companyname'] = $companyname;
        //create the new user object
        $newEmployer = new employer($data);

        //save the new user to the database
        $newEmployer->save();

        //log them in
       if($session->login($employeremail, $employerpassword)) {

        
        header("Location: welcome.php");
       }
    }
}
 
//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
 
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <title>Registration</title>
    </head>
<body>
    <script src="js/jquery-2.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <div class="row">
    </div>
  
    <?php echo ($error != "") ? $error : ""; ?>
    <div class="container">

        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" name="student" id="student" class="btn btn-success">I'm a Student!</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" name="employer" id="employer" class="btn btn-success">I'm an Employer!</button>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12" id="studentregister" >
                        <form action="register.php" method="post" role="form">
                            <div class="form-group">
                                <label for="fullname">Full Name:</label>
                                <input type="text" value="<?php echo $studentfullname; ?>" class="form-control" id="fullname" name="studentfullname">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" value="<?php echo $studentemail; ?>"  class="form-control" id="email" name="studentemail">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" value="<?php echo $studentpassword; ?>" class="form-control" id="password" name="studentpassword">
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password:</label>
                                <input type="password" value="<?php echo $studentconfirmpassword; ?>"  class="form-control" id="studentconfirmpassword" name="studentconfirmpassword">
                            </div>
                            <div class="form-group">
                                <label for="qualification">Highest Qualification :</label>
                                <input type="text" value="<?php echo $qualification; ?>"  class="form-control" id="qualification" name="qualification">
                            </div>
                            <div class="form-group">
                                <label for="profile">Profile:</label>
                                <input type="text" value="<?php echo $profile; ?>"  class="form-control" id="profile" name="profile">
                            </div>
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" value="<?php echo $city; ?>"  class="form-control" id="city" name="city">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" value="<?php echo $studentphone; ?>"  class="form-control" id="phone" name="studentphone">
                            </div>

                            <button type="submit" class="btn btn-default" name="submit-studentform">Register Me</button>
                        </form>
                    </div>
                    <div class="col-md-12" id="employerregister">
                        <form action="register.php" method="post" role="form">
                            <div class="form-group">
                                <label for="employerfullname">Full Name:</label>
                                <input type="text" value="<?php echo $employerfullname; ?>" class="form-control" id="employerfullname" name="employerfullname">
                            </div>
                            <div class="form-group">
                                <label for="employeremail">Email address:</label>
                                <input type="email" value="<?php echo $employeremail; ?>"  class="form-control" id="employeremail" name="employeremail">
                            </div>
                            <div class="form-group">
                                <label for="employerpassword">Password:</label>
                                <input type="password" value="<?php echo $employerpassword; ?>" class="form-control" id="employerpassword" name="employerpassword">
                            </div>
                            <div class="form-group">
                                <label for="employerconfirmpassword">Confirm Password:</label>
                                <input type="password" value="<?php echo $employerconfirmpassword; ?>"  class="form-control" id="employerconfirmpassword" name="employerconfirmpassword">
                            </div>
                            <div class="form-group">
                                <label for="companyname">Company Name :</label>
                                <input type="text" value="<?php echo $companyname; ?>"  class="form-control" id="companyname" name="companyname">
                            </div>

                            <div class="form-group">
                                <label for="employerphone">Phone Number:</label>
                                <input type="text" value="<?php echo $employerphone; ?>"  class="form-control" id="employerphone" name="employerphone">
                            </div>

                            <button type="submit" class="btn btn-default" name="submit-employerform">Register Me</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <script type="javascript/text">
     $("#student").click(function() {
            $('#employerregister').toggle();
            $('#studentregister').toggle();
        }
     $("#employer").click(function() {
         $('#studentregister:visible').hide();
            $('#employerregister:visible').show();
            
           
     }
    </script>
</body>
</html>

