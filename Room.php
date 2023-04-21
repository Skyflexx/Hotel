<?php 

class Room{

    private int $numRoom;   // Le numéro sera le numéro de la clé dans l'array chambres.    
    private int $nbrBed;
    private float $price;
    private bool $wifi; // Si oui ou non le wifi.
    private Hotel $hotel; // Une chambre liée à un hotel.

    private array $reservations;
    private bool $available; // Booléen pour savoir si cette chambre est dispo ou non. Par défaut True à la création. 

    public function __construct(int $nbrBed, bool $wifi , float $price, Hotel $hotel){    

    $this->numRoom = $hotel->createNumRoom(); // On va créer une fct qui ira créer le numéro de chambre en se basant sur l'array Rooms.
    $this->nbrBed = $nbrBed;
    $this->wifi = $wifi;
    $this->price = $price;
    $this->hotel = $hotel;
    $this->available = true;
    
    $this->reservations = array(); // Ce tableau contiendra tous les items de type réservation(hotel1, chambre1, client1) permettant de sortir toutes les résas de cette chambre précise.

    $hotel->addRoom($this); // Appel de la fct AddRoom qui permettra d'ajouter cette chambre à la liste de l'hotel concerné.

    }

    public function addResa($reservation){
        $this->reservations[] = $reservation; // Ajout de la réservation (Hotel, chambre, client) à ce tableau ce qui permettra de sortir toutes les resa de l'hotel.
    }

    public function changeAvailable(){
        $this->available = !$this->available; // Changement automatique du statut dispo si une réservation est 
    
    }

    public function setNumRoom() // A utiliser via hotel. 
    {
        $this->numRoom = $numRoom;

        return $this;
    }

    

    // public function __tostring (){  // Retournera le numéro de chambre et le wifi si oui ou non.
    //     return $this->
    // }





    


















    public function getHotel()
    {
        return $this->hotel;
    }

   
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

   
    public function getNbrBed()
    {
        return $this->nbrBed;
    }

    public function setNbrBed($nbrBed)
    {
        $this->nbrBed = $nbrBed;

        return $this;
    }

  
    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    
    public function getWifi()
    {
        return $this->wifi;
    }

   
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;

        return $this;
    }

    
    public function getNumRoom()
    {
        return $this->numRoom;
    }

   
    
}

?>