<?php 
/**
 * Woski - A PHP framework
 * @author Clinton Nzedimma <clinton@woski.xyz>
 *
 * @package Woski

 * This config file should contain global constants to pass to your views
 **/

 // DB
 $DB = new Woski\Database\Database;
 $DB = $DB->connect();


//Models 
$User = new App\Models\User($DB);


// User
$authUser = isset($_SESSION['user']) ? $User->findOneWhere(["id" => $_SESSION['user']['id']]) : null;


return [
	"app_name" => "Lenora",
	"authUser" =>  $authUser
];
	
