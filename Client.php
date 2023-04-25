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