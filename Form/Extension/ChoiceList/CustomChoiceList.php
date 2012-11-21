<?php

/*
 * This file is part of the CustomChoiceBundle Package.
 *
 * (c) Sergio Moya <smoya89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoya\Bundle\CustomChoiceBundle\Form\Extension\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class CustomChoiceList extends SimpleChoiceList
{
    protected $choices;
    protected $isDataRange;

    public function __construct(array $choices, $isDataRange = null, $noMapping = false)
    {
        $this->choices = $choices;
        $this->isDataRange = $isDataRange;

        if ($noMapping) {
            $this->loadEntities();
        }

        parent::__construct($this->choices);
    }

    private function loadEntities()
    {
        $choices = $this->choices;
        $choicesArray = array();
        foreach ($choices as $key => $value) {
            $choicesArray[$value->getId()] = $value;
        }

        $this->choices = $choicesArray;
    }

    public function getChoices()
    {
        return $this->choices;
    }

    public function setChoices($choices)
    {
        $this->choices = $choices;
    }

    public function getIsDataRange()
    {
        return $this->isDataRange;
    }

    public function setIsDataRange($dataRange)
    {
        $this->isDataRange = $dataRange;
    }

    public function getChoiceByKey($key)
    {
        $choices = $this->getChoices();

        if (array_key_exists($key, $choices)) {
            return $choices[$key];
        }
    }
}
