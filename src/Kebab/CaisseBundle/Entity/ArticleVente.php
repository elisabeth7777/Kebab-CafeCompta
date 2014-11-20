<?php

namespace Kebab\CaisseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleVente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kebab\CaisseBundle\Entity\ArticleVenteRepository")
 */
class ArticleVente
{

    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Kebab\CaisseBundle\Entity\Article")
     */   
    private $article;
    
  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Kebab\CaisseBundle\Entity\Vente", inversedBy="articleventes")
   */    
    private $vente;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Montant", type="decimal", scale=2)
     */
    private $montant;


    /**
     * Set montant
     *
     * @param string $montant
     * @return ArticleVente
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set article
     *
     * @param \Kebab\CaisseBundle\Entity\Article $article
     * @return ArticleVente
     */
    public function setArticle(\Kebab\CaisseBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Kebab\CaisseBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set vente
     *
     * @param \Kebab\CaisseBundle\Entity\Vente $vente
     * @return ArticleVente
     */
    public function setVente(\Kebab\CaisseBundle\Entity\Vente $vente)
    {
        $vente->addArticlevente($this);
        $this->vente = $vente;

        return $this;
    }

    /**
     * Get vente
     *
     * @return \OCKebab\CaisseBundle\Entity\Vente 
     */
    public function getVente()
    {
        return $this->vente;
    }
}
