<?php 

Class Reservation{

    
    private Room $room;
    private Client $client;
    private Datetime $begin; //date de début de résa
    private Datetime $end; // date de fin de la résa
    private array $period;

    public function __construct(Room $room, Client $client, string $begin, string $end){

        $this->room = $room;
        $this->client = $client;
        $this->begin = new Datetime ($begin);
        $this->end = new Datetime ($end);
        $this->period = []; // Tableau vide qui contiendra la période de réservation (chaque jour sous forme de date dans un tableau)
        

        $hotel = $room->getHotel(); // Récupération de l'objet Hotel depuis Room (construct). Car une réservation se fait qu'avec une chambre et un client. L'hotel est tacitement lié.        

        $this->createDatePeriod(); // fonctionnel      
        
        foreach ($room->getPeriods() as $period){

            $result = array_intersect($period, $this->period); // Sort les items égaux entre 2 tableaux.

            var_dump($result);

            if (empty($result)){

                $hotel->addResa($this); // Ajout de l'objet resa au tableau des réservations de l'hôtel.       
                $room->addResa($this); // On ajoute la réservation automatiquement à un tableau Résas pour chaque chambre afin d'avoir un suivi des résas pour une chambre.       
                $client->addResa($this); // On ajoute cet objet à la liste des Réservations(hoel, chambre) du client. Un client peut avoir +ieurs résa
                $room->changeAvailable(); // Appel de la fct qui fera passer la chambre en innacessible 
                $room->addPeriodOfResa($this->period);

            } else echo "Impossible de réserver";

        }
        
    }      

    // public function isReservable(){

    //     foreach ($this->room->getPeriods() as $period){

    //         $result = array_intersect($period, $this->period); // Sort les items égaux entre 2 tableaux.

    //         if (empty($result)){
    //             $hotel->addResa($this); // Ajout de l'objet resa au tableau des réservations de l'hôtel.       
    //             $room->addResa($this); // On ajoute la réservation automatiquement à un tableau Résas pour chaque chambre afin d'avoir un suivi des résas pour une chambre.       
    //             $client->addResa($this); // On ajoute cet objet à la liste des Réservations(hoel, chambre) du client. Un client peut avoir +ieurs résa
                
    //             $room->changeAvailable(); // Appel de la fct qui fera passer la chambre en innacessible 
    //         } else echo "Impossible de réserver";

    //     }
    // }

    public function createDatePeriod(){
        
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($this->begin, $interval, $this->end);
        

        foreach ($period as $date) {
            $this->period[] = $date->format('Y-m-d');  // l' array qui contiendra la période de réservation. Chaque jour sous forme de date dans un item du tableau.      
        }     
        
        $this->period[] = $this->end->format('Y-m-d'); // On ajoute la date End car DatePeriod n'inclu pas la end date.... 
       
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
}

?>