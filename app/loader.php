<?php
require_once 'config/config.php';

spl_autoload_register(function($className){

    if($className === 'Vegetable') {
        require_once 'models/Vegetable.php';
    }
    else {
        require_once 'libs/' . $className . '.php';
    }
});
