<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReserveringRepository")
 */
class Reservering
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kamer", inversedBy="reserverings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kamerid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reserverings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userid;

    /**
     * @ORM\Column(type="date")
     */
    private $checkinDate;

    /**
     * @ORM\Column(type="date")
     */
    private $checkoutDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Betaal", inversedBy="reservering", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $betaalid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $betaalMethode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKamerid(): ?kamer
    {
        return $this->kamerid;
    }

    public function setKamerid(?kamer $kamerid): self
    {
        $this->kamerid = $kamerid;

        return $this;
    }

    public function getUserid(): ?user
    {
        return $this->userid;
    }

    public function setUserid(?user $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getCheckinDate(): ?\DateTimeInterface
    {
        return $this->checkinDate;
    }

    public function setCheckinDate(\DateTimeInterface $checkinDate): self
    {
        $this->checkinDate = $checkinDate;

        return $this;
    }

    public function getCheckoutDate(): ?\DateTimeInterface
    {
        return $this->checkoutDate;
    }

    public function setCheckoutDate(\DateTimeInterface $checkoutDate): self
    {
        $this->checkoutDate = $checkoutDate;

        return $this;
    }

    public function getBetaalid(): ?betaal
    {
        return $this->betaalid;
    }

    public function setBetaalid(betaal $betaalid): self
    {
        $this->betaalid = $betaalid;

        return $this;
    }

    public function getBetaalMethode(): ?string
    {
        return $this->betaalMethode;
    }

    public function setBetaalMethode(string $betaalMethode): self
    {
        $this->betaalMethode = $betaalMethode;

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }

}
