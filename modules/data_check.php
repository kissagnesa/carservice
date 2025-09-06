<?php

include("connect.php");

$check=$connect->query("select count(*) as count from clients");
$row=$check->fetch_assoc();

if($row["count"]==0)
{
    $clients=json_decode(file_get_contents("modules/data/clients.json"),true);
    $cars=json_decode(file_get_contents("modules/data/cars.json"),true);
    $services=json_decode(file_get_contents("modules/data/services.json"),true);

    $stmt= $connect->prepare("INSERT INTO clients (id, name, card_number) VALUES (?, ?, ?)");
    foreach($clients as $client)
    {
        $stmt->bind_param("iss", $client['id'], $client['name'], $client['idcard']);
        $stmt->execute();
    }
    $stmt->close();

    $stmt= $connect->prepare("INSERT INTO cars (id, client_id, type, registered, ownbrand, accidents) VALUES (?, ?, ?, ?, ?, ?)");
    foreach($cars as $car)
    {
        $stmt->bind_param("iissii", $car['id'], $car['client_id'], $car['type'], $car['registered'], $car['ownbrand'], $car['accidents']);
        $stmt->execute();
    }
    $stmt->close();

    $stmt= $connect->prepare("INSERT INTO services (id, client_id, car_id, log_number, event, event_time, document_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach($services as $service)
    {
        $stmt->bind_param("iiiisss", $service['id'], $service['client_id'], $service['car_id'], $service['log_number'], $service['event'], $services['event_time'], $service['document_id']);
        $stmt->execute();
    }
    $stmt->close();    
}
?>