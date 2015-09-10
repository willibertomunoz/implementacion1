<?php

class Application_Form_vermateria extends Zend_Form {

    public function init() {

        $this->setName('login');
        $this->setOptions(array('class' => 'form-signin',
            'id' => 'contactForm', 'name' => 'contactForm'));

        $usuario = new Zend_Form_Element_Text('usuario');
        $usuario->setLabel('Usuario')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setOptions(array('class' => 'form-control'));

        $password = $this->createElement('password', 'password');
        $password->setLabel('Password')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setOptions(array('class' => 'form-control'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('usuario', 'submitbutton')
                ->setOptions(array('class' => 'btn btn-lg btn-primary btn-block'));

        $this->addElements(array($usuario, $password, $submit));
    }

}
