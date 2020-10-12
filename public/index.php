<?php

require_once '../vendor/autoload.php';

$router = new AltoRouter();

/* params for routes :
    - html request method
    - path for this route
    - array :
        controller name
        method name
*/
// home
$router->map('GET', '/', array('c' => 'KrakenController', 'a' => 'index'));
// create a kraken
$router->map('POST', '/create', array('c' => 'KrakeController', 'a' => 'create'));



$match = $router->match();

// get wanted controller
$controller = 'App\\Controller\\' . $match['target']['c'];

// get method for this route
$action = $match['target']['a'];

// will instanciate the object according to url
$object = new $controller();

// call the method
$print = $object->{$action}();


echo $print;