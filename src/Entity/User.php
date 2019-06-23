<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_activity;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $tel_nr;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $mobile_nr;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $insertion_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservering", mappedBy="userid")
     */
    private $reserverings;

    public function __construct()
    {
        parent::__construct();
        $this->reserverings = new ArrayCollection();
        // your own logic
    }

    public function getLastActivity(): ?\DateTimeInterface
    {
        return $this->last_activity;
    }

    public function setLastActivity(?\DateTimeInterface $last_activity): self
    {
        $this->last_activity = $last_activity;

        return $this;
    }

    public function isActiveNow()
    {
        // Delay during which the user will be considered as still active
        $delay = new \DateTime('2 minutes ago');

        return ( $this->getLastActivity() > $delay );
    }

    public function getTelNr(): ?string
    {
        return $this->tel_nr;
    }

    public function setTelNr(?string $tel_nr): self
    {
        $this->tel_nr = $tel_nr;

        return $this;
    }

    public function getMobileNr(): ?string
    {
        return $this->mobile_nr;
    }

    public function setMobileNr(?string $mobile_nr): self
    {
        $this->mobile_nr = $mobile_nr;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getInsertionName(): ?string
    {
        return $this->insertion_name;
    }

    public function setInsertionName(?string $insertion_name): self
    {
        $this->insertion_name = $insertion_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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
            $reservering->setUserid($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->contains($reservering)) {
            $this->reserverings->removeElement($reservering);
            // set the owning side to null (unless already changed)
            if ($reservering->getUserid() === $this) {
                $reservering->setUserid(null);
            }
        }

        return $this;
    }
}
