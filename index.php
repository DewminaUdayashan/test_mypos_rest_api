<?php

/**
 * DO NOT REMOVE 
 */
require 'configuration/config.php';
require 'configuration/DatabaseSettings.php';


spl_autoload_register('autoloader');

function autoloader($className)
{
    $path = LIBS . $className . '.php';
    require $path;
}



/**
 * @todo Default Controller Should Be 'home.php' or you can define custom class named Home ($bootstrap->setDefaultFile('index.php');)
 */
$run = new RunSite();
$run->init();