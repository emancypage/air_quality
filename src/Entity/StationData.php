<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StationDataRepository")
 */
class StationData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Station", inversedBy="stationData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StationId;

    /**
     * @ORM\Column(type="string")
     */
    private $plAqIndexLvl;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStationId(): ?Station
    {
        return $this->StationId;
    }

    public function setStationId(?Station $StationId): self
    {
        $this->StationId = $StationId;

        return $this;
    }

    public function getPlAqIndexLvl(): ?string
    {
        return $this->plAqIndexLvl;
    }

    public function setPlAqIndexLvl(string $plAqIndexLvl): self
    {
        $this->plAqIndexLvl = $plAqIndexLvl;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
