<?php
include("../connect.php");

echo("<script src='car_onclick.js'></script>");

$cid = $_GET["id"];

$stmt=$connect->prepare("select c.*,(select s.event from services s where s.car_id=c.id order by log_number desc limit 1) as last_event, (select s.event_time from services s where s.car_id=c.id order by log_number desc limit 1) as last_time from cars c where c.client_id=?");

$stmt->execute([$cid]);
$cars = $stmt->get_result();

        echo ("<table>");
        echo ("<tr>");
        echo ("<th>Sorszám</th>");
        echo ("<th>Típus</th>");
        echo ("<th>Regisztráció</th>");
        echo ("<th>Saját márkás</th>");
        echo ("<th>Balesetek száma</th>");
        echo ("<th>Utolsó szervíz bejegyzés</th>");
        echo ("<th>Időpont</th>");
        echo ("</tr>");

        foreach ($cars as $car)
        {
            echo ("<tr>");
            echo ("<td><a href='#' class='car data-id='{$car['id']}'>{$car['id']}</a></td>");
            echo ("<td>{$car['registered']}</td>");
            echo ("<td>".($car['ownbrand']?"igen":"nem")."</td>");
            echo ("<td>{$car['accidents']}</td>");
            echo ("<td>{$car['last_event']}</td>");
            echo ("<td>".($car['last_event']=='regisztralt' ? $car['registered'] : $car['last_time'])."</td>");
            echo ("</tr>");
        }
        echo("</table>");
?>

