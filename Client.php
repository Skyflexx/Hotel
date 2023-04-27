<?php

class Client {

    private string $firstname;
    private string $lastname;
    private array $reservations;

    public function __construct(string $firstname, string $lastname){

        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->reservations = array(); // Ce tableau sera incrémenté pour lister les résas de cette personne. Il contiendra une resa (hotel, chambre, client)

    }

    public function __tostring(){
        return $this->firstname." ".$this->lastname;
    }

    public function addResa($reservation){
        $this->reservations[] = $reservation; // Ajout de la réservation (Hotel, chambre, client) à ce tableau ce qui permettra de sortir toutes les resa de ce Client.
    }

    public function getReservationsList(){   // Sort toutes les infos des réservations de ce client.
        
        $nbResa = count($this->reservations);
        
        $infos = "Réservations de $this <br>  ";

        if ($nbResa == 0){
            $infos .= "Aucune réservation !";
        } else if ($nbResa == 1){
            $infos .= "$nbResa Réservation <br>";
        } else $infos .= "$nbResa Réservations <br>";
        
        // Récupération des données depuis l'array Réservations qui contient des objets de type Réservation

        $priceTotal = 0; // Initialisation d'une variable qui calculera le montant total des réservations.

        foreach ($this->reservations as $reservation){

            $dateBegin = $reservation->getBegin()->format("Y-m-d"); // Récupération de la date de début de la resa
            $dateEnd = $reservation->getEnd()->format("Y-m-d"); // Récupération de la date de fin

            $infos .= $reservation->getRoom()->getHotel()." / ".$reservation->getroom()." (".$reservation->getroom()->getNbrBed()." lits - ".$reservation->getroom()->getPrice(). " € - Wifi : ".$reservation->getroom()->getStatutwifi().") - "."Du : $dateBegin au $dateEnd <br>"; 
            
            $priceTotal += $reservation->calculPrice(); // Appel de la fct calculPrice de l'objet Reservation qui calcule en fct du nbr de jours passés.
        }

        $infos .= "Total : $priceTotal €";

        return $infos;

    }


    public function getFirstname()
    {
        return $this->firstname;
    }

    
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    
    public function getLastname()
    {
        return $this->lastname;
    }

    
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

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