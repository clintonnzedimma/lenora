<?php  
/**
 * A sample Controller class
 */
namespace App\Controllers;
use Woski\Controller\WoskiController;

class AppController extends BaseController
{
	

	public function index() {
		return function ($req, $res) {
		   	 $res->render("landing/index");			
		};
	}


}

?>