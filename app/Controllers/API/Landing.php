<?php  
/**
 * Landing API 
 */
namespace App\Controllers\API;
use App\Controllers\BaseController;
use App\Services\Beamify;
use App\Services\VideoAPI;

class Landing extends BaseController
{

    // poking
    public function poke() {
		return function ($req, $res) {
            $this->User->create([
                "id" => 'stu_'.$this->Input->rand_str(4),
                "username" => "jaja",
                "full_name" => "Michael Jaja",
                "password" => password_hash("12345", PASSWORD_DEFAULT),
                "chatKey" => "x".$this->Input->rand_str(6),
                "type" => "student",
                "createdAt" => date('Y-m-d H:i:s')
            ]);
		};
    }



	public function registerUser() {
		return function ($req, $res) {
            $errors = [];
            $action_status = false;
            $req_fields = ['username','email', 'phone', 'password', 'password_again'];

            $username = $this->Input->sanitize($_POST['username']); 
            $email = $this->Input->sanitize($_POST['email']);
            $phone = $this->Input->sanitize($_POST['phone']);
            $password = $this->Input->sanitize($_POST['password']);
            $password_again =$this->Input->sanitize($_POST['password_again']);

            $usernameExists = $this->User->findOneWhere([
				"username" => $username	
            ]) || false;

            $emailExists = $this->User->findOneWhere([
				"email" => $email	
            ]) || false;
            
            $phoneExists = $this->User->findOneWhere([
				"phone" => $phone	
			]) || false;
            

            //errors
            if (!$this->Input->mandatory_fields($req_fields)) {
                $errors[] = 'Fill all required fields';
            }
            if (strlen($username) < 3) {
                $errors[] = "Your username should not be less than 3 characters ! ";
            }
            if ($this->Input->is_invalid_username($username)) {
                $errors[] = "Username should not contain space or special characters !";
            }	
            if (strlen($phone) < 11 && $this->Input->is_phone_number($phone)) {
                $errors[] = 'Your phone number should be 11 or more digits';
            }
            if (!$this->Input->is_phone_number($phone)) {
                $errors[] =  'Invalid phone number';
            }
            if (strlen($phone) >= 11 && !$this->Input->is_phone_number($phone)) {
                $errors[] =  'Invalid phone number';
            }
            if(!$this->Input->is_email($email)){
                $errors[] = "Invalid email";
            }
            if(strlen($password) < 7) {
                $errors[] = "Your password should be 7 or more characters";
            }
            if ($password !== $password_again) {
                $errors[] = "Your passwords do not match";
            }
            if ($usernameExists) {
                $errors[] = "This username '$username' is already taken";
            }
            if ($emailExists) {
                $errors[] = "This email is already registered";
            }
            if ($phoneExists) {
                $errors[] = "This phone number is already registered";
            }
    
    
            // signing up if no errors
            if (empty($errors)) {
                $user_id =$this->Input->rand_str(3).'-'.$this->Input->rand_str(6);

                $chat_key = "lyon_".$this->Input->rand_str(9);

                $create_user = $this->User->create(  
                    [
                        "id" => $user_id ,
                        "username" => $username,
                        "email" => $email,
                        "phone" => $phone,
                        "password" => password_hash($password, PASSWORD_DEFAULT), 
                        "chatKey" => $chat_key,
                        "createdAt" => date('Y-m-d H:i:s')
                    ]
                );

                if ($create_user) {
                    $action_status = true;

                    $_SESSION['user'] = [
                        "id" => $user_id,
                        "email" => $email,
                        "username" => $username,
                        "chatKey" => $chat_key
                    ];
                }    
            }
    
    
            $res ->json(
                    [
                        "status" => $action_status,
                        "message" => (!empty($errors)) ?  $errors[0] : "Signed up successfully"
                    ] 
            );
    
		};
	}

	public function loginUser() {
		return function ($req, $res) {
            $errors = [];
            $action_status = false;
            $login = $this->Input->sanitize($_POST['login']);
            $password = $this->Input->sanitize($_POST['password']);

            $login_field_key = "email";

            if($this->Input->is_email($login)) $login_field_key = "email";      

            if (!$this->Input->is_invalid_username($login)) $login_field_key = "username";	

            $userExists = $this->User->findOneWhere([
				$login_field_key => $login	
            ]) || false;

            $userData = $this->User->findOneWhere([
				$login_field_key => $login	
            ]);
            
            // errors
            if(!$userExists) {
                $errors[] = "Invalid email/username";
            }    
            if($userExists && !password_verify($password, $userData['password'])){
                $errors[] = "Wrong password";
            }

            // if no errors
            if (empty($errors)) {
                $action_status = true;

                $_SESSION['user'] = [
                    "id" => $userData['id'],
                    "email" => $userData['email'],
                    "username" => $userData['username'],
                    "chatKey" => $userData['chatKey']
                ];
            }
    
            $res ->json(
                [
                    "status" => $action_status,
                    "message" => (!empty($errors)) ?  $errors[0] : "Login successful",
                    "level" => ($userData) ? intval($userData['level']) : null,
                    "req_uri" => (isset($_SESSION['protected_uri'])) ? $_SESSION['protected_uri']: false 
                ] 
            );


		};
	}
}

?>