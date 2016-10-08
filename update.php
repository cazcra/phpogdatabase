<?php

include_once 'dbcon.php';

$projektid = $_POST['projektid'];
$editprojekt = $_POST['editprojekt'];
$editprojekt = strip_tags($editprojekt);

$updatedescription = "UPDATE projects SET project_description = ? WHERE project_id = ?";

$updatestmt = $link->prepare($updatedescription);
$updatestmt->bind_param("si", $editprojekt, $projektid);  
$updatestmt->execute();
header("Location: projekt.php?projekt=".$projektid.'"'); 

?>