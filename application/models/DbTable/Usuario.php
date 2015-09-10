<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract {

    protected $_name = 'Usuario';

    public function login($usuario, $password) {
//	$row = $this->fetchRow('password ='.$password); //'usuario = ?' , $usuario);// . 'AND password = ' . $password);
        $select = $this->_db
                ->select()
                ->from($this->_name)
                ->where('usuario = "' . $usuario . '" AND password = "' . $password . '"');
        echo $select;
        $result = $this->_db->fetchRow($select);
        
        return $result;
//($select);
//	if (!$row) {
//	    throw new Exception("Usuario o conteaseña incorrecta");
//	}
//	return $row->toArray();
    }

    public function datos($usuario) {
//	$row = $this->fetchRow('password ='.$password); //'usuario = ?' , $usuario);// . 'AND password = ' . $password);
        $select = $this->_db
                ->select()
                ->from($this->_name)
                ->where('cedula = ?', $usuario);
        $result = $this->_db->fetchRow($select);

        return $result;
    }

}
