<?php
/**
 * LecteurLoad.class.php made by Sheol
 * 28/03/2015 - 16:34
 */

namespace api\RFID\classes;

class LecteurLoad {
    private $_dico;
    private $_path = '/../config/lecteur.json';

    public function __construct() {
        $this->setDico();
    }

    public function getDico() {
        return $this->_dico;
    }

    public function getPath() {
        return $this->_path;
    }

    private function setDico() {
        if (file_exists(__DIR__.$this->_path)) {
            $config = fopen(__DIR__.$this->_path, 'r');
            $data = fread($config, 512);
            $this->_dico = json_decode($data, true);
            fclose($config);
            $this->_dico = array_flip(array_map("utf8_decode", array_keys($this->_dico)));
        } else {
            $this->_dico = array(
                utf8_decode('à') => 0,
                utf8_decode('&') => 1,
                utf8_decode('é') => 2,
                utf8_decode('"') => 3,
                utf8_decode("'") => 4,
                utf8_decode('(') => 5,
                utf8_decode('-') => 6,
                utf8_decode('è') => 7,
                utf8_decode('_') => 8,
                utf8_decode('ç') => 9);
        }
    }
}
