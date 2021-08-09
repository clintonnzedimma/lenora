<?php
namespace App\Models\Chat;
use Woski\ORM\WoskiModel; 

class RoomUser extends WoskiModel {

    public $table = "chat_room_users";

    public $pk = "id";

    public $fields = ["id", "userKey", "roomKey", "createdAt", "updatedAt"];
 
}