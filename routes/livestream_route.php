<?php
$router = new Woski\Http\Router;

//Controllers
$pageController = new App\Controllers\Pages\LiveStreamController;
// $apiController = new App\Controllers\API\LecturerApi;

//Middlewares
$authMW = new App\Middlewares\Auth;
$authMW->isStreamRoute = true;


/* Views below */
$router->get("/broadcast/:id",[$authMW->isLoggedInStream, $pageController->broadcastPage]);
$router->get("/audience/:id",[$authMW->isLoggedInStream, $pageController->audiencePage]);


return $router;
