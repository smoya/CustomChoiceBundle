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

/**
 * Smoya\Bundle\CustomChoiceBundle\Entity\CustomChoiceType
 */
class CustomChoiceType
{
    protected $id;

    protected $name;


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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
}
