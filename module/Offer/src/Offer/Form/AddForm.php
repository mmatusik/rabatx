<?php

namespace Offer\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\InputFilter\InputFilter;

class AddForm extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round default-width-input'
            ),
            'options' => array(
                'label' => 'Nazwa oferty',
                'label_attributes' => array(
                    'class'  => 'label_left'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'oldprice',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round default-width-input'
            ),
            'options' => array(
                'label' => 'Stara cena',
                'label_attributes' => array(
                    'class'  => 'label_left'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'newprice',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round default-width-input'
            ),
            'options' => array(
                'label' => 'Nowa cena',
                'label_attributes' => array(
                    'class'  => 'label_left'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'end_time',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round default-width-input',
                'id' => 'picker'
            ),
            'options' => array(
                'label' => 'Czas trwania oferty',
                'label_attributes' => array(
                    'class'  => 'label_left'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'code_count',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round default-width-input'
            ),
            'options' => array(
                'label' => 'Ilość kodów',
                'label_attributes' => array(
                    'class'  => 'label_left'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'code_per_person',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round default-width-input'
            ),
            'options' => array(
                'label' => 'Ilośc kodów na osobę',
                'label_attributes' => array(
                    'class'  => 'label_left'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'disc',
            'attributes' => array(
                'type' => 'textarea',
                'class'  => 'round full-width-textarea'
            ),
            'options' => array(
                'label' => 'Opis oferty',
                'label_attributes' => array(
                    //'class'  => 'label_left'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'how',
            'attributes' => array(
                'type' => 'textarea',
                'class'  => 'round full-width-textarea'
            ),
            'options' => array(
                'label' => 'Jak skorzystać',
                'label_attributes' => array(
                   // 'class'  => 'label_left'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'worth',
            'attributes' => array(
                'type' => 'textarea',
                'class'  => 'round full-width-textarea'
            ),
            'options' => array(
                'label' => 'Dlaczego warto',
                'label_attributes' => array(
                    //'class'  => 'label_left'
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
                'name' => 'newprice',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Digits',
                    )
                ),  
            ),
            array(
                'name' => 'oldprice',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Digits',
                    )
                ),  
            ),
            array(
                'name' => 'name',
                'required' => true, 
            ),
            array(
                'name' => 'end_time',
                'required' => true, 
            ),
            array(
                'name' => 'worth',
                'required' => true, 
            ),
            array(
                'name' => 'how',
                'required' => true, 
            ),
            array(
                'name' => 'disc',
                'required' => true, 
            ),
            array(
                'name' => 'code_count',
                'required' => true, 
                'validators' => array(
                    array(
                        'name' => 'Digits',
                    )
                ), 
            ),
            array(
                'name' => 'code_per_person',
                'required' => true, 
                'validators' => array(
                    array(
                        'name' => 'Digits',
                    )
                ), 
            ),
        );
    }
}
