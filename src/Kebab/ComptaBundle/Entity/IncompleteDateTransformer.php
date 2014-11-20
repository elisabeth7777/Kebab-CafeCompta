<?php
namespace Kebab\ComptaBundle\Entity;

use Symfony\Component\Form\DataTransformerInterface;

class IncompleteDateTransformer implements DataTransformerInterface
{
/**
 * Do nothing when transforming from norm -> view
 */
public function transform($object)
{
    return $object;
}

/**
 * If some components of the date is missing we'll add those. 
 * This reverse transform will work when month and/or day is missing
 *
 */
public function reverseTransform($date)
{
    if (!is_array($date)) {
        return $date;
    }

    if (empty($date['year'])) {
        return $date;
    }

    if (empty($date['day'])) {
        $date['day']=1;
    }

    if (empty($date['month'])) {
        $date['month']=1;
    }

    return $date;
}
} 
