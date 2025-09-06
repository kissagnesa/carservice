<?php
require("modules/data_check.php");
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Autószerviz napló</title>
	
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="banner">
        <div>
           <a href="index.php">Autószerviz napló</a>
        </div>
        <div>
            <?php
			$today=date("Y.m.d");

			$date=getdate();
			
			$days=array("Vasárnap","Hétfő","Kedd","Szerda","Csütörtök","Péntek","Szombat");

			$day_of_week=$date["wday"];

			echo( $today." , ".$days[$day_of_week] );
			?>
        </div>

    </div>

    <form class="search_form">
        <label for="">Név: <input type="text" name="name"></label>
        <label for="">Okmányszám: <input type="text" name="card_number"></label>
        <button type="submit">Keresés</button>
    </form>
    <div id="search_result"></div>
    <?php
    include("modules/get_clients.php");
    ?>  
  </body>
</html>