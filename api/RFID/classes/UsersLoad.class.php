<?php
/**
 * UsersLoad.class.php by Sheol
 * 01/03/2015 - 00:34
 */

namespace api\RFID\classes;

class UsersLoad {
    private $_userList;
    private $_path = '/../config/users.json';

    public function __construct() {
        $this->loadUserFile();
    }

    public function getUserByKey($key) {
        if ($this->loadUserFile()) {
            $i = -1;
            while (++$i < 10) {
                foreach (array_keys($this->_userList) as $item) {
                    if ($key === substr($item, $i)) {
                        return @$this->_userList[$item];
                    }
                }
            }
            return @$this->_userList[$key];
        }
        return NULL;
    }

    public function getUserList() {
        return $this->_userList;
    }

    public function getPath() {
        return $this->_path;
    }

    private function loadUserFile() {
        if (file_exists(__DIR__.$this->_path)) {
            $config = fopen(__DIR__.$this->_path, 'r');
            $data = "";
            while (!feof($config)) {
                $data .= fread($config, 512);
            }
            $this->_userList = json_decode($data, true);
            fclose($config);
            return true;
        } else {
            echo "Error : Users list file no found !<br />";
            return false;
        }
    }
}
