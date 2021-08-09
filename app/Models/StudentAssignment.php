<?php
namespace App\Models;
use Woski\ORM\WoskiModel; 

class StudentAssignment extends WoskiModel {

    public $table = "student_assignments";

    public $pk = "id";

    public $fields = ["id", "userId", "keyCode",  "body", "grade", "remark","createdBy",  "status", "createdAt", "updatedAt"];

 
}