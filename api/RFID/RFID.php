<?php
/**
 * RFID.php by Sheol
 * 01/03/2015 - 00:00
 */

namespace api\RFID;

class RFID {
    private $_classKey;
    private $_classUsersLoad;
    private $_classLecteurLoad;
    
    public function __construct() {
        spl_autoload_register(__NAMESPACE__.'\\RFID::loader');
        $this->_classKey = new classes\Key();
        $this->_classLecteurLoad = new classes\LecteurLoad();
        $this->_classUsersLoad = new classes\UsersLoad();
    }
    
    private function loader($classe) {
        $tab = explode('\\', $classe);
        if (file_exists(__DIR__.'/'.$tab[2].'/'.$tab[3].'.class.php')) {
            require_once (__DIR__.'/'.$tab[2].'/'.$tab[3].'.class.php');
        }
    }

    private function &findGoodMethod($class, $method, $param) {
        foreach (get_class_methods($class) as $data) {
            if ($method === $data) {
                $tmp = $class->$method($param);
                return $tmp;
            }
        }
        echo 'ERROR: '.$method.' no found in '.get_class($class).' Class.<br/>';
        return $method;
    }

    public function &getClassKey($method, $param = NULL) {
        return $this->findGoodMethod($this->_classKey, $method, $param);
    }

    public function &getClassUsersLoad($method, $param = NULL) {
        return $this->findGoodMethod($this->_classUsersLoad, $method, $param);
    }

    public function &getClassLecteurLoad($method, $param = NULL) {
        return $this->findGoodMethod($this->_classLecteurLoad, $method, $param);
    }

    public function getUser($key) {
        $this->_classKey->setKey($key, $this->_classLecteurLoad->getDico());
        return $this->_classUsersLoad->getUserByKey($this->_classKey->getKey());
    }
}
