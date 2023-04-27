<?php 

Class Reservation{

    private Hotel $hotel;
    private Room $room;
    private Client $client;
    private Datetime $begin; //date de début de résa
    private Datetime $end; // date de fin de la résa

    public function __construct(Hotel $hotel, Room $room, Client $client, string $begin, string $end){

        $this->hotel = $hotel;
        $this->room = $room;
        $this->client = $client;

        $this->begin = new Datetime ($begin);
        $this->end = new Datetime ($end);
       
        $hotel->addResa($this); // Un hotel pourra lister les réservations.
        $room->addResa($this); // On ajoute la réservation automatiquement à un tableau Résas pour chaque chambre afin d'avoir un suivi des résas pour une chambre.       
        $client->addResa($this); // On ajoute cet objet à la liste des Réservations(hoel, chambre) du client. Un client peut avoir +ieurs résa
        $room->changeAvailable(); // Appel de la fct qui fera passer la chambre en innacessible
    }

    public function calculPrice(){ // Calcul du prix d'une resa en partant du nbr de jours réservés. 

        $stayDuration = $this->begin->diff($this->end); // Calcul du nb de jours. Si == 0 en cas d'1 jours de resa, alors on sort juste le prix de la chambre.

        if ($stayDuration->d == 0) {

            $price = $this->getRoom()->getPrice();

        } else $price = $this->getRoom()->getPrice() * $stayDuration->d; // Sinon, multiplication par le nbr de jour sinon ça ferait une multiplication par 0.

        return $price ;
    }

    public function getHotel()
    {
        return $this->hotel;
    }


    public function setHotel($hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

  
    public function getRoom()
    {
        return $this->room;
    }

  
    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }

    
    public function getClient()
    {
        return $this->client;
    }

    
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

   
    public function getBegin()
    {
        return $this->begin;
    }

  
    public function setBegin($begin)
    {
        $this->begin = $begin;

        return $this;
    }

   
    public function getEnd()
    {
        return $this->end;
    }

    
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }
}

?>