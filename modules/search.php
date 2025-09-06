<?php
include("../connect.php");

$name=trim($_POST["name"]);
$card=trim($_POST["card_number"]);

if(($name== "" && $card=="") || ($name!="" && $card!=""))
{
    echo("Hiba! Egyszerre egy mező használható!");
    exit;
}

if($card!="" && !preg_match('/^[a-zA-Z0-9]+$/',$card))
{
    echo("Hiba! Az okmányszám speciális karaktert nem tartalmazhat!");
    exit;
}

if($card!="")
{
    $query=$connect->prepare("select * from clients where card_number=?");
    $query->bind_param("s",$card);
}
else
{
    $like=$name."%";
    $query=$connect->prepare("select * from clients where name like ?");
    $query->bind_param("s",$like);
}

$query->execute();
$result=$query->get_result();
$clients=$result->fetch_all(MYSQLI_ASSOC);

if(count($clients)==0)
{
    echo("A névre keresve nincs találat!");
    exit;
}

if(count($clients)> 1)
{
    echo("A megadott névvel több ügyfél szerepel az adatbázisban, kérlek, okmányra keress!");
    exit;
}

$client=$clients[0];

$carCount = $connect->query("SELECT COUNT(*) FROM cars WHERE client_id=".$client['id'])->fetch_row()[0];
$logCount = $connect->query("SELECT COUNT(*) FROM services WHERE client_id=".$client['id'])->fetch_row()[0];

echo("
<p>
ID: {$client['id']}<br>
Név: {$client['name']}<br>
Okmányszám: {$client['card_number']}<br>
Autók száma: $carCount<br>
Összes szerviznapló: $logCount
</p>
")

?>