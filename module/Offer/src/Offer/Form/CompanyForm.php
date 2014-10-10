<?php

namespace Offer\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\InputFilter\InputFilter;

class CompanyForm extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add(array(
            'name' => 'company',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round default-width-input',
                'id' => 'tags'
            ),
            'options' => array(
                'label' => 'Nazwa firmy',
                'label_attributes' => array(
                    'for'  => 'tags',
                    'class'  => 'label_max'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Dalej',
                'class' => 'button round blue image-right ic-right-arrow',
            ),
        ));
    }

    public function getInputFilterSpecification()
    {

        return array(
            array(
                'name' => 'company',
                'required' => true,
            ),
        );
    }
}
