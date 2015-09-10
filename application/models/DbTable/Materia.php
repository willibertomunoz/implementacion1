<?php

class Application_Model_DbTable_Materia extends Zend_Db_Table_Abstract {

    protected $_name = 'Materia';

    public function getMaterias() {
        $select = $this->_db
		  ->select()
                  ->from($this->_name);
      return $this->_db->fetchAll($select);
    }

    public function getMateria($id) {
        $EIA = new Application_Model_DbTable_MateriasCursadas();
        $l = $EIA->getMateriaEstudiante($id);
        $this->view->EIA = $EIA->fetchALL();
    }

    public function addMateria($artist, $title) {
        $data = array(
            'nombre' => $nombre,
            'creditos' => $creditos,
            'periodo' => $periodo,
        );
        $this->insert($data);
    }

    public function updateMateria($id, $nombre, $creditos, $periodo) {
        $data = array(
            'nombre' => $nombre,
            'creditos' => $creditos,
            'periodo' => $periodo,
        );
        $this->update($data, 'id = ' . (int) $id);
    }

    public function deleteMateria($id) {
        $this - delete('id =' . (int) $id);
    }

    public function searchMateria($nombre) {
        $row = $this->fetchRow('nombre = "' . $nombre . '"');
        if (!$row) {
            throw new Exception("Could not find row $nombre");
        }
        return $row->toArray();
    }

}
