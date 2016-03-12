<?php

require_once 'generic.php';

$session = new session();
$session->logout();

header("Location: index.php");
?>