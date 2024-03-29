<?php

namespace Kebab\ComptaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TauxRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TauxRepository extends EntityRepository
{
    public function findPatByYear($year){
        $query = $this->_em->createQuery('SELECT t FROM KebabComptaBundle:Taux t WHERE YEAR(t.annee)=:year AND t.type=:pat');
        $query->setParameter('year', $year);
        $query->setParameter('pat', 'PAT');
        return $query->getOneOrNullResult();
    }
    
    public function findSalByYear($year){
        $query = $this->_em->createQuery('SELECT t FROM KebabComptaBundle:Taux t WHERE YEAR(t.annee)=:year AND t.type=:sal');
        $query->setParameter('year', $year);
        $query->setParameter('sal', 'SAL');
        return $query->getOneOrNullResult();
    }    
}
