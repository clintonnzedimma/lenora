<?php
namespace App\Models\Chat;
use Woski\ORM\WoskiModel; 

class Message extends WoskiModel {

    public $table = "chat_messages";

    public $pk = "id";

    public $fields = ["id", "body", "userKey", "roomKey", "is_hidden", "monicker", "createdAt", "updatedAt"];
 
}