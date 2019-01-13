<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnouncementRepository")
 */
class Announcement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="announcements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vehicle", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $vehicle;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RealEstate", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $realEstate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Job", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $job;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function removeJob(Job $job): self
    {
        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        return $this;
    }

    public function getRealEstate(): ?RealEstate
    {
        return $this->realEstate;
    }

    public function setRealEstate(RealEstate $realEstate): self
    {
        $this->realEstate = $realEstate;

        return $this;
    }

    public function removeRealEstate(RealEstate $realEstate): self
    {
        return $this;
    }

}
