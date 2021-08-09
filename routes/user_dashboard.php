<?php
$router = new Woski\Http\Router;

//Controllers
$pageController = new App\Controllers\Pages\UserDashboard;
$apiController = new App\Controllers\API\User;

//Middlewares
$authMW = new App\Middlewares\Auth;
$authMW->role = "user";


/* Views below */
$router->get("/",[$authMW->isLoggedInView, $pageController->index]);

$router->get("/transactions",[$authMW->isLoggedInView, $pageController->transactions]);

$router->get("/products",[$authMW->isLoggedInView, $pageController->products]);

$router->get("/active-chats",[$authMW->isLoggedInView, $pageController->activeChats]);

$router->get("/chat/:txn_id",[$authMW->isLoggedInView, $pageController->chatPage]);

$router->get("/gift-cards",[$authMW->isLoggedInView, $pageController->giftCards]);

$router->get("/gift-cards/:id",[$authMW->isLoggedInView, $pageController->giftCardPage]);


$router->get("/crypto/:abbr",[$authMW->isLoggedInView, $pageController->cryptoPage]);

$router->get("/settings",[$authMW->isLoggedInView, $pageController->settings]);

$router->get("/i",[$authMW->isLoggedInView, function ($req, $res){
	echo "User dashboard";
}]);


/* API below */
//Order API
$router->post("/api/order/alt-card/:id",[$authMW->apiUser, $apiController->sellAltCard]);
$router->post("/api/order/alt-card/acs/:id",[$authMW->apiUser, $apiController->sellAltCardACS]);
$router->post("/api/order/itunes/:id",[$authMW->apiUser, $apiController->sellItunesCard]);
$router->post("/api/order/crypto/:abbr",[$authMW->apiUser, $apiController->sellCrypto]);



//Settings 
$router->post("/api/settings/profile/update",[$authMW->apiUser, $apiController->updateProfile]);
$router->post("/api/settings/password/update",[$authMW->apiUser, $apiController->updatePassword]);
$router->post("/api/settings/bank/save",[$authMW->apiUser, $apiController->saveBankDetails]);
$router->post("/api/settings/email/init-verify",[$authMW->apiUser, $apiController->initEmailVerification]);
$router->post("/api/settings/email/verify",[$authMW->apiUser, $apiController->verifyEmail]);
$router->post("/api/settings/phone/init-verify",[$authMW->apiUser, $apiController->initPhoneVerification]);
$router->post("/api/settings/phone/verify",[$authMW->apiUser, $apiController->verifyPhone]);

//Misc
$router->post("/api/bank/resolve",[$authMW->apiUser, $apiController->resolveBankDetails]);

//Notification
$router->post("/api/notification/handlers/txn",[$authMW->apiUser, $apiController->notifyAgentsAndAdminsOfTxn]);

$router->post("/i",[function ($req, $res){
	
}]);


return $router;
