<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Hotels</title>
</head>
<body>
<h2>
    <?php 

        spl_autoload_register(function ($class_name) {
            include $class_name . '.php';
        });

        // Instanciations

        $hilton = new Hotel("Hilton ****", "10 Route de la Gare", "67000", "Strasbourg");
        $regent = new Hotel("Regent ***", "61 rue dauphine", "75006", "Paris");

        $room1 = new Room (3, false, 120, $hilton);
        $room2 = new Room (4, false, 120, $hilton);
        $room3 = new Room (2, true, 130, $hilton);
        $room4 = new Room (2, true, 130, $hilton);
        $room5 = new Room (2, true, 130, $hilton);
        $room6 = new Room (2, true, 130, $hilton);

        $client1 = new Client ("Mickael", "Murmann");
        $client2 = new Client ("Virgile", "Gibello");

        $resa1 = new Reservation ($room1, $client1, "03/11/2021", "03/14/2021");
        $resa2 = new Reservation ($room1, $client1, "03/14/2021", "03/18/2021"); // Ne sera pas prise en compte grace à la méthode qui check si la chambre est dispo.
        $resa3 = new Reservation ($room1, $client1, "03/19/2021", "03/20/2021");
        // $resa3 = new Reservation ($room2, $client2, "01/01/2021", "01/01/2021");
        // $resa4 = new Reservation ($room2, $client2, "01/02/2021", "01/03/2021");     
        
        // Tests des fonctions

        echo $hilton->getInfosHotel();

        echo "<br>";
        echo "<br>";

        echo $hilton->getReservationsList();

        echo $regent->getReservationsList();

        echo $client1->getReservationsList();        

        echo $hilton->getStatutRoom();

        echo "Suppression d'une réservation : <br><br>";

        $resa1->delResa();

        echo $client1->getReservationsList();  

        echo $hilton->getStatutRoom(); 

        $resa3->delResa();

        echo $hilton->getStatutRoom();         

    ?>    

</h2>    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>