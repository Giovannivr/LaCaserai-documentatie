<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BetaalRepository")
 */
class Betaal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $soort;

    /**
     * @ORM\Column(type="date")
     */
    private $betaal_datum;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reservering", mappedBy="betaalid", cascade={"persist", "remove"})
     */
    private $reservering;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $rekeningnummer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoort(): ?string
    {
        return $this->soort;
    }

    public function setSoort(string $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function getBetaalDatum(): ?\DateTimeInterface
    {
        return $this->betaal_datum;
    }

    public function setBetaalDatum(\DateTimeInterface $betaal_datum): self
    {
        $this->betaal_datum = $betaal_datum;

        return $this;
    }

    public function getReservering(): ?Reservering
    {
        return $this->reservering;
    }

    public function setReservering(Reservering $reservering): self
    {
        $this->reservering = $reservering;

        // set the owning side of the relation if necessary
        if ($this !== $reservering->getBetaalid()) {
            $reservering->setBetaalid($this);
        }

        return $this;
    }

    public function getRekeningnummer(): ?string
    {
        return $this->rekeningnummer;
    }

    public function setRekeningnummer(string $rekeningnummer): self
    {
        $this->rekeningnummer = $rekeningnummer;

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }

}
