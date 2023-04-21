<?php

class Hotel {

    private string $name;
    private string $address;
    private string $city;
    private array $rooms; // Liste des chambres
    

    public function __construct(string $name, string $address, string $city) {

        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->rooms = array(); // Initialisation d'un array Chambres qui contiendra la liste des chambres. les items Chambres/Room.        

    }

    public function addRoom($room){
        $this->rooms[] = $room; // Ajout de d'une chambre créée à la liste des chambres de cet hotel.
    }

    public function createNumRoom(){
        
        $numberOfRooms = count($this->rooms); // On compte le nombre d'items dans l'array Rooms.

        return ($numberOfRooms + 1); // On retourne ce nombre + 1 afin de retourner le nouveau numéro de chambre.

    }

    
    public function __toostring(){
        return $this->name." ".$this->city;
    }























     
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