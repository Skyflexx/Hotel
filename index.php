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

        $room1 = new Room (3, true, 120, $hilton);
        $room2 = new Room (4, false, 120, $hilton);
        $room3 = new Room (2, true, 130, $hilton);
        $room4 = new Room (2, true, 130, $hilton);
        $room5 = new Room (2, true, 130, $hilton);
        $room6 = new Room (2, true, 130, $hilton);

        $client1 = new Client ("Mickael", "Murmann");
        $client2 = new Client ("Virgile", "Gibello");

        $resa1 = new Reservation ($room1, $client1, "03/11/2021", "03/15/2021");
        $resa2 = new Reservation ($room1, $client1, "03/16/2021", "03/18/2021");
        $resa3 = new Reservation ($room2, $client2, "01/01/2021", "01/01/2021");
       

        // Tests des fonctions

        echo $hilton->getInfosHotel();

        echo "<br>";
        echo "<br>";

        echo $hilton->getReservationsList();

        echo $regent->getReservationsList();

        echo $client1->getReservationsList();        

        echo $hilton->getStatutRoom();

        // Probleme en cours :

        // Lors de l'instanciation d'une réservation, on doit pouvoir comparer la période demandée aux périodes en cours situées dans un array dans l'objet room. 
        





        // $interval = new DateInterval('P1D');
        // $period = new DatePeriod($resa1->getBegin(), $interval, $resa1->getEnd());
        // $period2 = new DatePeriod($resa2->getBegin(), $interval, $resa2->getEnd());

        // $periode1[] = $resa1->getBegin()->format("Y-m-d");
        // $periode2[] = $resa2->getBegin()->format("Y-m-d");
        

        // foreach ($period as $date) {
        //     $periode1[] = $date->format('Y-m-d');  // Création d'un array qui contiendra la période de réservation. Chaque jour sous forme de date dans un item du tableau.      
        // }

        // foreach ($period2 as $date) {
        //     $periode2[] = $date->format('Y-m-d');  // Création d'un array qui contiendra la période de réservation. Chaque jour sous forme de date dans un item du tableau.      
        // }               

        // $result = array_intersect($periode1, $periode2); // Sort les items égaux entre 2 tableaux.

        // var_dump($result);

        // if (empty($result)){
        //     echo "possible de réserver";
        // } else echo "Impossible de réserver";

       

    ?>

    </h2>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>