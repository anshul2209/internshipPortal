<?php
//User.class.php
 
require_once 'database.class.php';
 
 
class student {
 
    public $studentfullname;
    public $studentemail;
    public $studentpassword;
    public $qualification;
    public $profile;
    public $city;
    public $studentphone;

    //Constructor is called whenever a new object is created.
    //Takes an associative array with the DB row as an argument.
    function __construct($data) {
        $this->studentfullname = (isset($data['studentfullname'])) ? $data['studentfullname'] : "";
        $this->studentemail = (isset($data['studentemail'])) ? $data['studentemail'] : "";
        $this->studentpassword = (isset($data['studentpassword'])) ? $data['studentpassword'] : "";
        $this->qualification = (isset($data['qualification'])) ? $data['qualification'] : "";
        $this->profile = (isset($data['profile'])) ? $data['profile'] : "";
        $this->city = (isset($data['city'])) ? $data['city'] : "";
        $this->studentphone = (isset($data['studentphone'])) ? $data['studentphone'] : "";
    }

    public function save() {
        //create a new database object.
        $db = new database();
  
        //if the user is being registered for the first time.
            $data = array(
                "fullname" => "'$this->studentfullname'",
                "email" => "'$this->studentemail'",
                "qualification" => "'$this->qualification'",
                "profile" => "'$this->profile'",
                "password" => "'$this->studentpassword'",
                "city" => "'$this->city'",
                "phone" => "'$this->studentphone'",
            );
            $userData =array(
                
                "password" => "'$this->studentpassword'",
                "email" => "'$this->studentemail'",
                "role" => "'student'"
            );
            
            $this->id = $db->insert($data, 'student');
            $this->id2 = $db->insert($userData, 'user');
            //$this->joinDate = time();
        
        return true;
    }
    
}
class employer {
 
    public $employerfullname;
    public $companyname;
    public $employerphone;
    public $employeremail;
    public $employerpassword;
 
    //Constructor is called whenever a new object is created.
    //Takes an associative array with the DB row as an argument.
    function __construct($data) {
        $this->employerfullname = (isset($data['employerfullname'])) ? $data['employerfullname'] : "";
        $this->companyname = (isset($data['companyname'])) ? $data['companyname'] : "";
        $this->employerphone = (isset($data['employerphone'])) ? $data['employerphone'] : "";
        $this->employeremail = (isset($data['employeremail'])) ? $data['employeremail'] : "";
        $this->employerpassword = (isset($data['employerpassword'])) ? $data['employerpassword'] : "";
    }
 
    public function save() {
        //create a new database object.
        $db = new database();
        
        
        //if the user is being registered for the first time.
            $data = array(
                "fullname" => "'$this->employerfullname'",
                "companyname" => "'$this->companyname'",
                "phone" => "'$this->employerphone'",
                "email" => "'$this->employeremail'",
                "password" => "'$this->employerpassword'",
            );
            $userData =array(
                
                "password" => "'$this->employerpassword'",
                "email" => "'$this->employeremail'",
                "role" => "'employer'"
            );
            
            $this->id = $db->insert($data, 'employer');
            $this->id2 = $db->insert($userData, 'user');
           // $this->joinDate = time();
        
        return true;
    }
    
}
class internship {
 
    public $companyname;
    public $duration;
    public $deadline;
    public $profile;
    public $startdate;
    public $city;


    //Constructor is called whenever a new object is created.
    //Takes an associative array with the DB row as an argument.
    function __construct($data) {
        $this->companyname = (isset($data['companyname'])) ? $data['companyname'] : "";
        $this->duration = (isset($data['duration'])) ? $data['duration'] : "";
        $this->deadline = (isset($data['deadline'])) ? $data['deadline'] : "";
        $this->profile = (isset($data['profile'])) ? $data['profile'] : "";
        $this->city = (isset($data['city'])) ? $data['city'] : "";
        $this->startdate = (isset($data['startdate'])) ? $data['startdate'] : "";
    
    }
 
    public function save() {
        //create a new database object.
        $db = new database();
        $userEmail = unserialize($_SESSION['userEmail']);
      
        $result=$db->select('employer', "email='$userEmail'");
        $companyname=$result[0]['companyname'];
        //if the user is being registered for the first time.
            $data = array(
                
                "companyname" => "'$companyname'",
                "duration" => "'$this->duration'",
                "deadline" => "'$this->deadline'",
                "profile" => "'$this->profile'",
                "employeremail" => "'$userEmail'",
                "city"=>"'$this->city'",
                "startdate"=>"'$this->startdate'"
            
            );
            
            $this->id = $db->insert($data, 'internship');
           // $this->joinDate = time();
        
        return true;
    }
    
}
 
?>