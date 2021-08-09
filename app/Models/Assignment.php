<?php
namespace App\Models;
use Woski\ORM\WoskiModel; 

class Assignment extends WoskiModel {

    public $table = "assignments";

    public $pk = "id";

    public $fields = ["id", "title",  "body", "createdBy", "createdAt", "updatedAt"];

 
}