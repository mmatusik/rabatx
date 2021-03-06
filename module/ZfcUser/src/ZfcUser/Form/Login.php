<?php

namespace ZfcUser\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use ZfcUser\Options\AuthenticationOptionsInterface;

class Login extends ProvidesEventsForm
{
    /**
     * @var AuthenticationOptionsInterface
     */
    protected $authOptions;

    public function __construct($name, AuthenticationOptionsInterface $options)
    {
        $this->setAuthenticationOptions($options);
        parent::__construct($name);

        $this->add(array(
            'name' => 'identity',
            'attributes' => array(
                'type' => 'text',
                'class'  => 'round full-width-input'
            ),
            'options' => array(
                'label' => '',
                'label_attributes' => array(
                    'for'  => 'login-username'
                ),
            ),
        ));

        $emailElement = $this->get('identity');
        $label = $emailElement->getLabel('label');
        // @TODO: make translation-friendly
        foreach ($this->getAuthenticationOptions()->getAuthIdentityFields() as $mode) {
            $label = (!empty($label) ? $label . ' or ' : '') . ucfirst($mode);
        }
        $emailElement->setLabel($label);
        //
        $this->add(array(
            'name' => 'credential',
            'options' => array(
                'label' => 'Password',
                'label_attributes' => array(
                    'for'  => 'login-username'
                ),
            ),
            'attributes' => array(
                'type' => 'password',
                'class'  => 'round full-width-input'
            ),
        ));

        // @todo: Fix this
        // 1) getValidator() is a protected method
        // 2) i don't believe the login form is actually being validated by the login action
        // (but keep in mind we don't want to show invalid username vs invalid password or
        // anything like that, it should just say "login failed" without any additional info)
        //$csrf = new Element\Csrf('csrf');
        //$csrf->getValidator()->setTimeout($options->getLoginFormTimeout());
        //$this->add($csrf);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Zaloguj Się',
                'class' => 'button round blue image-right ic-right-arrow',
            ),
        ));

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Set Authentication-related Options
     *
     * @param AuthenticationOptionsInterface $authOptions
     * @return Login
     */
    public function setAuthenticationOptions(AuthenticationOptionsInterface $authOptions)
    {
        $this->authOptions = $authOptions;
        return $this;
    }

    /**
     * Get Authentication-related Options
     *
     * @return AuthenticationOptionsInterface
     */
    public function getAuthenticationOptions()
    {
        return $this->authOptions;
    }
}
