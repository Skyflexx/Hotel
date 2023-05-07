<?php

class Hotel {

    private string $name;
    private string $address;
    private string $cp;
    private string $city;
    private array $rooms; // Array contenant les différentes chambres/objet
    private int $nbRoomsReserved; // nbr de chambres réservées
    private array $reservations;    

    public function __construct(string $name, string $address, string $cp, string $city) {        
        $this->name = $name;
        $this->address = $address;
        $this->cp = $cp;
        $this->city = $city;
        $this->rooms = array(); // Initialisation d'un array Chambres qui contiendra la liste des chambres. les items Chambres/Room.   
        $this->reservations = array();     
    }

    public function addResa($reservation){
        $this->reservations[] = $reservation; // Ajout de la réservation (Hotel, chambre, client) à ce tableau ce qui permettra de sortir toutes les resa de l'hotel.
    }

    public function delResa($reservation){        
        
        $key = array_search($reservation, $this->reservations); // Cherche la clé de l'array Reservations de cette reservation
        
        unset($this->reservations[$key]); // Permet de supprimer l'item de l'array avec la clé concernée.

        $this->available = true;  
    }
  

    public function addRoom($room){
        $this->rooms[] = $room; // Ajout de d'une chambre créée à la liste des chambres de cet hotel.
    }

    public function createNumRoom(){ // fct qui va créer un numéro de chambre à l'instanciation d'une nouvelle Room.
        
        $numberOfRooms = count($this->rooms); // On compte le nombre d'items dans l'array Rooms.

        return ($numberOfRooms + 1); // On retourne ce nombre + 1 afin de retourner le nouveau numéro de chambre.
    }

    public function getInfosHotel(){

        $nbRoom = count($this->rooms); // Calcul du nbr de chambres de l'hotel en comptant le contenu de l'array Rooms
        $nbResa = count($this->reservations); // Carlcul du nbr de Resas de l'hotel en comptant le contenu de l'array Reservations de l'Hotel.

        $nbRoomAvailable = $nbRoom - $nbResa; // Calcul de la diff pour sortir le nbr de chambres dispos.

        return $this."<br>".
        $this->address." ".$this->cp." ".$this->city."<br>". 
        "Nombre de chambres : ".$nbRoom."<br>". 
        "Nombre de chambres réservées : ".$nbResa."<br>". 
        "Nombre de chambres disponibles : ".$nbRoomAvailable; // Compte le nbr de chambres avec count($array)
    }

    public function getReservationsList(){   
        
        $nbResa = count($this->reservations);
        
        $infos = "Réservations de l'hotel $this <br>  ";

        if ($nbResa == 0){
            $infos .= "Aucune réservation ! <br>";
        } else if ($nbResa == 1){
            $infos .= "$nbResa Réservation <br>";
        } else $infos .= "$nbResa Réservations <br>";
        
        // Récupération des données depuis l'array Réservations qui contient des objets

        foreach ($this->reservations as $reservation){            

            $dateBegin = $reservation->getBegin()->format("Y-m-d"); // Récupération de la date de début de la resa
            $dateEnd = $reservation->getEnd()->format("Y-m-d"); // Récupération de la date de fin

            $infos .= $reservation->getClient()." - ".$reservation->getroom()." - "."Du : $dateBegin au $dateEnd <br>"; 
        }

        $infos .= "<br>";

        return $infos;

    }

    public function getStatutRoom(){ // Affichage en bootstrap de la liste des chambres et leurs features dans l'hotel.        

        // $content représente le contenu qui sera affiché en boostrap.
        // Dans un 1er temps on ajoute à $content les différentes colonnes de la table.
        
        $content = "
            <table class='table table-white'>
            <thead>
            <tr>
            
            <th scope='col'>Chambre</th>
            <th scope='col'>Prix</th>
            <th scope='col'>Wifi</th>
            <th scope='col'>Etat</th>
            </tr>
            </thead>
            <tbody>
        ";

        // Dans un second temps, insertion des lignes en parcourant l'array Rooms qui contient les objets Room.

        foreach ($this->rooms as $room){

            // contitionnel pour sortir un logo wifi en bootstrap.

            if ($room->getWifi()){
                $wifi = "<i class='fa-solid fa-wifi'></i>";
            } else {
                $wifi = "";
            }

            // Conditionnel pour sortir une étiquette disponible ou indisponible en bootstrap.

            if ($room->getAvailable()){
                $availability = "<span class='label label-success'>Disponible !</span>";
            } else {
                $availability = $room->listOfResas();
            }

            // Afichage du contenu dans un tableau bootstrap.

            $content.= 
            "<tr>".
                "<th scope='row'>$room</th>".
                "<td>".$room->getPrice()."€</td>".
                "<td>".$wifi."</td>".
                "<td>".$availability."</td>
            </tr>";

        }

        // Dans un 3e temps, fermeture du tableau.

        $content.= 
        "</tbody>
        </table>";

        return $content; 

    }

    
    public function __tostring(){
        return $this->name." ".$this->city;
    }


    // GETTERS ET SETTERS
     
    public function getName()
    {
        return $this->name;
    }

    
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

   
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

   
    public function getRooms()
    {
        return $this->rooms;
    }

    
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }

    
    public function getReservations()
    {
        return $this->reservations;
    }
    
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }
}

?>