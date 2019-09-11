<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonsRepository")
 */
class Persons
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
    private $PersonID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exceptions", mappedBy="PersonID")
     */
    private $exceptions;

    /**
     * @ORM\Column(type="date")
     */
    private $DOB;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Marital_Status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EmailID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Group_Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Bay_Name;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $Photo;

    public function __construct()
    {
        $this->exceptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonID(): ?string
    {
        return $this->PersonID;
    }

    public function setPersonID(string $PersonID): self
    {
        $this->PersonID = $PersonID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    /**
     * @return Collection|Exceptions[]
     */
    public function getExceptions(): Collection
    {
        return $this->exceptions;
    }

    public function addException(Exceptions $exception): self
    {
        if (!$this->exceptions->contains($exception)) {
            $this->exceptions[] = $exception;
            $exception->setPersonID($this);
        }

        return $this;
    }

    public function removeException(Exceptions $exception): self
    {
        if ($this->exceptions->contains($exception)) {
            $this->exceptions->removeElement($exception);
            // set the owning side to null (unless already changed)
            if ($exception->getPersonID() === $this) {
                $exception->setPersonID(null);
            }
        }

        return $this;
    }

    public function getDOB(): ?\DateTimeInterface
    {
        return $this->DOB;
    }

    public function setDOB(\DateTimeInterface $DOB): self
    {
        $this->DOB = $DOB;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->Marital_Status;
    }

    public function setMaritalStatus(string $Marital_Status): self
    {
        $this->Marital_Status = $Marital_Status;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getEmailID(): ?string
    {
        return $this->EmailID;
    }

    public function setEmailID(string $EmailID): self
    {
        $this->EmailID = $EmailID;

        return $this;
    }

    public function getGroupName(): ?string
    {
        return $this->Group_Name;
    }

    public function setGroupName(string $Group_Name): self
    {
        $this->Group_Name = $Group_Name;

        return $this;
    }

    public function getBayName(): ?string
    {
        return $this->Bay_Name;
    }

    public function setBayName(string $Bay_Name): self
    {
        $this->Bay_Name = $Bay_Name;

        return $this;
    }

    public function getPhoto()
    {
        return $this->Photo;
    }

    public function setPhoto($Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }
}
