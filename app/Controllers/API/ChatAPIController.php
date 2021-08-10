<?php  
/**
 * Chat API contoller
 */
namespace App\Controllers\API;
use Woski\Controller\WoskiController;
use Woski\Database\Database;
use PDO;

class ChatAPIController extends WoskiController
{


	function __construct() {
        parent::__construct();

        $DB = new Database;

        $this->DB = $DB->connect();

        $this->Input = new \App\Helpers\Input;

        $this->User = new \App\Models\User($this->DB);
        $this->Message = new \App\Models\Chat\Message($this->DB);
        $this->Room = new \App\Models\Chat\Room($this->DB);
        $this->RoomUser = new \App\Models\Chat\RoomUser($this->DB);
        $this->Attachment = new \App\Models\Chat\Attachment($this->DB);
    }




	public function createRoom() {
		return function ($req, $res) { 
			$errors = [];
			$uKey = (isset($_POST['uKey'])) ? $_POST['uKey'] : false;
			$rKey = (isset($_POST['rKey'])) ? $_POST['rKey'] : false;
			$maxNum = (isset($_POST['maxNum'])) ? intval($_POST['maxNum']) : 2;
	
			$check_users = $this->User->findAllWhere([
				"chatKey" => $uKey	
			]);

			$check_rooms = $this->Room->findAllWhere([
				"rKey" => $rKey	
			]);


			// errors
			if(!$rKey) {
				$errors[] = "rKey is needed";
			}
			if(!$uKey) {
				$errors[] = "uKey is needed";
			}
			if(!ctype_alpha($rKey[0])){
				$errors[] = "The first character of rKey must be an alphabet";
			}				
			if(count($check_users) == 0) {
				$errors[] = "uKey ($uKey) does not exist on your beamtube";
			}
			if(count($check_rooms) > 0) {
				$errors[] = "rKey ($rKey) already exists on your beamtube";
			}
			if(strlen($rKey) < 4){
				$errors[] = "rKey should be 4 or more characters";
			}
			if(!is_int($maxNum)) {
				$errors[] = "maxNum should be an integer";
			}
			if(is_int($maxNum) && $maxNum < 2) {
				$errors[] = "maxNum should not be less than 2";
			}

			// creating room if no errors
			$is_created = false;
			if(empty($errors)){
				$create_room = $this->Room->create([
					"rKey" => $this->Input->sanitize($rKey),
					"maxNum" => $this->Input->sanitize($maxNum),
					"createdBy" => $this->Input->sanitize($uKey),
					"createdAt" =>  date('Y-m-d H:i:s')
				]);

				$join_room = $this->RoomUser->create([
					"userKey" => $uKey,
					"roomKey" => $rKey,
					"createdAt" =>  date('Y-m-d H:i:s')
				]);

				$is_created = true;

			}

			$res->json([
				"message" => ($is_created) ? "Room ($rKey) created " : $errors[0],
				"status" => ($is_created) ? true : false
			]);

		};
	}	





	public function joinChat() {
		return function ($req, $res) {
			$errors = [];
			$uKey = (isset($_POST['uKey'])) ? $_POST['uKey'] : false;
			$rKey = (isset($_POST['rKey'])) ? $_POST['rKey'] : false;

			$check_users = $this->User->findAllWhere([
				"chatKey" => $uKey	
			]);

			$check_rooms = $this->Room->findAllWhere([
				"rKey" => $rKey	
			]);

		
			// errors
			if(!$rKey) {
				$errors[] = "rKey is needed";
			}
			if(!$uKey) {
				$errors[] = "uKey is needed";
			}
			if(count($check_users) == 0) {
				$errors[] = "uKey ($uKey) does not exist on your beamtube";
			}
			if(count($check_rooms) == 0) {
				$errors[] = "rKey ($rKey) does not exist on your beamtube";
			}


			$is_created = false;
			if(empty($errors)){ 
				$join_room = $this->RoomUser->create([
					"userKey" => $this->Input->sanitize($uKey),
					"roomKey" => $this->Input->sanitize($rKey),
					"createdAt" =>  date('Y-m-d H:i:s')
				]);				
				$is_created = true;
			}

			$res->json([
				"message" => ($is_created) ? "uKey ($uKey) has joined room ($rKey) " : $errors[0],
				"status" =>  ($is_created) ? true : false
			]);

		};
	}






