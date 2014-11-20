<?php

namespace Kebab\CaisseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kebab\CaisseBundle\Entity\VenteRepository")
 */
class Vente
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
     * @ORM\Column(name="Especes", type="decimal", scale=2)
     */
    private $especes;

    /**
     * @var string
     *
     * @ORM\Column(name="CB", type="decimal", scale=2)
     */
    private $cB;

    /**
     * @var string
     *
     * @ORM\Column(name="CH", type="decimal", scale=2)
     */
    private $cH;
    /**
    * @ORM\OneToMany(targetEntity="Kebab\CaisseBundle\Entity\ArticleVente", mappedBy="vente", cascade={"persist"})
    */
    private $articleventes;

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
     * @return Vente
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
     * Set especes
     *
     * @param string $especes
     * @return Vente
     */
    public function setEspeces($especes)
    {
        $this->especes = $especes;

        return $this;
    }

    /**
     * Get especes
     *
     * @return string 
     */
    public function getEspeces()
    {
        return $this->especes;
    }

    /**
     * Set cB
     *
     * @param string $cB
     * @return Vente
     */
    public function setCB($cB)
    {
        $this->cB = $cB;

        return $this;
    }

    /**
     * Get cB
     *
     * @return string 
     */
    public function getCB()
    {
        return $this->cB;
    }

    /**
     * Set cH
     *
     * @param string $cH
     * @return Vente
     */
    public function setCH($cH)
    {
        $this->cH = $cH;

        return $this;
    }

    /**
     * Get cH
     *
     * @return string 
     */
    public function getCH()
    {
        return $this->cH;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articleventes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articleventes
     *
     * @param \Kebab\CaisseBundle\Entity\ArticleVente $articleventes
     * @return Vente
     */
    public function addArticlevente(\Kebab\CaisseBundle\Entity\ArticleVente $articleventes)
    {
        $this->articleventes[] = $articleventes;
//        $articleventes->setVente($this);
        return $this;
    }

    /**
     * Remove articleventes
     *
     * @param \Kebab\CaisseBundle\Entity\ArticleVente $articleventes
     */
    public function removeArticlevente(\Kebab\CaisseBundle\Entity\ArticleVente $articleventes)
    {
        $this->articleventes->removeElement($articleventes);
    }

    /**
     * Get articleventes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticleventes()
    {
        return $this->articleventes;
    }
}
