<?php
namespace App\Models\Chat;
use Woski\ORM\WoskiModel; 

class Attachment extends WoskiModel {

    public $table = "chat_attachments";

    public $pk = "id";

    public $fields = ["id", "name", "aKey", "userKey", "roomKey", "file_type","createdAt", "updatedAt"];
 
}