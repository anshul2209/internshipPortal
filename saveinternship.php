<?php

require_once 'generic.php';

if (!isset($_SESSION['logged_in'])) {
    echo 0;
} else {

    $jobid = $_POST['clickeddiv'];
    $email = $_POST['email'];




    $db = new database();

    if ($db->connect()) {
        $data = array(
            "jobid" => "'$jobid'",
            "email" => "'$email'"
        );

        $id = $db->insert($data, 'studentinternship');
        echo $jobid;
    } else {
        echo 'could not connect';
    }
}
?>