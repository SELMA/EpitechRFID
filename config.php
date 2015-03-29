<?php
/**
 * config.php by Sheol
 * 01/03/2015 - 00:00
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

function loaderApi($class) {
    $api = explode('\\', $class);
    if (file_exists(__DIR__.'/'.$api[0].'/'.$api[1].'/'.$api[1].'.php')) {
        require_once __DIR__.'/'.$api[0].'/'.$api[1].'/'.$api[1].'.php';
    }
}

spl_autoload_register('loaderApi');
