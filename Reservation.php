<?php 

Class Reservation{

    
    private Room $room;
    private Client $client;
    private Datetime $begin; //date de début de résa
    private Datetime $end; // date de fin de la résa
    private array $period;
    private string $id;

    public function __construct(Room $room, Client $client, string $begin, string $end){

        $this->room = $room;
        $this->client = $client;
        $this->begin = new Datetime ($begin);
        $this->end = new Datetime ($end);
        $this->period = array (); // Tableau vide qui contiendra la période de réservation (chaque jour sous forme de date dans un tableau)
        $hotel = $room->getHotel(); // Récupération de l'objet Hotel depuis Room (construct). Car une réservation se fait qu'avec une chambre et un client. L'hotel est tacitement lié.   
        $this->id = uniqid();    

        // Méthodes pour éviter les doublons pour une chambre :
        $this->addPeriod(); // Ajout de la période de réservation.
        $this->ifPossibleResa(); // Si la période de réservation n'empiete pas sur une autre, alors on réserve.        
              
    } 
    
    public function delResa(){
       
        $this->getRoom()->delResa($this);
        $this->getClient()->delResa($this);
        $this->room->getHotel()->delResa($this);
        
      
    }

    public function addPeriod(){

        // Création de la période de réservation pour une date de début et une date de fin donnée. On stockera chaque date dans un array.
        // L'idée c'est de comparer cet array aux autres des réservations déjà faites.

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($this->begin, $interval, $this->end);        

        foreach ($period as $date) {
            $this->period[] = $date->format('Y-m-d');  // l' array qui contiendra la période de réservation. Chaque jour sous forme de date dans un item du tableau.      
        }     
        
        $this->period[] = $this->end->format('Y-m-d');   // Ajout de la date de fin qui n'est pas incluse automatiquement par la classe DatePeriod.     

    } 

    public function ifPossibleResa(){ 
        
        // Méthode permettant de vérifier si une résa est possible en comparant 2 tableaux et en sortant les occurences s'il y en a.
        // Si il y a une date en commun, alors on arrête de parcourir le tableau et on return un false.

        $isPossible = true; // Par défaut je mets isPossible à true.

        foreach ($this->room->getReservations() as $reservation){ // On parcourt les réservations de la chambre concernée.

            $check = array_intersect($this->period, $reservation->getPeriod()); // fct permettant de sortir les occurences entre 2 tableaux que je stocke dans $check.

            if(!empty($check)){ // la fct empty permet de retourner un booléen si la variable visée est vide. (par défaut true si empty.)

                $isPossible = false; // Si pas vide, alors je passe isPossible à False.

                break; // On sort si $check n'est pas vide. Sinon on risque au final de retourner un true si la réservation suivante n'a pas d'occurence.

            } 
            
        }

        if ($isPossible){ // Si isPossible est true, alors je peux créer la réservation et l'ajouter partout.

            $this->room->getHotel()->addResa($this); 
            $this->room->addResa($this);        
            $this->client->addResa($this); 
            $this->room->changeAvailable(); 

        } else {

            echo "Impossible de réserver !";
        }

    }

    public function calculPrice(){ // Calcul du prix d'une resa en partant du nbr de jours réservés. 

        $stayDuration = $this->begin->diff($this->end); // Calcul du nb de jours. Si == 0 en cas d'1 jours de resa, alors on sort juste le prix de la chambre.

        if ($stayDuration->d == 0) {

            $price = $this->getRoom()->getPrice();

        } else $price = $this->getRoom()->getPrice() * $stayDuration->d; // Sinon, multiplication par le nbr de jour sinon ça ferait une multiplication par 0.

        return $price ;
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

   
    public function getPeriod()
    {
        return $this->period;
    }

   
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

   
    public function getId()
    {
        return $this->id;
    }

   
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

?>