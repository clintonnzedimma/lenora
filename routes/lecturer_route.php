<?php
$router = new Woski\Http\Router;

//Controllers
$pageController = new App\Controllers\Pages\LecturerDashboard;
// $apiController = new App\Controllers\API\LecturerApi;

//Middlewares
$authMW = new App\Middlewares\Auth;
$authMW->isLecturerRoute = true;


/* Views below */
$router->get("/",[$authMW->isLoggedInView, $pageController->index]);
$router->get("/start-class",[$authMW->isLoggedInView, $pageController->index]);
$router->any("/create-assignment",[$authMW->isLoggedInView, $pageController->createAssignmentPage]);
$router->any("/assignment/:keyCode",[$authMW->isLoggedInView, $pageController->assignmentPage]);
$router->any("/assignment/submissions/:id",[$authMW->isLoggedInView, $pageController->studentAssignment]);
$router->any("/all-assignments",[$authMW->isLoggedInView, $pageController->assignmentList]);
$router->any("/start-class",[$authMW->isLoggedInView, $pageController->startClassPage]);
$router->any("/class/:id",[$authMW->isLoggedInView, $pageController->classPage]);
$router->any("/classrooms",[$authMW->isLoggedInView, $pageController->classList]);
$router->any("/publish-note",[$authMW->isLoggedInView, $pageController->createNotePage]);
$router->any("/note/:code",[$authMW->isLoggedInView, $pageController->notePage]);

return $router;
