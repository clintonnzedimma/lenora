<?php  
/**
 * Beamify service class for Lenora
 */
namespace App\Services;
use App\Helpers\SausageHTTP;
use Woski\Database\Database;

class Beamify
{

    public $response;

    function __construct(){
        
        $DB = new Database;

        $this->DB = $DB->connect();
        $this->Input = new \App\Helpers\Input;

        $this->User = new \App\Models\User($this->DB);
        $this->Message = new \App\Models\Chat\Message($this->DB);
        $this->Room = new \App\Models\Chat\Room($this->DB);
        $this->RoomUser = new \App\Models\Chat\RoomUser($this->DB);
        $this->Attachment = new \App\Models\Chat\Attachment($this->DB);
    }



    public function createRoom($arg){

        $uKey = $arg['uKey'];
        $rKey = $arg['rKey'];

        $create_room = $this->Room->create([
            "rKey" => $this->Input->sanitize($rKey),
            "createdBy" => $this->Input->sanitize($uKey),
            "createdAt" =>  date('Y-m-d H:i:s')
        ]);

        $join_room = $this->RoomUser->create([
            "userKey" => $uKey,
            "roomKey" => $rKey,
            "createdAt" =>  date('Y-m-d H:i:s')
        ]);

        $is_created = ($create_room->result && $join_room->result);

        $this->response = $is_created;       
    }
    
    public function joinRoom($arg){
        $uKey = $arg['uKey'];
        $rKey = $arg['rKey'];

        $join_room = $this->RoomUser->create([
            "userKey" => $this->Input->sanitize($uKey),
            "roomKey" => $this->Input->sanitize($rKey),
            "createdAt" =>  date('Y-m-d H:i:s')
        ]);
        
        $is_joined = $join_room->result;

        $this->response = $is_joined;   
    }


    public function sendMessage($arg) {
        $uKey = $arg['uKey'];
        $rKey = $arg['rKey'];
        $message = $arg['message'];
        $monicker = ($arg['monicker']) ? $arg['monicker'] :null;

        $send_msg = $this->Message->create([
            "userKey" => $this->Input->sanitize($uKey),
            "roomKey" => $this->Input->sanitize($rKey),
            "body" => $this->Input->sanitize($message),
            "monicker" => $this->Input->sanitize($monicker),
            "createdAt" =>  date('Y-m-d H:i:s')
        ]);

        $this->response = $send_msg->result;
    }


    public function userIsInRoom($uKey, $rKey){
        return $this->RoomUser->findOneWhere([
            "userKey" => $this->Input->sanitize($uKey),
            "roomKey" => $this->Input->sanitize($rKey)
        ]) || false; 
    }


}
