<?php

/*
 * This file is part of the CustomChoiceBundle Package.
 *
 * (c) Sergio Moya <smoya89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoya\Bundle\CustomChoiceBundle\Form;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityManager;
use Smoya\Bundle\CustomChoiceBundle\Form\DataTransformer\CustomChoiceToIdTransformer;
use Smoya\Bundle\CustomChoiceBundle\Form\Extension\ChoiceList\CustomChoiceList;
use Smoya\Bundle\CustomChoiceBundle\Entity\CustomChoice;

class CustomChoiceType extends AbstractType
{

    protected $em;
    protected $customChoiceManager;

    public function __construct(EntityManager $em, $customChoiceManager)
    {
        $this->em = $em;
        $this->customChoiceManager = $customChoiceManager;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $manager = $this->customChoiceManager;
        $em = $this->em;
        $resolver->setDefaults(array(
                'data_range' => function (Options $options, $value) {
                    return $options['choice_list'] instanceof CustomChoiceList ? true : false;
                },
                'choice_type' => null,
                'view_all' => false,
                'no_mapping' => false,
                'empty_value' => 'Selecciona...',
                'select_widget' => 'choice',
                'choice_list' => function (Options $options, $value) use ($manager, $em) {
                    $noMapping = array_key_exists('no_mapping', $options) && $options['no_mapping'] ? $options['no_mapping'] : false;
                    $choices = $manager->getChoicesByType($options['choice_type'], isset($options['view_all']) ? $options['view_all'] : false, $noMapping);

                    if (array_key_exists('no_mapping', $options) && $options['no_mapping'] && !$choices instanceof CustomChoiceList) {
                        return new CustomChoiceList($choices, null, $noMapping);
                    } elseif (!$choices instanceof CustomChoiceList){
                        // If Choices are Entity choices...
                        return new EntityChoiceList($em, 'UtilsCustomChoiceBundle:CustomChoice', null, null, $choices);
                    } else {
                        return $choices;
                    }
                }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'customchoice';
    }
}
