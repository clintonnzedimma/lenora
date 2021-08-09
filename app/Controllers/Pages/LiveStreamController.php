<?php  
/**
 * Landing
 */
namespace App\Controllers\Pages;
use App\Controllers\BaseController;
// use App\Services\Beamify;

class LiveStreamController extends BaseController
{   

	

	public function test() {
		return function ($req, $res) {
	
           	return $res->render("test", [
				
			   ]);
		};
    }


    public function broadcastPage() {
		return function ($req, $res) {
            $errors = [];
            try {
                $id = $this->Input->sanitize($req->params->id);
                $userId = $this->Input->sanitize($this->authUser['id']);
    
                $classroom = $this->Classroom->findOneWhere([
                    "id" => $id,
                    "createdBy" => $userId
                ]);
                
             $classroomExists = $classroom || false;

             if(!$classroomExists){
                 $errors[] = "Invalid classroom";
             }
                
            } catch (\Throwable $th) {
                //throw $th;
                $errors[] = $th->getMessage();
            }

            if(!empty($errors)) {
                return $res->render("livestream/error_page", [
                    "error" => $errors[0],
                 ]);
            }
			
		   	return $res->render("livestream/broadcast_page", [
                "classroom" => $classroom,
                "ag_id" => $_ENV['AGORA_APP_ID']
             ]);		
		};
    }



    public function audiencePage() {
		return function ($req, $res) {
            $errors = [];
            try {
                $id = $this->Input->sanitize($req->params->id);
    
                $classroom = $this->Classroom->findOneWhere([
                    "id" => $id
                ]);
                
             $classroomExists = $classroom || false;

             if(!$classroomExists){
                 $errors[] = "Invalid classroom";
             }
                
            } catch (\Throwable $th) {
                //throw $th;
                $errors[] = $th->getMessage();
            }

            if(!empty($errors)) {
                return $res->render("livestream/error_page", [
                    "error" => $errors[0],
                 ]);
            }
			
		   	return $res->render("livestream/audience_page", [
                "classroom" => $classroom,
                "ag_id" => $_ENV['AGORA_APP_ID']
             ]);		
		};
    }
 
}

?>