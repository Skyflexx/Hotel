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

        $client1 = new Client ("Mickael", "Murmann");
        $client2 = new Client ("Virgile", "Gibello");

        $resa1 = new Reservation ($hilton, $room2, $client1, "03/11/2021", "03/15/2021");
        $resa2 = new Reservation ($hilton, $room1, $client1, "04/01/2021", "04/02/2021");
        $resa3 = new Reservation ($hilton, $room2, $client2, "01/01/2021", "01/01/2021");


        // Tests des fonctions

        echo $hilton->getInfosHotel();

        echo "<br>";
        echo "<br>";

        echo $hilton->getReservationsList();

        echo $regent->getReservationsList();

        echo $client1->getReservationsList();


        // $begin = new Datetime("03/11/2021");
        // $end = new Datetime ("03/15/2021");

        // $stayDuration = $begin->diff($end);

        // echo $stayDuration->d;

      echo $hilton->getStatutRoom();

    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>