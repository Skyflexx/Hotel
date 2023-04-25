<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
</head>
<body>


<?php 

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$hilton = new Hotel("Hilton ****", "10 Route de la Gare", "67000", "Strasbourg");

$room1 = new Room (3, false, 120, $hilton);
$room2 = new Room (4, false, 120, $hilton);

$client1 = new Client ("Mickael", "Murmann");



$resa1 = new Reservation ($hilton, $room2, $client1, "03/11/2021", "03/15/2021");







echo $hilton->getInfosHotel();

echo "<br>";

echo $hilton->getReservationsList();








?>
    
</body>
</html>