	public function sendMessage() {
		return function ($req, $res) {
			$errors = [];
			$uKey = (isset($_POST['uKey'])) ? $_POST['uKey'] : false;
			$rKey = (isset($_POST['rKey'])) ? $_POST['rKey'] : false;
			$message = (isset($_POST['message'])) ? $_POST['message'] : false;
			$monicker = (isset($_POST['monicker'])) ? $_POST['monicker'] : false;


			$check_users = $this->User->findAllWhere([
				"chatKey" => $uKey	
			]);

			$check_rooms = $this->Room->findAllWhere([
				"rKey" => $rKey	
			]);

			$user_exists_in_chat_room = $this->RoomUser->findAllWhere([
				"roomKey" => $rKey,
				"userKey" => $uKey
			]);


			if(count($check_users) == 0) {
				$errors[] = "uKey ($uKey) does not exist on your beamtube";
			}
			if(count($check_rooms) == 0) {
				$errors[] = "rKey ($rKey) does not exist on your beamtube";
			}

			if(strlen($message) == 0) {
				$errors[] = "Message cant be empty";
			}

			$is_created = false;
			if(empty($errors)){ 
				$send_msg = $this->Message->create([
					"userKey" => $this->Input->sanitize($uKey),
					"roomKey" => $this->Input->sanitize($rKey),
					"monicker" => $this->Input->sanitize($monicker),
					"body" => $this->Input->sanitize($message),
					"createdAt" =>  date('Y-m-d H:i:s')
				]);
				
				$is_created = true;
			}

			$res->json([
				"message" => ($is_created) ? "message sent " : $errors[0],
				"status" =>  ($is_created) ? true : false,
				"chat" => [
					"message" => $message
				]
			]);

			
		};
	}



	public function sendMessageWithImage() {
		return function ($req, $res) {
			$attachment_key = "bm_".dechex(rand(1e8, 9e8));
			$errors = [];
			$uKey = (isset($_POST['uKey'])) ? $_POST['uKey'] : false;
			$rKey = (isset($_POST['rKey'])) ? $_POST['rKey'] : false;
			$beamURL = (isset($_POST['beamURL'])) ? $_POST['beamURL'] : false;
			$monicker = (isset($_POST['beamURL'])) ? $_POST['monicker'] : false;
			


			$check_users = $this->User->findAllWhere([
				"chatKey" => $uKey	
			]);

			$check_rooms = $this->Room->findAllWhere([
				"rKey" => $rKey	
			]);

			$user_exists_in_chat_room = $this->RoomUser->findAllWhere([
				"roomKey" => $rKey,
				"userKey" => $uKey
			]);


			if(count($check_users) == 0) {
				$errors[] = "uKey ($uKey) does not exist on your beamtube";
			}
			if(count($check_rooms) == 0) {
				$errors[] = "rKey ($rKey) does not exist on your beamtube";
			}
			if(count($check_users) > 0 
				&& count($check_rooms) > 0
				&& count($user_exists_in_chat_room) == 0 ) {
				$errors[] = "uKey ($uKey) not authorized for rKey ($rKey)";
			}

			/* HANDLING FILE */
			// Getting POST value containing JSON data
			// $files = json_decode($_POST['files']);

			$new_files = [];


			$ChatHelper = new \App\Helpers\Chat;

			$ChatHelper->uploadMultipleImages();

			foreach ($ChatHelper->errors as $uploadError) {
				$errors[] = $uploadError;
			}
			$new_files = $ChatHelper->imgList;

			$is_created = false;
			$message = "";
			if(empty($errors)){ 
				foreach ($new_files as $nf) {
					$message .= "<p><img src='$beamURL/uploads/$nf'></p>";
					$save_attachment = $this->Attachment->create([
						"name" => $nf,
						"aKey" => $attachment_key,
						"userKey" => $this->Input->sanitize($uKey),
						"roomKey" => $this->Input->sanitize($rKey),
						"createdAt" =>date('Y-m-d H:i:s')
					]);
				}

				$send_msg = $this->Message->create([
					"userKey" => $this->Input->sanitize($uKey),
					"roomKey" => $this->Input->sanitize($rKey),
					"monicker" => $this->Input->sanitize($monicker),
					"body" => $message,
					"attachKey" => $attachment_key,
					"createdAt" =>  date('Y-m-d H:i:s')
				]);
				
				$is_created = true;
			}

			$res->json([
				"message" => ($is_created) ? "attachment message sent" : $errors[0],
				"status" =>  ($is_created) ? true : false,
				"chat" => [
					"message" => $message 
				]
			]);

			
		};
	}




