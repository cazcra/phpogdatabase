<?php

include_once 'dbcon.php';
/*
if(isset($_GET['client']))
{*/
    $clientid = $_GET['client'];

    //echo $clientid;
        
    $sql = "SELECT c.client_name, c.client_address, c.client_contact_name, c.client_contact_phone, zc.city_name FROM clients c, zip_code zc 
    WHERE c.client_id = ? 
    AND c.zip_code = zc.zip_id"; 

    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $clientid);
    $stmt->execute();
    $stmt->bind_result($client_name, $client_address, $clientcontactname, $clientcontactphone, $cityname);
    $client = $stmt->fetch();
    $stmt->close();

$projekter = "SELECT  project_name, project_id FROM projects WHERE client_id = ?";
    $prostmt = $link->prepare($projekter);
    $prostmt->bind_param("i", $clientid);


/*        
} 
*/
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
    <h1>Klient Info</h1>
    
    <p><?= $client_name ?></p>
    <p><?= $clientcontactname ?></p>
    <p><?= $clientcontactphone ?></p>
    <p><?= $client_address ?></p> 
    <p><?= $cityname ?></p>
<h1>Projekter</h1>
<?php
    
            $prostmt->execute();

            $prostmt->bind_result($projektnavn, $projektid);
             
            while($prostmt->fetch())
            {
            ?>
            <a href="projekt.php?projekt=<?=$projektid?>"><?= $projektnavn ?>,</a>
                    
            <?php    
            }
            $prostmt->close();
            ?>
            <br><br>
                <a href="read.php" class="btn btn-info">Tilbage</a>
    </form>
    
<hr>
<h3>Opret projekt</h3>
<form action="createproject.php" method="POST">
    <input type="text" name="projectname" placeholder="Projektnavn">
    <br>
    <textarea style="margin-top: 20px" type="text" name="projectdescription" placeholder="Projektbeskrivelse"></textarea>
    <input hidden="true" type="number" name="clientid" value="<?= $clientid ?>">
    <br>
    <input style="margin-top: 20px" type="submit" name="submit" value="Submit" class="btn btn-info">
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