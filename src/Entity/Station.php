<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StationRepository")
 */
class Station
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $apiStationId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stationName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gegrLat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gegrLon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="stations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addressStreet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApiStationId(): ?int
    {
        return $this->apiStationId;
    }

    public function setApiStationId(int $apiStationId): self
    {
        $this->apiStationId = $apiStationId;

        return $this;
    }

    public function getStationName(): ?string
    {
        return $this->stationName;
    }

    public function setStationName(string $stationName): self
    {
        $this->stationName = $stationName;

        return $this;
    }

    public function getGegrLat(): ?string
    {
        return $this->gegrLat;
    }

    public function setGegrLat(string $gegrLat): self
    {
        $this->gegrLat = $gegrLat;

        return $this;
    }

    public function getGegrLon(): ?string
    {
        return $this->gegrLon;
    }

    public function setGegrLon(string $gegrLon): self
    {
        $this->gegrLon = $gegrLon;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddressStreet(): ?string
    {
        return $this->addressStreet;
    }

    public function setAddressStreet(string $addressStreet): self
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }
}
