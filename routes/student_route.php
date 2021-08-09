<?php
$router = new Woski\Http\Router;

//Controllers
$pageController = new App\Controllers\Pages\StudentDashboard;
// $apiController = new App\Controllers\API\StudentApi;

//Middlewares
$authMW = new App\Middlewares\Auth;
$authMW->isStudentRoute = true;


/* Views below */
$router->get("/",[$authMW->isLoggedInView, $pageController->index]);
$router->any("/join-class",[$authMW->isLoggedInView, $pageController->joinClass]);
$router->any("/class/:id",[$authMW->isLoggedInView, $pageController->classPage]);
$router->any("/assignment",[$authMW->isLoggedInView, $pageController->enterAssignment]);
$router->any("/assignment/:keyCode",[$authMW->isLoggedInView, $pageController->assignmentPage]);
$router->any("/my-assignments",[$authMW->isLoggedInView, $pageController->myAssignmentList]);
// $router->any("/create-assignment",[$authMW->isLoggedInView, $pageController->createAssignmentPage]);
// $router->any("/assignment/:keyCode",[$authMW->isLoggedInView, $pageController->assignmentPage]);
// $router->any("/all-assignments",[$authMW->isLoggedInView, $pageController->assignmentList]);
// $router->any("/start-class",[$authMW->isLoggedInView, $pageController->startClassPage]);
// $router->any("/class/:id",[$authMW->isLoggedInView, $pageController->classPage]);
// $router->any("/classrooms",[$authMW->isLoggedInView, $pageController->classList]);
// $router->any("/publish-note",[$authMW->isLoggedInView, $pageController->createNotePage]);
// $router->any("/note/:code",[$authMW->isLoggedInView, $pageController->notePage]);


return $router;
