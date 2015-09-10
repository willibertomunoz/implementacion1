<?php

class Application_Model_DbTable_Estudiante extends Zend_Db_Table_Abstract {

    protected $_name = 'Estudiante';
    private $cedula, $carrera, $creditos_cursados;

    public function getDatos_personales($cedula) {
        $EIA = new Application_Model_DbTable_Usuario();
        $l = $EIA->datos($cedula);
        return $l;
    }

    public function getMaterias_cursadas($id) {
        $EIA = new Application_Model_DbTable_MateriasCursadas();
        $l = $EIA->getMateriaEstudiante($id);
        return $l;
    }

    public function getMaterias_nocursadas($id) {
        $select = $this->_db->select()
                ->from('materia')
                ->joinLeft(array('mc' => 'materiascursadas'), 'materia.idMateria != mc.idMateria')
                ->where('mc.cedula = ?', $id);
        echo $select;
        $result = $this->_db->fetchAll($select);
        return $result;
    }

    public function setCarrera($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not fin row $id");
        }
        return $row->toArray();
    }

    public function setCreditos_cursados($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not fin row $id");
        }
        return $row->toArray();
    }

    public function addMaterias_cursadas($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not fin row $id");
        }
        return $row->toArray();
    }

    public function setDatos_personales($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not fin row $id");
        }
        return $row->toArray();
    }

    public function deleteMateria($id) {
        $this - delete('id =' . (int) $id);
    }

}
