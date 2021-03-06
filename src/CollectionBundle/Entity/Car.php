<?php

namespace CollectionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="CollectionBundle\Repository\CarRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Car
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
     * @ORM\Column(name="serial_number", type="string", length=255, unique=true)
     */
    private $serialNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_path", type="string", length=255)
     */
    private $picturePath;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_construction", type="date")
     */
    private $dateConstruction;

    /**
     * @var string
     *
     * @ORM\Column(name="mark", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $mark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_purchase", type="date")
     */
    private $datePurchase;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

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
     * @ORM\ManyToOne(targetEntity="CollectionBundle\Entity\Category", inversedBy="car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="CollectionBundle\Entity\Garage", inversedBy="car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garage;

    /**
     * Car constructor.
     */
    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->garage = new ArrayCollection();
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
     * Set serialNumber
     *
     * @param string $serialNumber
     *
     * @return Car
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * Get serialNumber
     *
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set picturePath
     *
     * @param string $picturePath
     *
     * @return Car
     */
    public function setPicturePath($picturePath)
    {
        $this->picturePath = $picturePath;

        return $this;
    }

    /**
     * Get picturePath
     *
     * @return string
     */
    public function getPicturePath()
    {
        return $this->picturePath;
    }

    /**
     * Set dateConstruction
     *
     * @param \DateTime $dateConstruction
     *
     * @return Car
     */
    public function setDateConstruction($dateConstruction)
    {
        $this->dateConstruction = $dateConstruction;

        return $this;
    }

    /**
     * Get dateConstruction
     *
     * @return \DateTime
     */
    public function getDateConstruction()
    {
        return $this->dateConstruction;
    }

    /**
     * Set mark
     *
     * @param string $mark
     *
     * @return Car
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return string
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set datePurchase
     *
     * @param \DateTime $datePurchase
     *
     * @return Car
     */
    public function setDatePurchase($datePurchase)
    {
        $this->datePurchase = $datePurchase;

        return $this;
    }

    /**
     * Get datePurchase
     *
     * @return \DateTime
     */
    public function getDatePurchase()
    {
        return $this->datePurchase;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Car
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ArrayCollection $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param ArrayCollection $garage
     */
    public function setGarage($garage)
    {
        $this->garage = $garage;
    }

    /**
     * @return ArrayCollection
     */
    public function getGarage()
    {
        return $this->garage;
    }
}
