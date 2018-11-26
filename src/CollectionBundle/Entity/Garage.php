<?php

namespace CollectionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Garage
 *
 * @ORM\Table(name="garage")
 * @ORM\Entity(repositoryClass="CollectionBundle\Repository\GarageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Garage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="locate", type="string", length=255)
     */
    private $locate;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="smallint")
     */
    private $capacity;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", unique=true)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ModifyAt", type="datetime", nullable=true)
     */
    private $modifyAt;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return $this
     *
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->modifyAt = new \DateTime();

        return $this;
    }

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CollectionBundle\Entity\Car", mappedBy="garage")
     */
    private $car;

    /**
     * Garage constructor.
     */
    public function __construct()
    {
        $this->car = new ArrayCollection();
    }

    /**
    * @param ArrayCollection $car
    */
    public function addCar($car)
    {
        if(sizeof($this->car) === $this->capacity){
            echo("GARAGE FULL!");
        }else{
            $this->car = $car;
        }
    }




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set locate
     *
     * @param string $locate
     *
     * @return Garage
     */
    public function setLocate($locate)
    {
        $this->locate = $locate;

        return $this;
    }

    /**
     * Get locate
     *
     * @return string
     */
    public function getLocate()
    {
        return $this->locate;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Garage
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Garage
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getModifyAt()
    {
        return $this->modifyAt;
    }

    /**
     * @param \DateTime $modifyAt
     */
    public function setModifyAt($modifyAt)
    {
        $this->modifyAt = $modifyAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getCar()
    {
        return $this->car;
    }

//    /**
//     * @param ArrayCollection $car
//     */
//    public function setCar($car)
//    {
//        $this->car = $car;
//    }
}

