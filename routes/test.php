<?php

$router = new Woski\Http\Router;

$router->get("/",function ($req, $res){
	echo "Hi Test";
});

$router->get("/d",function ($req, $res){
	echo "Hi Test----";
});




return $router;
