<?php
namespace App\Models;
use Woski\ORM\WoskiModel; 

class Note extends WoskiModel {

    public $table = "notes";

    public $pk = "id";

    public $fields = ["id", "title",  "body", "createdBy", "createdAt", "updatedAt"];

 
}