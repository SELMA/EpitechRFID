<?php

require_once './config.php';

$rfid = new api\RFID\RFID();

/* retourne l'user & décode la clée au passage ! */
echo $rfid->getUser("966f46");
