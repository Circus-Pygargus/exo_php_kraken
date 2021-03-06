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
// user would like to add a new kraken (will display kraken creation form)
$router->map('GET', '/kraken/new', array('c' => 'KrakenController', 'a' => 'new'));
// user is trying to create a new kraken
$router->map('POST', '/kraken/create', array('c' => 'KrakenController', 'a' => 'create'));

// user wants to see info about a kraken
$router->addMatchTypes(array('krakenId' => '[0-9]{1,5}'));
$router->map('GET', '/kraken/[i:krakenId]', array('c' => 'KrakenController', 'a' => 'infos'));

//user wants to create a tentacle
$router->map('POST', '/tentacle', array('c' => 'TentacleController', 'a' => 'create'));
// user wants to remove a tentacle
$router->map('POST', '/tentacle/delete', array('c' => 'TentacleController', 'a' => 'delete'));

// user wants to add a power
$router->map('POST', '/power/add', array('c' => 'PowerController', 'a' => 'add'));

// user wants to remove a power to the kraken
$router->map('POST', '/power/remove', array('c' => 'PowerController', 'a' => 'remove'));



$match = $router->match();

// get wanted controller
$controller = 'App\\Controller\\' . $match['target']['c'];

// get method for this route
$action = $match['target']['a'];

// will instanciate the object according to url
$object = new $controller();

// call the method
count($match['params']) === 0 ? $print = $object->{$action}() : $print= $object->{$action}($match['params']);

echo $print;