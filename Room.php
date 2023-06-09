<?php 

class Room{

    private int $numRoom;   // Le numéro sera le numéro de la clé dans l'array chambres.    
    private int $nbrBed;
    private float $price;
    private bool $wifi; // Si oui ou non le wifi.
    private Hotel $hotel; // Une chambre liée à un hotel.    
    private bool $available; // Booléen pour savoir si cette chambre est dispo ou non. Par défaut True à la création. 
    private array $reservations; // Array Réservations qui contient chaque réservation de l'hôtel
    

    public function __construct(int $nbrBed, bool $wifi , float $price, Hotel $hotel){    

        $this->numRoom = $hotel->createNumRoom(); // Utilisation de la fct createnumroom qui attribue un numéro de chambre à la création d'une chambre dans un hotel.
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

    public function delResa($reservation){        
        
        $key = array_search($reservation, $this->reservations); // Cherche la clé de l'array Reservations de cette reservation
        
        unset($this->reservations[$key]); // Permet de supprimer l'item de l'array avec la clé concernée.  
        
        if (empty($this->reservations)){
            $this->available = true;
        }
        
    }

    public function listOfResas(){

        $infos = "<span class='label label-danger '>Indisponible pour la/les période(s) suivante(s) : </span><br>";

        foreach ($this->reservations as $reservation){

            $dateBegin = $reservation->getBegin()->format("Y-m-d"); // Récupération de la date de début de la resa
            $dateEnd = $reservation->getEnd()->format("Y-m-d"); // Récupération de la date de fin

            $infos .= "<span class='label label-danger'> Du $dateBegin au $dateEnd </span>";      
            
        }

        return $infos;
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
        } else return "Réservée du ";
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
    
}

?>