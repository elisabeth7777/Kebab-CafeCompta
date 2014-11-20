<?php

namespace Kebab\ComptaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kebab\ComptaBundle\Entity\SalaireRepository")
 */
class Salaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Kebab\ComptaBundle\Entity\Salarie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salarie;
    
    /**

     * @var \DateTime

     *

     * @ORM\Column(name="Date", type="date")

     */    
    private $date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SalaireNet", type="decimal", nullable=true, scale=2)
     */
    private $salaireNet;

    /**
     * @var string
     *
     * @ORM\Column(name="Avances", type="decimal", nullable=true, scale=2)
     */
    private $avances;

    /**
     * @var string
     *
     * @ORM\Column(name="SalaireBase", type="decimal", nullable=true, scale=2)
     */
    private $salaireBase;

    /**
     * @var string
     *
     * @ORM\Column(name="RepasAvantage", type="decimal", nullable=true, scale=2)
     */
    private $repasAvantage;

    /**
     * @var string
     *
     * @ORM\Column(name="Absences", type="decimal", nullable=true, scale=2)
     */
    private $absences;

    /**
     * @var string
     *
     * @ORM\Column(name="SalaireBrut", type="decimal", nullable=true, scale=2)
     */
    private $salaireBrut;

    function __construct() {
        $this->salaireBrut = NULL;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

 

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Salaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set salaireNet
     *
     * @param string $salaireNet
     * @return Salaire
     */
    public function setSalaireNet($salaireNet)
    {
        $this->salaireNet = $salaireNet;

        return $this;
    }

    /**
     * Get salaireNet
     *
     * @return string 
     */
    public function getSalaireNet()
    {
        return $this->salaireNet;
    }

    /**
     * Set avances
     *
     * @param string $avances
     * @return Salaire
     */
    public function setAvances($avances)
    {
        $this->avances = $avances;

        return $this;
    }

    /**
     * Get avances
     *
     * @return string 
     */
    public function getAvances()
    {
        return $this->avances;
    }

    /**
     * Set salaireBase
     *
     * @param string $salaireBase
     * @return Salaire
     */
    public function setSalaireBase($salaireBase)
    {
        $this->salaireBase = $salaireBase;

        return $this;
    }

    /**
     * Get salaireBase
     *
     * @return string 
     */
    public function getSalaireBase()
    {
        return $this->salaireBase;
    }

    /**
     * Set repasAvantage
     *
     * @param string $repasAvantage
     * @return Salaire
     */
    public function setRepasAvantage($repasAvantage)
    {
        $this->repasAvantage = $repasAvantage;

        return $this;
    }

    /**
     * Get repasAvantage
     *
     * @return string 
     */
    public function getRepasAvantage()
    {
        return $this->repasAvantage;
    }

    /**
     * Set absences
     *
     * @param string $absences
     * @return Salaire
     */
    public function setAbsences($absences)
    {
        $this->absences = $absences;

        return $this;
    }

    /**
     * Get absences
     *
     * @return string 
     */
    public function getAbsences()
    {
        return $this->absences;
    }

    /**
     * Set salaireBrut
     *
     * @param string $salaireBrut
     * @return Salaire
     */
    public function setSalaireBrut()
    {
        $this->salaireBrut = ($this->salaireBase + $this->repasAvantage - $this->absences);

        return $this;
    }

    /**
     * Get salaireBrut
     *
     * @return string 
     */
    public function getSalaireBrut()
    {
        return $this->salaireBrut;
    }

    /**
     * Set salarie
     *
     * @param \Kebab\ComptaBundle\Entity\Salarie $salarie
     * @return Salaire
     */
    public function setSalarie(\Kebab\ComptaBundle\Entity\Salarie $salarie)
    {
        $this->salarie = $salarie;

        return $this;
    }

    /**
     * Get salarie
     *
     * @return \Kebab\ComptaBundle\Entity\Salarie 
     */
    public function getSalarie()
    {
        return $this->salarie;
    }
}
