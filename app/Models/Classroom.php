<?php
namespace App\Models;
use Woski\ORM\WoskiModel; 

class Classroom extends WoskiModel {

    public $table = "classrooms";

    public $pk = "id";

    public $fields = ["id", "name",  "streamId", "createdBy", "type", "about", "inSession", "createdAt", "updatedAt"];

 
}