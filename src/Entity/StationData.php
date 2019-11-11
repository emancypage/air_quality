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
     * @ORM\Column(type="integer")
     */
    private $plAqIndexLvl;

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

    public function getPlAqIndexLvl(): ?int
    {
        return $this->plAqIndexLvl;
    }

    public function setPlAqIndexLvl(int $plAqIndexLvl): self
    {
        $this->plAqIndexLvl = $plAqIndexLvl;

        return $this;
    }
}
