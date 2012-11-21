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

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Doctrine\ORM\EntityManager;
use Smoya\Bundle\CustomChoiceBundle\Form\Extension\ChoiceList\CustomChoiceList;

class CustomChoiceManager
{
    protected $em;
    protected $repository;
    protected $class;
    protected $container;

    /**
     * Constructor.
     */
    public function __construct(EntityManager $em, $container, $class)
    {
        $this->class = $class;
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $this->container = $container;
    }

    public function getChoicesByType($type, $viewAll = false, $noMapping = false)
    {
        //TODO Use Constants for not use Join

        $query = $this->em->createQueryBuilder()
            ->select('c, t')
            ->from('SmoyaCustomChoiceBundle:CustomChoice','c')
            ->join('c.type', 't')
            ->orderBy('c.isDefault', 'DESC')
            ->addOrderBy('c.priority', 'ASC')
            ->addOrderBy('c.name', 'ASC')
        ;

        $viewAll ? $query->where('t.name = :type') : $query->where('t.name = :type AND c.visible = 1');

        $query = $query->getQuery();
        $query->setParameter('type', $type);
        $choices = $query->getResult();

        if (!$choices) {
            throw new NotFoundHttpException('ChoiceType or CustomChoice not found for choiceType \'' . $type . '\'');
        }

        if ($this->isDataRange($choices)) {
            $choices = $this->makeDataRange($choices);
            $choices = new CustomChoiceList($choices, true, $noMapping);
        }

        return $choices;
    }

    private function makeDataRange($choices)
    {
        $max=$choices[0]->getMaxValue();
        $min=$choices[0]->getMinValue();

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
