<?php
namespace App\Models\Chat;
use Woski\ORM\WoskiModel; 

class Room extends WoskiModel {

    public $table = "chat_rooms";

    public $pk = "id";

    public $fields = ["id", "rKey", "maxNum", "createdBy","createdAt", "updatedAt"];
 
}