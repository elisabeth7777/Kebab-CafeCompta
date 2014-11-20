<?php

namespace Kebab\CaisseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kebab\CaisseBundle\Entity\AchatRepository")
 */
class Achat
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;
    
    /**
     * @ORM\ManyToOne(targetEntity="Kebab\CaisseBundle\Entity\Fournisseur")
     * @ORM\JoinColumn(nullable=false)
     */    
    private $fournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="MoyenPaiement", type="string", length=255)
     */
    private $moyenPaiement;

    /**
     * @var string
     *
     * @ORM\Column(name="Prix", type="decimal", scale=2)
     */
    private $prix;


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
     * @return Achat
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
     * Set moyenPaiement
     *
     * @param string $moyenPaiement
     * @return Achat
     */
    public function setMoyenPaiement($moyenPaiement)
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    /**
     * Get moyenPaiement
     *
     * @return string 
     */
    public function getMoyenPaiement()
    {
        return $this->moyenPaiement;
    }

    /**
     * Set prix
     *
     * @param string $prix
     * @return Achat
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set fournisseur
     *
     * @param \Kebab\CaisseBundle\Entity\Fournisseur $fournisseur
     * @return Achat
     */
    public function setFournisseur(\Kebab\CaisseBundle\Entity\Fournisseur $fournisseur)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \Kebab\CaisseBundle\Entity\Fournisseur 
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }
}
