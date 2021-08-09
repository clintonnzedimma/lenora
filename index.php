<?php

$_WOSKI_ENV = "development";
require 'woski_autoload.php';
require 'core/woski.php';


$app = new Woski\Application;
date_default_timezone_set("Africa/Lagos");

$authMW = new App\Middlewares\Auth;

$lecturerDashboardRoutes = _import("routes/lecturer_route.php");
$studentDashboardRoutes = _import("routes/student_route.php");
$liveStreamRoutes = _import("routes/livestream_route.php");
// $adminDashboardRoutes = _import("routes/admin_dashboard.php");
$chatAPIRoutes = _import("routes/chat_api.php");
$app->use("/api/chat", $chatAPIRoutes);
$app->use("/live-stream", $liveStreamRoutes);

$landingPagesController = new App\Controllers\Pages\Landing;


$landingApiController = new App\Controllers\API\Landing;

$app->any('/', $landingPagesController->index);
$app->any('/login', $landingPagesController->index);
$app->get("/logout", [$authMW->signOut]);


$app->post("/api/poke", [$landingApiController->poke]);

$app->use("/lecturer-dashboard", $lecturerDashboardRoutes);
$app->use("/student-dashboard", $studentDashboardRoutes);


$app->error("GET", function($req, $res){
	header('Page not found', true, 404);
	$res->render("404");
});


$app->start();
