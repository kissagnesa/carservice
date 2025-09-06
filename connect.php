<?php 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "carservice"; 

try 
    { 
        $connect = new mysqli($servername, $username, $password, $dbname); 

        if ($connect->connect_error) 
            { 
            throw new Exception("Connection failed: " . $connect->connect_error); 
            } 
    }
catch (Exception $e) 
    { 
        die("Error: " . $e->getMessage()); 
    } 
?>