<?php
namespace src\Model;
use JsonSerializable;

class CineEvent implements JsonSerializable
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $description = null;
    private ?\DateTime $dateEvenement = null;
    private ?int $prix = null;
    private ?float $latitude = null;
    private ?float $longitude = null;
    private ?string $contactNom = null;
    private ?string $contactEmail = null;
    private ?string $ImageRepository = null;
    private ?string $ImageFileName = null;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): CineEvent
    {
        $this->id = $id;
        return $this;
    }
    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): CineEvent
    {
        $this->nom = $nom;
        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): CineEvent
    {
        $this->description = $description;
        return $this;
    }
    public function getDateEvenement(): ?\DateTime
    {
        return $this->dateEvenement;
    }
    public function setDateEvenement(?\DateTime $dateEvenement): CineEvent
    {
        $this->dateEvenement = $dateEvenement;
        return $this;
    }
    public function getPrix(): ?int
    {
        return $this->prix;
    }
    public function setPrix(?int $prix): CineEvent
    {
        $this->prix = $prix;
        return $this;
    }
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }
    public function setLatitude(?float $latitude): CineEvent
    {
        $this->latitude = $latitude;
        return $this;
    }
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
    public function setLongitude(?float $longitude): CineEvent
    {
        $this->longitude = $longitude;
        return $this;
    }
    public function getContactNom(): ?string
    {
        return $this->contactNom;
    }
    public function setContactNom(?string $contactNom): CineEvent
    {
        $this->contactNom = $contactNom;
        return $this;
    }
    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }
    public function setContactEmail(?string $contactEmail): CineEvent
    {
        $this->contactEmail = $contactEmail;
        return $this;
    }
    public function getImageRepository(): ?string
    {
        return $this->ImageRepository;
    }
    public function setImageRepository(?string $ImageRepository): CineEvent
    {
        $this->ImageRepository = $ImageRepository;
        return $this;
    }
    public function getImageFileName(): ?string
    {
        return $this->ImageFileName;
    }
    public function setImageFileName(?string $ImageFileName): CineEvent
    {
        $this->ImageFileName = $ImageFileName;
        return $this;
    }

    public static function SqlGetAll()
    {
        $bdd = BDD::getInstance();
        $req = $bdd->query('SELECT * FROM events order by Id DESC ');
        $events = $req->fetchAll(\PDO::FETCH_ASSOC);

        $arrayEvents = [];
        foreach ($events as $event) {
            $enventObj = new CineEvent();
            $enventObj->setId($event['id']);
            $enventObj->setNom($event['nom']);
            $enventObj->setDescription($event['description']);
            $enventObj->setDateEvenement(new \DateTime($event['date_evenement']));
            $enventObj->setPrix($event['prix']);
            $enventObj->setLatitude($event['latitude']);
            $enventObj->setLongitude($event['longitude']);
            $enventObj->setContactNom($event['contact_nom']);
            $enventObj->setContactEmail($event['contact_email']);
            $enventObj->setImageRepository($event['ImageRepository']);
            $enventObj->setImageFileName($event['ImageFileName']);
            $arrayEvents[] = $enventObj;
        }
        return $arrayEvents;
    }

    public static function SqlAdd(CineEvent $event) : int{
        try{
            $req = BDD::getInstance()->prepare("INSERT 
            INTO events(nom, description, date_evenement, prix, latitude, longitude,
            contact_nom, contact_email, ImageRepository, ImageFileName) VALUES
           (:nom, :description, :date_evenement, :prix, :latitude, :longitude, :contact_nom, :contact_email, 
            :ImageRepository, :ImageFileName)");
            $req->bindValue(':nom', $event->getNom());
            $req->bindValue(':description', $event->getDescription());
            $req->bindValue(':date_evenement', $event->getDateEvenement()?->format('Y-m-d'));
            $req->bindValue(':prix', $event->getPrix());
            $req->bindValue(':latitude', $event->getLatitude());
            $req->bindValue(':longitude', $event->getLongitude());
            $req->bindValue(':contact_nom', $event->getContactNom());
            $req->bindValue(':contact_email', $event->getContactEmail());
            $req->bindValue(':ImageRepository', $event->getImageRepository());
            $req->bindValue(':ImageFileName', $event->getImageFileName());
            $req->execute();
            return BDD::getInstance()->lastInsertId();
        }catch (\Exception $e){
            var_dump($e->getMessage());
            return 0;
        }
    }

    public static function SqlGetById(int $id) : ?CineEvent
    {
        try {
            $bdd = BDD::getInstance();
            $req = $bdd->prepare('SELECT * FROM events WHERE id = :id ');
            $req->bindValue(':id', $id);
            $req->execute();
            $eventData = $req->fetch(\PDO::FETCH_ASSOC);
            if($eventData != false){
                $enventObj = new CineEvent();
                $enventObj->setId($eventData['id']);
                $enventObj->setNom($eventData['nom']);
                $enventObj->setDescription($eventData['description']);
                $enventObj->setDateEvenement(new \DateTime($eventData['date_evenement']));
                $enventObj->setPrix($eventData['prix']);
                $enventObj->setLatitude($eventData['latitude']);
                $enventObj->setLongitude($eventData['longitude']);
                $enventObj->setContactNom($eventData['contact_nom']);
                $enventObj->setContactEmail($eventData['contact_email']);
                $enventObj->setImageRepository($eventData['ImageRepository']);
                $enventObj->setImageFileName($eventData['ImageFileName']);

                return $enventObj;
            }
            return null;
        }catch (\Exception $e){
        var_dump($e->getMessage());
        return null;
        }
    }

    public static function SqlUpdate(CineEvent $event) : ?CineEvent
    {
        try {
            $bdd = BDD::getInstance();
            $req = $bdd->prepare('UPDATE events set nom=:nom, description=:description, 
                  date_evenement=:date_evenement, prix=:prix, latitude=:latitude, longitude=:longitude, 
                  contact_nom=:contact_nom, contact_email=:contact_email, ImageRepository=:ImageRepository, 
                  ImageFileName=:ImageFileName WHERE id=:id');

            $req->bindValue(':id', $event->getId());
            $req->bindValue(':nom', $event->getNom());
            $req->bindValue(':description', $event->getDescription());
            $req->bindValue(':date_evenement', $event->getDateEvenement()?->format('Y-m-d'));
            $req->bindValue(':prix', $event->getPrix());
            $req->bindValue(':latitude', $event->getLatitude());
            $req->bindValue(':longitude', $event->getLongitude());
            $req->bindValue(':contact_nom', $event->getContactNom());
            $req->bindValue(':contact_email', $event->getContactEmail());
            $req->bindValue(':ImageRepository', $event->getImageRepository());
            $req->bindValue(':ImageFileName', $event->getImageFileName());
            $req->execute();

            return $event;
        }catch (\Exception $e){
            var_dump($e->getMessage());
            return null;
        }
    }

    public static function SqlDelete(int $id)
    {
        $bdd = BDD::getInstance();
        $req = $bdd->prepare('DELETE FROM events WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'description' => $this->description,
            'dateEvenement' => $this->dateEvenement->format('Y-m-d'),
            'prix' => $this->prix,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'contactNom' => $this->contactNom,
            'contactEmail' => $this->contactEmail,
            'ImageRepository' => $this->ImageRepository,
            'ImageFileName' => $this->ImageFileName,
        ];
    }
}