<?php

//
class Application_Form_Crearmateria extends Zend_Form {

    public function init() {
        $this->setName('Añadir Materia');
        $select = array();
        $materia = new Application_Model_DbTable_Materia();
        $materiasel = $materia->getMaterias();

        for ($i = 0; $i < count($materiasel); $i++) {
            $select[]=array($materiasel[$i]["idMateria"]=> $materiasel[$i]["nombre"]);
        }

        $this->addElement('select', 'materia', array(
            'label' => 'Materia',
            'class' => 'form-control',
            'required' => true,
            'multiOptions' => $select
        ));

        $nota = new Zend_Form_Element_Text('nota');

        $nota->setLabel('nota')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->setOptions(array('class' => 'form-control'))
                ->addValidator('NotEmpty');

        $cursadas = new Zend_Form_Element_Radio('estado');
        $cursadas->setLabel('Aprobada o Reprobada')
                ->addMultiOptions(array('Aprobada' => 'Aprobada', 'Reprobada' => 'Reprobada'));
        $semestre = new Zend_Form_Element_Text('semestre');
        $semestre->setLabel('semestre')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->setOptions(array('class' => 'form-control'))
                ->addValidator('NotEmpty');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('materia', 'submitbutton');

        $this->addElements(array($materia, $nota, $semestre, $cursadas, $submit));
    }

}
