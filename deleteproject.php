<?php
	
include_once 'dbcon.php';

$pid = $_GET['projekt'];
#echo $pid;

$deleteproject = "DELETE FROM projects WHERE project_id = ?";

$delstmt = $link->prepare($deleteproject);
$delstmt->bind_param("i", $pid);
$delstmt->execute();

header("Location: read.php");

?>