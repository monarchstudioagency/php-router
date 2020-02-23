<?php

//Init Max Session to 1h
ini_set('session.gc_maxlifetime', 3600);

//If you want to use composer, uncomment
require_once 'vendor/autoload.php';
require_once 'config.php';

use App\Router\Router;

$router = new Router($_GET['url']);

//****Define routes here with verbs : GET, POST, PUT, DELETE****

//***Examples routes***
//Call controllers in 'src/Controller' with 'Controller#method' schema.
$router->get('/', 'Example#show');
$router->get('/twig', 'Example#showTwig');

//Other verbs
$router->post('/route-to-post', function(){ echo "Something to show"; });
$router->put('/route-to-put', function(){ echo "Something to show"; });
$router->delete('/route-to-delete', function(){echo "Something to show"; });

//Dynamic values
$router->get('/dynamic/:id', function($id){ echo "This is my " . $id; });
$router->get('/dynamic/:id/:slug', function($id, $slug){ echo "This is my " . $id . " and the " . $slug; });

//Run the router !
$router->run();