	public function loadMessages() {
        return function ($req, $res) {
			$errors = [];
			$rKey = $req->params->roomKey;
			$uKey = (isset($_POST['uKey'])) ? $_POST['uKey'] : false;

			$chat_config = [];
			$masterUserKeys = [];
			$isMasterUserKey = false;

			try {
				$chat_config = _import("config/chat.php");
				$masterUserKeys = $chat_config['masterUserKeys'];
				$isMasterUserKey = in_array($uKey,$masterUserKeys );
			} catch (\Throwable $th) {
				//throw $th;
			}

			$messages = [];
			$is_auth = false;

		
				$is_auth = true;
				$chat_messages = $this->Message->findAllWhere([
					"roomKey" => $rKey,
					"is_hidden" => 0
				],[
					"ORDER_BY" => "id",
					"ASC" => true					
				]);

			foreach ($chat_messages as $msg) {
				if($msg['userKey'] == $uKey) {
					$msg['isSender'] = true;
				}else {
					$msg['isSender'] = false;
				}

				$userKey = $msg['userKey'];


				$msg['monicker'] = null;

				$msg['monicker'] = $this->User->findOneWhere([
					"chatKey" => $userKey
				])['username'];

				unset($msg['userKey']);
				$messages[] = $msg;
			}
			

		
			$res->json([
				"status" =>  ($is_auth) ? true : false,
				"is_auth" => ($is_auth), 
				"data" => $messages
			]);
        };
    }



	
	public function loadNewMessage() {
        return function ($req, $res) {
			$errors = [];
			$rKey = $req->params->roomKey;
			$uKey = (isset($_POST['uKey'])) ? $_POST['uKey'] : false;
	
			$user_exists_in_chat_room = $this->RoomUser->findAllWhere([
				"roomKey" => $rKey,
				"userKey" => $uKey
			]);

			$msg = [];
	
			$is_auth = false;

			
				$is_auth = true;
				$stmt = $this->DB->prepare("SELECT * FROM chat_messages WHERE  roomKey = :rKey  ORDER BY id DESC");
				$stmt->execute(array(':rKey' => $rKey));

				$msg = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];	

				if($msg) {
				 	$msg['isSender'] = false;
				 	if($msg['userKey'] == $uKey) {
				 		$msg['isSender'] = true;	
				 	} 
				 }

				 $msg['monicker'] = null;
				 $userKey = $msg['userKey'];

				 $msg['monicker'] = $this->User->findOneWhere([
					 "chatKey" => $userKey
				 ])['username'];

				 unset($msg['userKey']);
			

			
			$res->json([
				"status" =>  ($is_auth) ? true : false,
				"is_auth" => $is_auth,
				"data" => $msg
			]);
        };
    }

}
