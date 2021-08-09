<?php  
/**
 * Landing
 */
namespace App\Controllers\Pages;
use App\Controllers\BaseController;
// use App\Services\Beamify;

class Landing extends BaseController
{   
	public function index() {
		return function ($req, $res) {
            if(isset($_POST['submit'])) {
				$errors = [];
				$username = $this->Input->sanitize($_POST['username']);
				$password = $this->Input->sanitize($_POST['password']);
	
	
				$userExists = $this->User->findOneWhere([
					"username" => $username	
				]) || false;
	
				$userData = $this->User->findOneWhere([
					"username" => $username	
				]);
	
				// errors
				if(!$userExists) {
					$errors[] = "This user does not exist";
				}    
				if($userExists && !password_verify($password, $userData['password'])){
					$errors[] = "Wrong password";
				}
	
	
				// if no errors
				if (empty($errors)) {
					$_SESSION['user'] = [
						"id" => $userData['id'],
                        "username" => $userData['username']
					];

					if($userData['type'] == 'lecturer') {
						header("Location:/lecturer-dashboard");
						exit;
					}

					header("Location:/student-dashboard");
					exit;
				}
		
			}
		   	 $res->render("login",[
				"error" => (!empty($errors)) ? $errors[0] : null
			]);			
		};
	}
	

	public function test() {
		return function ($req, $res) {
			$tkn = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImN0eSI6InR3aWxpby1mcGE7dj0xIn0.eyJqdGkiOiJBQ2VjMzVmOWFlYTU4YmIwMmZlNTlhYzA5MjhmNjkxNGNmLTE2MjgyNDA3MDUiLCJpc3MiOiJBQ2VjMzVmOWFlYTU4YmIwMmZlNTlhYzA5MjhmNjkxNGNmIiwic3ViIjoiQUNlYzM1ZjlhZWE1OGJiMDJmZTU5YWMwOTI4ZjY5MTRjZiIsImV4cCI6MTYyODI0NDMwNSwiZ3JhbnRzIjp7ImlkZW50aXR5IjoiNjEwY2ZiNDFkZGU2MyIsInZpZGVvIjp7InJvb20iOiJhYmNkIn19fQ.YPoK_cZZ2JmtYKCN625mHm2_LvN7Rb-XN5n6lE-Apk4";
           	return $res->render("test", [
				   "tkn" => $tkn,
				   "room_name" => "abcd"
			   ]);
		};
    }
 
}

?>