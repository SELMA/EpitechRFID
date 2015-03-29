<?php
/**
 * Key.class.php made by Sheol
 * 29/03/2015 - 13:43
 */

namespace api\RFID\classes;

class Key {
    private $_key;
    private $_dico;

    public function setKey($key, $dico) {
        $this->_key = $key;
        $this->_dico = $dico;
        $this->decodeKey();
    }

    public function getKey() {
        return $this->_key;
    }

    private function decodeKey() {
        if (!is_numeric($this->_key)) {
            if (ctype_xdigit($this->_key)) {
                $this->_key = base_convert($this->_key, 16, 10);
            }
            $this->replaceCarac();
        }
        $this->_key = dechex(intval($this->_key));
    }

    private function replaceCarac() {
        $this->_key = str_replace(array_keys($this->_dico),
            array_values($this->_dico),
            $this->_key);
    }
}
