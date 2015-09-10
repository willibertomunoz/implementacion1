<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application_Model_DbTable_MateriasCursadas
 *
 * @author Guillermo
 */
class Application_Model_DbTable_MateriasCursadas extends Zend_Db_Table_Abstract {

    //put your code here
    protected $_name = 'materiascursadas';

    public function getMateriaEstudiante($usuario) {
        $select = $this->_db
                ->select()
                ->from($this->_name)
                ->joininner(array('m' => 'materia'), 'm.idMateria = materiascursadas.idMateria')
                ->where('materiascursadas.cedula = ?', $usuario);
        $result = $this->_db->fetchAll($select);
        return $result;
    }

    public function addMateria($materia, $cedula, $nota, $estado, $semestre) {
        $data = array(
            'idMateria' => $materia,
            'cedula' => "540590",
            'promedio' => $nota,
            'estado' => $estado,
            'fechaCursada' => $semestre,
        );
        $this->insert($data);
    }

}
