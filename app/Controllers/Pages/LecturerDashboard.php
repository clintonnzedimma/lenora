<?php  
/**
 ** @author Clinton Nzedimma
 * Lecturer Dashboard API 
 */
namespace App\Controllers\Pages;
use App\Controllers\BaseController;
use App\Services\Beamify;

class LecturerDashboard extends BaseController
{   
	public function index() {
		return function ($req, $res) {
		   	 $res->render("lecturer/index");			
		};
	}
	
	public function createAssignmentPage() {
		return function ($req, $res) {
			$errors = [];
			if(isset($_POST['submit'])) {
				$title = $this->Input->sanitize($_POST['title']);
				$body = $_POST['body'];
				$expiresOn = date("Y-m-d H:i:s", strtotime($_POST["expiresOn"]));

				// errors
				if(strlen($title) == 0) {
					$errors[] = "Title cannot be empty";
				}  
				if(strlen($body) == 0) {
					$errors[] = "Questions cannot be empty";
				}  

				$keyCode = "HW-".strtoupper($this->Input->rand_str(4));

				//if no errors
				if (empty($errors)) { 
					//create assignment
					$this->Assignment->create([
						"title" => $title,
						"body" => $body,
						"keyCode" => $keyCode,
						"createdBy" => $this->authUser['id'],
						"createdAt" => date('Y-m-d H:i:s')
					]);

					// redirect
					header("Location:/lecturer-dashboard/assignment/$keyCode");
					exit;
				}
			}

		   	 $res->render("lecturer/create_assignment",[
				"error" => (!empty($errors)) ? $errors[0] : null
			]);			
		};
	}
	
	public function assignmentPage() {
        return function ($req, $res) {
			$keyCode = $this->Input->sanitize($req->params->keyCode);

			$assignment = $this->Assignment->findOneWhere([
				"keyCode" => $keyCode,
				"createdBy" => $this->authUser['id']
			]);

			$assignmentExists = $assignment || false;

			if(!$assignmentExists){
				header("Location:/404");
				exit;
			}

			$student_assignments = $this->StudentAssignment->findAllWhere([
				"keyCode" => $keyCode,
				"status" => "draft"
			]);


			return $res->render("lecturer/assignment_page",[
				"assignment" => $assignment,
				"student_assignments" => $student_assignments
			]);	
        };
	}	
	

	public function assignmentList() {
		return function ($req, $res) {

			$assignments = $this->Assignment->findAllWhere([
				"createdBy" => $this->authUser['id'] 
			]);

		   	return $res->render("lecturer/assignment_list", [
				"assignments" => $assignments
			]);			
		};
	}


	public function startClassPage() {
		return function ($req, $res) {
			$errors = [];
			if(isset($_POST['submit'])) {
				$name = $this->Input->sanitize($_POST['name']);
				$message = $this->Input->sanitize($_POST['wlcm_msg']);

				// var_dump($expiresOn);

				// errors
				if(strlen($name) == 0) {
					$errors[] = "Name cannot be empty";
				}  

				$id = "LH".$this->Input->rand_str(3);

				//if no errors
				if (empty($errors)) { 
					// create class
					$this->Classroom->create([
						"id" => $id,
						"name" => $name,
						"type" => "video",
						"createdBy" => $this->authUser['id'],
						"createdAt" => date('Y-m-d H:i:s')
					]);

					$beamify = new Beamify;
					$beamify->createRoom([
						"uKey" => $this->authUser['chatKey'],
						"rKey" =>  $id
					]);

					if(strlen($message) > 0) {
						// Creating message on Beam server
						$beamify->sendMessage([
							"uKey" => $this->authUser['chatKey'],
							"rKey" => $id,
							"monicker" => $this->authUser['full_name'],
							"message" => $message 
						]);
					}


					// redirect
					header("Location:/lecturer-dashboard/class/$id");
					exit;
				}
			}

		   	 $res->render("lecturer/create_class",[
				"error" => (!empty($errors)) ? $errors[0] : null
			]);			
		};
	}

