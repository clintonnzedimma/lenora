<?php  
/**
 * The Base Controller
 */
namespace App\Controllers;
use Woski\Controller\WoskiController;
use Woski\Database\Database;


class BaseController extends WoskiController
{	
    
    function __construct() {
        parent::__construct();

        $DB = new Database;

        $this->DB = $DB->connect();
        
        // helpers    
        $this->Input = new \App\Helpers\Input();

        //Models
        $this->User = new \App\Models\User($this->DB);
        $this->Classroom = new \App\Models\Classroom($this->DB);
        $this->Assignment = new \App\Models\Assignment($this->DB);
        $this->StudentAssignment = new \App\Models\StudentAssignment($this->DB);
        $this->Note = new \App\Models\Note($this->DB);


        // Authenticated user
        $this->authUser = (isset($_SESSION['user'])) ? 
            $this->User->findOneWhere(["id" => $_SESSION['user']['id']])
        : null;
    }


}
?>