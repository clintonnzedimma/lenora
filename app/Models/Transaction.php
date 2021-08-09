<?php
namespace App\Models;
use Woski\ORM\WoskiModel; 

class Transaction extends WoskiModel {

    public $table = "txns";

    public $pk = "id";

    public $fields = ["sn", "id", "type", "userId", "productName", "isCrypto", "isItunes", "isAltCard","agentChatKey", "status", "userChatKey", "hasBeam", "handlersNotified", "createdAt", "updatedAt"];


    protected $has = [
        "CryptoTxn" => ["sourceKey" => 'id', "foreignKey" => 'txnId'], 
        "ItunesTxn" => ["sourceKey" => 'id', "foreignKey" => 'txnId'], 
        "AltCardTxn" => ["sourceKey" => 'id', "foreignKey" => 'txnId']
    ];
 
 
}