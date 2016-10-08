<?php

// inkludere database forbindelse
include_once 'dbcon.php';

// hent projekt id fra url med GET metode
$projektid = $_GET['projekt'];

// Kør Query / forespørgsel på projekt info
$projektinfo = "SELECT project_name, project_description FROM projects WHERE project_id = ?";

$prostmt = $link->prepare($projektinfo);
$prostmt->bind_param("i", $projektid);
$prostmt->execute();
$prostmt->bind_result($projektnavn, $projektbeskrivelse);
$prostmt->fetch();


?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP">
    <meta name="author" content="Casper Ragn">
    <title>Casper Ragn - PHP - CPHBUSINESS</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MY CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Font awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">
    <?php
    //inkludere nav på siden
        include 'menu.php';
    
    ?>
    <h1><?=  $projektnavn ?></h1>
    <p><?= $projektbeskrivelse ?></p>
    
    <script>
    document.write('<a href="' + document.referrer + '" class="btn btn-info">Tilbage</a>');
    </script>
    <!-- Dette er SLETTE knappen -->
    <a onclick="return confirm('Er du sikker på du vil slette dette projekt?')" href="deleteproject.php?projekt=<?= $projektid ?>" class="btn btn-info">Slet Projekt</a>
    
 <hr>
 <h4>Opdater Projektbeskrivelse</h4>
    <form action="update.php" method="POST">
    <textarea type="text" name="editprojekt" placeholder="beskrivelse"></textarea>
    <input hidden="true" type="number" name="projektid" value="<?= $projektid?>">
<br>
    <input onclick="return confirm('Er du sikker på du vil opdatere beskrivelsen?')" style="margin-top: 20px" type="submit" name="submit" value="Opdater beskrivelse" class="btn btn-info">    

</form>
 <hr> 

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Casper Ragn 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>