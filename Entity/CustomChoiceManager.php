<?php

/*
 * This file is part of the CustomChoiceBundle Package.
 *
 * (c) Sergio Moya <smoya89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoya\Bundle\CustomChoiceBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Smoya\Bundle\CustomChoiceBundle\Form\Extension\ChoiceList\CustomChoiceList;

class CustomChoiceManager
{
    protected $em;
    protected $class;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getChoicesByType($type, $viewAll = false, $noMapping = false)
    {
        //TODO Use Constants for not use Join
        $qb = $this->em->createQueryBuilder()
            ->select('c, t')
            ->from('SmoyaCustomChoiceBundle:CustomChoice','c')
            ->join('c.type', 't')
            ->orderBy('c.isDefault', 'DESC')
            ->addOrderBy('c.priority', 'ASC')
            ->addOrderBy('c.name', 'ASC')
        ;

        $viewAll ? $qb->where('t.name = :type') : $qb->where('t.name = :type AND c.visible = 1');

        $query = $qb->getQuery();
        $query->setParameter('type', $type);

        $choices = $query->getResult();

        if (!$choices) {
            throw new NoResultException();
        }

        if ($this->isDataRange($choices)) {
            $choices = $this->makeDataRange($choices);
            $choices = new CustomChoiceList($choices, true, $noMapping);
        }

        return $choices;
    }

    private function makeDataRange($choices)
    {
        $max=$choices[0]->getRangeMax();
        $min=$choices[0]->getRangeMin();

        $choices = array();

        for($min; $min <= $max; $min++)
        {
            $choices[$min] = $min;
        }

        return $choices;
    }

    private function isDataRange($choices)
    {
        if(sizeof($choices) == 1)
        {
            if($choices[0]->getDataRange())
            {
                return true;
            }
        }
    }
}
