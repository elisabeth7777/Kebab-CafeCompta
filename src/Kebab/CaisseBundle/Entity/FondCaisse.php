<?php

namespace Kebab\CaisseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FondCaisse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kebab\CaisseBundle\Entity\FondCaisseRepository")
 */
class FondCaisse
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
     * @var string
     *
     * @ORM\Column(name="Solde", type="decimal", scale=2)
     */
    private $solde;

    /**
     * @ORM\ManyToOne(targetEntity="Kebab\CaisseBundle\Entity\Vente")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vente;

    /**
     * @var string
     *
     * @ORM\Column(name="Achats", type="decimal", scale=2)
     */
    private $achats;

    /**
     * @var string
     *
     * @ORM\Column(name="Versements", type="decimal", scale=2)
     */
    private $versements;


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
     * @return FondCaisse
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
     * Set solde
     *
     * @param string $solde
     * @return FondCaisse
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get solde
     *
     * @return string 
     */
    public function getSolde()
    {
        return $this->solde;
    }


    /**
     * Set achats
     *
     * @param string $achats
     * @return FondCaisse
     */
    public function setAchats($achats)
    {
        $this->achats = $achats;

        return $this;
    }

    /**
     * Get achats
     *
     * @return string 
     */
    public function getAchats()
    {
        return $this->achats;
    }

    /**
     * Set versements
     *
     * @param string $versements
     * @return FondCaisse
     */
    public function setVersements($versements)
    {
        $this->versements = $versements;

        return $this;
    }

    /**
     * Get versements
     *
     * @return string 
     */
    public function getVersements()
    {
        return $this->versements;
    }

    /**
     * Set vente
     *
     * @param \Kebab\CaisseBundle\Entity\Vente $vente
     * @return FondCaisse
     */
    public function setVente(\Kebab\CaisseBundle\Entity\Vente $vente)
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * Get vente
     *
     * @return \Kebab\CaisseBundle\Entity\Vente 
     */
    public function getVente()
    {
        return $this->vente;
    }
}
