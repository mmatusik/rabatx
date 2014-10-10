<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class LoginForm extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round full-width-input'
            ),
            'options' => array(
                'label' => 'Login użytkownika',
                'label_attributes' => array(
                    'for'  => 'login-username'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'pass',
            'attributes' => array(
                'type' => 'password',
                'class'  => 'round full-width-input'
            ),
            'options' => array(
                'label' => 'Hasło',
                'label_attributes' => array(
                    'for'  => 'login-password'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Zaloguj Się',
                'class' => 'button round blue image-right ic-right-arrow',
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            array(
                'name' => 'username',
                'required' => true,
            ),
            array(
                'name' => 'pass',
                'required' => true,              
            ), 
        );
    }
}
