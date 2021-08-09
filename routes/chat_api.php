<?php

$router = new Woski\Http\Router;

$controller = new App\Controllers\API\ChatAPIController;

$router->get("/",function ($req, $res){
	echo "Chat API index";
});


$router->post("/all-messages/:roomKey", $controller->loadMessages);
$router->post("/new-messages/:roomKey", $controller->loadNewMessage);
$router->post("/create-room", $controller->createRoom);
$router->post("/join-room", $controller->joinChat);
$router->post("/send-message", $controller->sendMessage);
$router->post("/send-image", $controller->sendMessageWithImage);




return $router;
