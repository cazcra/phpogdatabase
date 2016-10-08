<?php
$msg ="";

require_once 'dbcon.php';
$zipcodes = "SELECT  zip_id, city_name from zip_code"; $zipstmt = $link->prepare($zipcodes);


// Tjekker om submit er blevet trykket
if (isset($_POST["ADD_client"]))
{
    $client_name = $_POST ['client_name'];
    $client_contact = $_POST ['client_contact_name'];
    $client_phone = $_POST ['client_contact_phone'];
    $client_address = $_POST ['client_address'];
    $zip = $_POST ['zip_code'];
    
    


$sql = "insert into clients (zip_code, client_name, client_contact_name, client_contact_phone, client_address)
Values (?,?,?,?,?);";
$stmt = $link->prepare($sql);
$stmt->bind_param('issis', $zip, $client_name, $client_contact, $client_phone, $client_address);
$stmt->execute();
  
$msg = 'Klient er nu oprettet';
}
?><!DOCTYPE html>
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

    <!-- Navigation -->
  
   <!--Her var min navigation. Denne har jeg klippet ud og flyttet den over i et seperat dokument som jeg har kaldt menu.php for at den bliver vist på min side har jeg neden under indkluderet filen menu.php-->
   <?php
    //inkludere nav på siden
        include 'menu.php';
    
    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Velkommen!</h1>
            <p>Her kan du oprette dig som klient</p><br>
            <!--<p>Klik i menuen for at se de forskellige opgaver.</p>-->
            <p><!--<a class="btn btn-primary btn-large">Call to action!</a>-->
            </p>
        </header>

 
      
       <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
        <input type="text" name="client_name" placeholder="Firma Navn"><br><br>
        <input type="text" name="client_contact_name" placeholder="Kontakt person"><br><br>
        <input type="text" name="client_contact_phone" placeholder="Telefon"><br><br>
         <input type="text" name="client_address" placeholder="Adresse"><br><br>
        <select name="zip_code" id="">
            <?php
    
            $zipstmt->execute();

             $zipstmt->bind_result($zipcode, $cityname);
             
            while($zipstmt->fetch())
            {
            ?>
            <option value="<?=$zipcode?>"><?= $zipcode .' '. $cityname ?></option>
            <?php    
            }
             $zipstmt->close();
            ?>
        </select>
        <br><br>
        <input class="btn btn-info" name="ADD_client" type="submit" value="Opret klient">   <a href="read.php" class="btn btn-info">Gå til klienter</a>
    </form>

        <p>
    <?php echo $msg; ?>
    </p>

        

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