<?php  
/**
 * Lecturer Dashboard API 
 */
namespace App\Controllers\Pages;
use App\Controllers\BaseController;
use App\Services\Beamify;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;


class StudentDashboard extends BaseController
{   

	
	
	// public function assignmentPage() {
    //     return function ($req, $res) {
	// 		$keyCode = $this->Input->sanitize($req->params->keyCode);

	// 		$assignment = $this->Assignment->findOneWhere([
	// 			"keyCode" => $keyCode 
	// 		]);

	// 		$assignmentExists = $assignment || false;

	// 		if(!$assignmentExists){
	// 			header("Location:/404");
	// 			exit;
	// 		}

	// 		return $res->render("lecturer/assignment_page",[
	// 			"assignment" => $assignment
	// 		]);	
    //     };
	// }	
	

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
    

    /* FOCUS */

    public function index() {
		return function ($req, $res) {
		   	 $res->render("student/index");			
		};
    }
    
    public function joinClass() {
        return function ($req, $res) {
            $errors =[];

            if(isset($_POST['submit'])) {
                $id =  $this->Input->sanitize($_POST['id']);

                $class_room = $this->Classroom->findOneWhere([
                    "id" => $id 
                ]);
    
                $classroomExists = $class_room || false;
    
                if(!$classroomExists){
                  $errors[] = "Invalid code";
                }

                if(empty($errors)) {
                    header("Location:/student-dashboard/class/$id");
                    exit;
                }

            }
			return $res->render("student/join_class",[
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
			
		   	return $res->render("student/class_page", [
				"classroom" => $classroom,
				"beamify_url" => $beamify_url,
				"uKey" => $this->authUser['chatKey'],
				"rKey" => $classroom['id']
 			]);		
        };
	}	


	public function enterAssignment() {
        return function ($req, $res) {
            $errors =[];

            if(isset($_POST['submit'])) {
                $keyCode =  $this->Input->sanitize($_POST['keyCode']);

                $assignment = $this->Assignment->findOneWhere([
                    "keyCode" => $keyCode 
                ]);
    
                $assignmentExists = $assignment || false;
    
                if(!$assignmentExists){
                  $errors[] = "Invalid code";
                }

                if(empty($errors)) {
                    header("Location:/student-dashboard/assignment/$keyCode");
                    exit;
                }

            }
			return $res->render("student/assignment_form",[
                "error" => (!empty($errors)) ? $errors[0] : null
            ]);	
        };
	}	

    
    
    public function assignmentPage() {
        return function ($req, $res) {
			$keyCode = $this->Input->sanitize($req->params->keyCode);

			$assignment = $this->Assignment->findOneWhere([
				"keyCode" => $keyCode 
			]);

            $assignmentExists = $assignment || false;
            
            $student_assignment = [];
            $studentHasAssignment = false;
            $studentHasSubmitted = false;

			if(!$assignmentExists){
				header("Location:/404");
				exit;
            }

            $student_assignment = $this->StudentAssignment->findOneWhere([
                "keyCode" => $keyCode,
                "createdBy" => $this->authUser['id'] 
            ]);

            $studentHasAssignment = $student_assignment || false;
            if($studentHasAssignment && $student_assignment['status'] == 'final') $studentHasSubmitted = true; 
            
            if(isset($_POST['submit'])) {
                $body = $_POST['body'];

                
                if($_POST['submit'] == "draft")  $assignment_status = "draft";
                if($_POST['submit'] == "final")  $assignment_status = "final";
                
                if($studentHasAssignment){
                    // update
                    $update = $this->StudentAssignment->update([
                        "body" => $body,
                        "status" => $assignment_status,
                        "studentName" => $this->authUser['full_name'],
                        "updatedAt" => date('Y-m-d H:i:s')
                    ], [
                        "WHERE" => [
                            "keyCode" => $keyCode,
                            "createdBy" => $this->authUser['id']
                        ]
                    ]);
                } else {
                    $created = $this->StudentAssignment->create([
                        "body" => $body,
                        "keyCode" => $keyCode,
                        "status" => $assignment_status,
                        "studentName" => $this->authUser['full_name'],
                        "createdBy" => $this->authUser['id'],
                        "createdAt" => date('Y-m-d H:i:s')
                    ]);
                }
                
            }


			return $res->render("student/assignment_page",[
                "assignment" => $assignment,
                "student_assignment" => $student_assignment,
                "studentHasAssignment" => $studentHasAssignment,
                "studentHasSubmitted" => $studentHasSubmitted,
                "error" => (!empty($errors)) ? $errors[0] : null
			]);	
        };
    }	
    
    public function myAssignmentList() {
		return function ($req, $res) {

			$student_assignments = $this->StudentAssignment->findAllWhere([
				"createdBy" => $this->authUser['id'] 
			]);

		   	return $res->render("student/my_assignment_list", [
				"student_assignments" => $student_assignments
			]);			
		};
	}
	
 
}

?>