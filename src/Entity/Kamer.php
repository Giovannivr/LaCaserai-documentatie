<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KamerRepository")
 */
class Kamer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Soort", inversedBy="kamers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soortid;

    /**
     * @ORM\Column(type="integer")
     */
    private $prijs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="kamerid")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservering", mappedBy="kamerid")
     */
    private $reserverings;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoortid(): ?soort
    {
        return $this->soortid;
    }

    public function setSoortid(?soort $soortid): self
    {
        $this->soortid = $soortid;

        return $this;
    }

    public function getPrijs(): ?int
    {
        return $this->prijs;
    }

    public function setPrijs(int $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setKamerid($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getKamerid() === $this) {
                $image->setKamerid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservering[]
     */
    public function getReserverings(): Collection
    {
        return $this->reserverings;
    }

    public function addReservering(Reservering $reservering): self
    {
        if (!$this->reserverings->contains($reservering)) {
            $this->reserverings[] = $reservering;
            $reservering->setKamerid($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->contains($reservering)) {
            $this->reserverings->removeElement($reservering);
            // set the owning side to null (unless already changed)
            if ($reservering->getKamerid() === $this) {
                $reservering->setKamerid(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }


}
