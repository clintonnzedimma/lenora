<?php
namespace App\Models;
use Woski\ORM\WoskiModel; 

class User extends WoskiModel {

    public $table = "users";

    public $pk = "id";

    public $fields = ["id", "username", "full_name","password", "type", "chatKey", "createdAt", "updatedAt"];

 
}