	public function classPage() {
        return function ($req, $res) {
			$id = $this->Input->sanitize($req->params->id);
			$beamify_url = $_ENV['BEAMIFY_URL'];

			$classroom = $this->Classroom->findOneWhere([
				"id" => $id
			]);
			
		   	return $res->render("lecturer/class_page", [
				"classroom" => $classroom,
				"beamify_url" => $beamify_url,
				"uKey" => $this->authUser['chatKey'],
				"rKey" => $classroom['id']
 			]);		
        };
	}	

	public function classList() {
		return function ($req, $res) {

			$classrooms = $this->Classroom->findAllWhere([
				"createdBy" => $this->authUser['id'] 
			]);

		   	return $res->render("lecturer/class_list", [
				"classrooms" => $classrooms
			]);			
		};
	}
	

	public function createNotePage() {
		return function ($req, $res) {
			$errors = [];
			if(isset($_POST['submit'])) {
				$title = $this->Input->sanitize($_POST['title']);
				$body = $_POST['body'];

				if(strlen($title) == 0) {
					$errors[] = "Title cannot be empty";
				}  
				if(strlen($body) == 0) {
					$errors[] = "Body cannot be empty";
				}  

				$keyCode = "note-".strtoupper($this->Input->rand_str(4));

				//if no errors
				if (empty($errors)) { 
					//create assignment
					$this->Note->update([
						"title" => $title,
						"body" => $body,
						"keyCode" => $keyCode,
						"updatedAt" => date('Y-m-d H:i:s')
					]);

					// redirect
					header("Location:/lecturer-dashboard/note/$keyCode");
					exit;
				}
			}

		   	 $res->render("lecturer/create_note",[
				"error" => (!empty($errors)) ? $errors[0] : null
			]);			
		};
	}


	public function notePage() {
        return function ($req, $res) {
			$errors = [];
			$keyCode = $this->Input->sanitize($req->params->code);


			$note = $this->Note->findOneWhere([
				"keyCode" => $keyCode
			]);

			$noteExists = $note || false;

            if (isset($_POST['submit'])) {
				$title = $this->Input->sanitize($_POST['title']);
				$body = $_POST['body'];

				if(strlen($title) == 0) {
					$errors[] = "Title cannot be empty";
				}  
				if(strlen($body) == 0) {
					$errors[] = "Body cannot be empty";
				}  


				//if no errors
				if (empty($errors)) { 
					$this->Note->update([
						"title" => $title,
						"body" => $body,
						"keyCode" => $keyCode,
						"updatedAt" => date('Y-m-d H:i:s')
					],[
						"WHERE" => [
							"keyCode" =>  $keyCode
						]
					]);
				}


	

            }



			if(!$noteExists){
				header("Location:/404");
				exit;
			}


			return $res->render("lecturer/note_page",[
				"note" => $note
			]);	
        };
	}	
	
	

	public function studentAssignment() {
		return function ($req, $res) {
			$errors = [];

			$id = $this->Input->sanitize($req->params->id);

			$student_assignment = $this->StudentAssignment->findOneWhere([
                "id" => $id
			]);

			$student_assignment_exists  = $student_assignment || false;
			
			$assignment = $this->Assignment->findOneWhere([
				"keyCode" => $student_assignment['keyCode']
			]);
			$assignmentExists = $assignment || false;

			if(!$student_assignment_exists || !$assignmentExists) {
				header("Location:/404");
				exit;
			}


			if(isset($_POST['submit'])) {
				$remark = $this->Input->sanitize($_POST['remark']);
				$grade = $this->Input->sanitize($_POST['grade']);

				if(empty($errors)){
					$update = $this->StudentAssignment->update([
						"remark" => $remark,
						"grade" => $grade
                    ], [
                        "WHERE" => [
                            "id" => $id
                        ]
                    ]);
				}
			}

		   	return $res->render("lecturer/student_assignment",[
					"student_assignment" => $student_assignment,
					"assignment" => $assignment
			]);			
		};
	}
	
	
 
}

?>