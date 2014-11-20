<?php

namespace Kebab\CaisseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kebab\CaisseBundle\Entity\ArticleRepository")
 */
class Article
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
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="CodeCpte", type="integer", length=6, unique=true)
     */
    private $codeCpte;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Taxes", type="decimal", scale=2)
     */
    private $taxes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Type", type="boolean", scale=2)
     */
    private $type;


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
     * Set nom
     *
     * @param string $nom
     * @return Article
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set taxes
     *
     * @param string $taxes
     * @return Article
     */
    public function setTaxes($taxes)
    {
        $this->taxes = $taxes;

        return $this;
    }

    /**
     * Get taxes
     *
     * @return string 
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return Article
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function getName(){
        return $this->codeCpte.' - '.$this->nom;
    }

    /**
     * Set codeCpte
     *
     * @param integer $codeCpte
     * @return Article
     */
    public function setCodeCpte($codeCpte)
    {
        $this->codeCpte = $codeCpte;

        return $this;
    }

    /**
     * Get codeCpte
     *
     * @return integer 
     */
    public function getCodeCpte()
    {
        return $this->codeCpte;
    }
}
