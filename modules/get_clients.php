<?php
include("modules/data_check.php");

$result=$connect->query("select * from clients");

if($result && $result->num_rows>0)
    {
        echo ("<table>");
        echo ("<tr>");
        echo ("<th>ID</th>");
        echo ("<th>Név</th>");
        echo ("<th>Okmányazonosító</th>");
        echo ("</tr>");

        while($row=$result->fetch_assoc())
        {
            echo ("<tr>");
            echo ("<td>".$row["id"]."</td>");
            echo ("<td>".$row["name"]."</td>");
            echo ("<td>".$row["card_number"]."</td>");
            echo ("</tr>");
        }
        echo("</table>");
    }
    else
    {
        echo("");
    }

?>

