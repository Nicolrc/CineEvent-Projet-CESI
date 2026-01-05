<?php
namespace src\Model;
use JsonSerializable;

class CineEvent implements JsonSerializable
{
    private ?int $id = null;
    private ?int $nom = null;
    private ?string $description = null;
    private ?\DateTime $dateEvenement = null;
    private ?int $prix = null;
    private ?double $latitude = null;
    private ?double $longitude = null;
    private ?string $contactNom = null;
    private ?string $contactEmail = null;
    private ?string $ImageRepository = null;
    private ?string $ImageFileName = null;
    private ?string $ImagePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): CineEvent
    {
        $this->id = $id;
        return $this;
    }
    public function getNom(): ?int
    {
        return $this->nom;
    }
    public function setNom(int $nom): CineEvent
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
        return $this->latitute;
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
        // TODO: Implement jsonSerialize() method.
    }
}