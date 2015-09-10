<?php

class AlumnoController extends Zend_Controller_Action {

    var $cedula = "540590";

    public function init() {
        $EIA = new Application_Model_DbTable_Estudiante();
        $datos = $EIA->getDatos_personales($this->cedula);
        $this->nombre = $datos['Nombre'];
        $this->view->nombre = $datos['Nombre'];
    }

    public function indexAction() {
        $EIA = new Application_Model_DbTable_Estudiante();
        $datos = $EIA->getDatos_personales($this->cedula);
        $html = " 
            <div class='table-responsive'>   
            <table class='table'>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>correo</th>
                    <th>Direccion</th>
                    <th>Usuario</th>
                </tr> 
            <tr>
                <td>" . $datos['cedula'] . "</td>
                <td>" . $datos['Nombre'] . "</td>
                <td>" . $datos['Apellido'] . "</td>
                <td>" . $datos['correo'] . "</td>
                <td>" . $datos['direccion'] . "</td>
                <td>" . $datos['usuario'] . "</td>
            </tr></table></div>";
        $this->view->html = $html;
        $this->view->nombre = $datos['Nombre'];
    }

    public function vermateriaAction() {
        $EIA = new Application_Model_DbTable_Estudiante();
        $materias = $EIA->getMaterias_cursadas($this->cedula);
        $html = " 
            <div class='table-responsive'>   
            <table class='table'>
                <tr>
                    <th>Materia</th>
                    <th>Estado</th>
                    <th>Nota</th>
                    <th>Fecha Cursada</th>
                </tr>";
        for ($i = 0; $i < count($materias); $i++) {
            $html = $html . " 
            <tr>
                <td>" . $materias[$i]['nombre'] . "</td>
                <td>" . $materias[$i]['estado'] . "</td>
                <td>" . $materias[$i]['promedio'] . "</td>
                <td>" . $materias[$i]['fechaCursada'] . "</td>
            </tr>";
        }
        $html = $html . "</table></div>";
        $this->view->html = $html;
    }

    public function materiasfaltantesAction() {
        $EIA = new Application_Model_DbTable_Estudiante();
        $materias = $EIA->getMaterias_nocursadas($this->cedula);
        $html = " 
            <div class='table-responsive'>   
            <table class='table'>
                <tr>
                    <th>Materia</th>
                    <th>Credito</th>
                    <th>Periodo</th>
                </tr>";
        for ($i = 0; $i < count($materias); $i++) {
            $html = $html . " 
            <tr>
                <td>" . $materias[$i]['nombre'] . "</td>
                <td>" . $materias[$i]['creditos'] . "</td>
                <td>" . $materias[$i]['promedio'] . "</td>
            </tr>";
        }
        $html = $html . "</table></div>";
        $this->view->html = $html;
    }

    public function crearmateriaAction() {
        $form = new Application_Form_CrearMateria();
        $form->submit->setLabel('Agregar');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $materia = $form->getValue('materia');
                $nota = $form->getValue('nota');
                $estado = $form->getValue('estado');
                $semestre = $form->getValue('semestre');
                $EIA = new Application_Model_DbTable_MateriasCursadas();
                $EIA->addMateria($materia, $this->cedula, $nota, $estado, $semestre);
                $this->_helper->redirector('vermateria');
            } else {
                $form->populate($formData);
            }
        }
    }

}
