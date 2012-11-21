<?php

/*
 * This file is part of the CustomChoiceBundle Package.
 *
 * (c) Sergio Moya <smoya89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoya\Bundle\CustomChoiceBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Util\PropertyPath;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\ORM\EntityManager;
use Smoya\Bundle\CustomChoiceBundle\Form\Extension\ChoiceList\CustomChoiceList;

class CustomChoiceToIdTransformer implements DataTransformerInterface
{
    private $choiceList;

    public function __construct(CustomChoiceList $choiceList = null)
    {
        $this->choiceList = $choiceList;
    }

    /**
     * Transforms entities into choice keys.
     *
     * @param Collection|object $entity A collection of entities, a single entity or NULL
     *
     * @return mixed An array of choice keys, a single key or NULL
     */
    public function transform($entity)
    {
        if (null === $entity || '' === $entity) {
            return '';
        }

        if (!is_object($entity)) {
            throw new UnexpectedTypeException($entity, 'object');
        }

        if ($entity instanceof Collection) {
            throw new \InvalidArgumentException('Expected an object, but got a collection. Did you forget to pass "multiple=true" to an entity field?');
        }

        if ($entity instanceof CustomChoice) {
            return $entity->getId();
        }
    }

    /**
     * Transforms choice keys into entities.
     *
     * @param mixed $key An array of keys, a single key or NULL
     *
     * @return Collection|object  A collection of entities, a single entity or NULL
     */
    public function reverseTransform($key)
    {
        if ('' === $key || null === $key) {
            return null;
        }

        $return = $key;
        if ($this->choiceList) {
            $return = $this->choiceList->getChoiceByKey($key);
        }

        return $return;
    }
}