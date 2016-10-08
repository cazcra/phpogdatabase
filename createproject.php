<?php

include_once 'dbcon.php';

$clientid = $_POST['clientid'];
$projectname = $_POST['projectname'];
$projectdescription = $_POST['projectdescription'];

$createproject = "INSERT INTO projects (project_name, project_description, client_id) VALUES (?,?,?)";

$createstmt = $link->prepare($createproject);
$createstmt->bind_param("ssi", $projectname, $projectdescription, $clientid);
$createstmt->execute();

header("Location: client.php?client=".$clientid.'"');

?>