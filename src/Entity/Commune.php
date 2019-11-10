<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommuneRepository")
 */
class Commune
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $communeName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $districtName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $provinceName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="commune")
     */
    private $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommuneName(): ?string
    {
        return $this->communeName;
    }

    public function setCommuneName(string $communeName): self
    {
        $this->communeName = $communeName;

        return $this;
    }

    public function getDistrictName(): ?string
    {
        return $this->districtName;
    }

    public function setDistrictName(string $districtName): self
    {
        $this->districtName = $districtName;

        return $this;
    }

    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    public function setProvinceName(string $provinceName): self
    {
        $this->provinceName = $provinceName;

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setCommune($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getCommune() === $this) {
                $city->setCommune(null);
            }
        }

        return $this;
    }
}
