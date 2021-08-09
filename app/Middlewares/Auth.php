<?php  
/**
 * Authentication Middleware
 */
namespace App\Middlewares;
use Woski\Controller\WoskiController;
use \App\Controllers\BaseController;
class Auth extends BaseController
{

    public $isLecturerRoute;
    public $isStudentRoute;
    public $isLiveStreamRoute;

    public function isLoggedInView() {
		return function ($req, $res, $pipe) {
            if (!$this->authUser) {
                header("Location:/login");
                return $pipe->block();
            }

            if($this->authUser['type'] === 'student' && $this->isLecturerRoute) {
                header("Location:/student-dashboard");
                return $pipe->block();
            }

            if($this->authUser['type'] === 'lecturer' && $this->isStudentRoute) {
                header("Location:/lecturer-dashboard");
                return $pipe->block();
            }

		};
	}


    
    public function apiUser() {
        return function ($req, $res, $pipe) {
            if (!$this->authUser) {
                $res->json(["message" => "User not authenticated", "status" => false]);
                return $pipe->block();
            }
        };
    }  

 

    public function apiLecturer() {
        return function ($req, $res, $pipe) {
            if(!isset($_SESSION['user']) || ($this->authUser && $this->authUser['type'] != 'lecturer' )){
                $res->json(["message" => "Not authorized", "status" => false]);
                return $pipe->block();
            }
        };
    }  
    

    public function signOut(){
        return function ($req, $res, $pipe){
            session_destroy();
            header("Location:/login"); 
            return $pipe->block();  
        };
    }


    public function isLoggedInStream() {
        return function ($req, $res, $pipe) {
            if (!$this->authUser) {
                return $res->render("livestream/error_page",[
                    "error" => "Not Authenticated"
                ]);
            }
        };
    }      

    public function autoLogin() {
		return function ($req, $res, $pipe) { 
            
            // customer
			if($this->authUser && $this->authUser['type'] == 'student'){
               header("Location:/student-dashboard");
               return $pipe->block();
            }

            // user
			if($this->authUser && $this->authUser['type'] == 'lecturer'){
                header("Location:/lecturer-dashboard");
                return $pipe->block();
            }

            
		};
	}

    


}

