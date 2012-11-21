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
 * Smoya\Bundle\EntityFeaturesBundle\Entity\CustomChoice
 */
class CustomChoice
{
    protected $id;

    protected $name;

    protected $type;

    protected $isDefault;

    protected $value;

    protected $rangeMin;

    protected $rangeMax;

    protected $dataRange;

    protected $priority;

    protected $enabled = true;

    protected $visible = true;

    protected $text;


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

    /**
     * Set order
     *
     * @param integer $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set type
     *
     * @param Smoya\Bundle\CustomChoiceBundle\Entity\CustomChoiceType $type
     */
    public function setType(\Smoya\Bundle\CustomChoiceBundle\Entity\CustomChoiceType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return Smoya\Bundle\CustomChoiceBundle\Entity\CustomChoiceType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set rangeMax
     *
     * @param integer $rangeMax
     */
    public function setRangeMax($rangeMax)
    {
        $this->rangeMax = $rangeMax;
    }

    /**
     * Get rangeMax
     *
     * @return integer
     */
    public function getRangeMax()
    {
        return $this->rangeMax;
    }

    /**
     * Set rangeMin
     *
     * @param integer $rangeMin
     */
    public function setRangeMin($rangeMin)
    {
        $this->rangeMin = $rangeMin;
    }

    /**
     * Get rangeMin
     *
     * @return integer
     */
    public function getRangeMin()
    {
        return $this->rangeMin;
    }

    /**
     * Set value
     *
     * @param integer $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * Set dataRange
     *
     * @param boolean $dataRange
     */
    public function setDataRange($dataRange)
    {
        $this->dataRange = $dataRange;
    }

    /**
     * Get dataRange
     *
     * @return boolean
     */
    public function getDataRange()
    {
        return $this->dataRange;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text
     */
    public function getText()
    {
        return $this->text;
    }
}
