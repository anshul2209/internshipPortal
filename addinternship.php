<?php
//register.php
require_once 'generic.php';
//initialize php variables used in the form
$duration = "";
$deadline = "";
$profile = "";
$employeremail = "";
$error="";

//check to see that the form has been submitted
if(isset($_POST['submit-addinternship'])) { 
 
    //retrieve the $_POST variables
   
    $duration = $_POST['duration'];
    $deadline = strtotime($_POST['deadline']);
    $deadline = date('Y-m-d H:i:s', $deadline);
    $profile = $_POST['profile'];
   
    //initialize variables for form validation
    $success = true;
    $session = new session();
 
    //validate that the form was filled out correctly
    //check to see if user name already exists
   
    //check to see if passwords match
    
   


    if($success)
 {
        //prep the data for saving in a new user object
        
        $data['duration'] = $duration;
        $data['deadline'] = $deadline; 
        $data['profile'] = $profile;
      
       
        //create the new user object
        $newInternobject= new internship($data);

        //save the new user to the database
        if($newInternobject->save()){
            
            
            $error .="Added";
        }

        //log them i

        //redirect them to a welcome page
        header("Location: addinternship.php");
        
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <title>Add Internship</title>
    </head>
    <body>
        <script src="js/jquery-2.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <div class="row">
        </div>

<?php echo ($error != "") ? $error : ""; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4" id="addinternship" >
                    <form action="addinternship.php" method="post" role="form">
                    
                        <div class="form-group">
                            <label for="duration">Duration(in months) :</label>
                            <input type="text" value="<?php echo $duration; ?>"  class="form-control" id="duration" name="duration">
                        </div>
                        <div class="form-group">
                            <label for="deadline">Deadline :</label>
                            <input type="date" value="<?php echo $deadline; ?>" class="form-control" id="deadline" name="deadline">
                        </div>
                        <div class="form-group">
                            <label for="profile">Profile :</label>
                            <input type="text" value="<?php echo $profile; ?>"  class="form-control" id="profile" name="profile">
                        </div>
                        <button type="submit" class="btn btn-default" name="submit-addinternship">Post</button>
                    </form>
                </div>

            </div>
        </div>
    </body>
</html>