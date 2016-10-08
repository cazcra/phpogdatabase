<?php
include_once 'dbcon.php';

$sql = "select client_name, client_id 
from clients"; 

$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($client_name, $client_id);

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
    <h1>Klienter</h1>
   <ul>
    <?php
    while ($stmt->fetch()) 
    {
        echo '<li>';
            echo '<a href="client.php?client='.$client_id.'">'.$client_name.'</a>';
        echo '</li>';
    }
    ?>
    </ul>
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