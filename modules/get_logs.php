<?php
include("../connect.php");

$carid = isset($_GET["id"]) ? (int) $_GET["id"] :0;

$stmt = $connect->prepare("select * from services where car_id = ? order by log_number");
$stmt->bind_param("i", $carid);
$stmt->execute();
$result = $stmt->get_result();

        echo ("<table>");
        echo ("<tr>");
        echo ("<th>Alkalom</th>");
        echo ("<th>Esemény</th>");
        echo ("<th>Időpont</th>");
        echo ("</tr>");

        while($row=$result->fetch_assoc())
        {
            echo("<tr>");
            echo("<td>".$row["log_number"]."</td>");
            echo("<td>".$row["event"]."</td>");
            echo("<td>".$row["date"]."</td>");
            echo("</tr>");
        }
        echo("</table>");
?>