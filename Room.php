<?php 

class Room{

    private int $numRoom;   // Le numéro sera le numéro de la clé dans l'array chambres.    
    private int $nbrBed;
    private float $price;
    private bool $wifi; // Si oui ou non le wifi.
    private Hotel $hotel; // Une chambre liée à un hotel.    
    private bool $available; // Booléen pour savoir si cette chambre est dispo ou non. Par défaut True à la création. 
    private array $reservations; // Array Réservations qui contient chaque réservation de l'hôtel
    private array $periods; // array contenant toutes les periodes de Resa de cette chambre.

    public function __construct(int $nbrBed, bool $wifi , float $price, Hotel $hotel){    

        $this->numRoom = $hotel->createNumRoom(); // Utilisation de la fct createnumroom qui attribue un numéro de chambre à la création d'une chambre dans un hotel.
        $this->nbrBed = $nbrBed;
        $this->wifi = $wifi;
        $this->price = $price;
        $this->hotel = $hotel;
        $this->available = true;    
        $this->reservations = array(); // Ce tableau contiendra tous les items de type réservation(hotel1, chambre1, client1) permettant de sortir toutes les résas de cette chambre précise.
        $this->periods = array();

        $hotel->addRoom($this); // Appel de la fct AddRoom qui permettra d'ajouter cette chambre à la liste de l'hotel concerné.

    }    

    public function isPossibleToResa($periodResa){ // Periode depuis Resa

        foreach ($this->periods as $periode){

            $result = array_intersect($periodResa, $periode); // Sort les items égaux entre 2 tableaux.            

            if (empty($result)){
                
                return true;               

            } else             
            
            return false;

        }
    }

    public function addPeriodOfResa($period){
        
        $this->periods[] = $period; // ajout de la période qui sera sous forme d'array contenant des dates.
    }

    public function addResa($reservation){  

        $this->reservations[] = $reservation; // Ajout de la réservation (Hotel, chambre, client) à ce tableau ce qui permettra de sortir toutes les resa de l'hotel.

    }

    public function changeAvailable(){
        $this->available = false; // Changement automatique du statut dispo si une réservation est faite.
    
    }

    public function getRoomsStatus(){
        return $this." ".$this->price." € ". "Wifi :".$this->getStatutWifi()." Statut chambre : ".$this->getAvailability();
    }

    public function getAvailability(){
        if ($this->available == true){
            return "Disponible !";
        } else return "Réservée";
    }

    public function getStatutwifi(){
        if ($this->wifi == true){
            return " Oui ";
        } else return " Non ";
    }    

    public function __tostring (){  // Retournera le numéro de chambre 
        return "Chambre ".$this->getNumRoom();
    }


    

// GETTERS ET SETTERS

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

    public function setNumRoom() 
    {
        $this->numRoom = $numRoom;

        return $this;
    }
  
    public function getAvailable()
    {
        return $this->available;
    }

    
    public function setAvailable($available)
    {
        $this->available = $available;

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

   
    public function getPeriods()
    {
        return $this->periods;
    }

    
    public function setPeriods($periods)
    {
        $this->periods = $periods;

        return $this;
    }
}

?>