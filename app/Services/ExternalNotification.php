<?php  
/**
 * Notification for for LyonXchange
 */
namespace App\Services;
use App\Helpers\SausageHTTP;
use PHPMailer\PHPMailer\PHPMailer;
use Woski\Database\Database;

class ExternalNotification
{


    function __construct(){
        
 
    }



    /**
     * @param arg is an associative array that contains key parameters
     * @param arg[sender_email]
     *  @param arg[sender_name]
     *  @param arg[receiver_email]
     *  @param arg[receiver_name]
     *  @param arg[subject]
     *  @param arg[body]
    */
    public function sendEmail($arg){

        $sent = false;
        $mail =  new PHPMailer();

        try {
            //Server settings
            // $mail->SMTPDebug = 1;

            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = $_ENV['SMTP_MAIL_SERVER'] ;                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

            $mail->SMTPAutoTLS = true;
            $mail->SMTPSecure = true;    

            $mail->Username   = $arg['sender_email'];                     // SMTP username

            $mail->Password   = $_ENV['MAIL_PASSWORD'];                               // SMTP password

            $mail->Port       =  587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($arg['sender_email'], $arg['sender_name']);
            $mail->addAddress($arg['receiver_email'], $arg['receiver_name']);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $arg['subject'];

            $mail->Body    = $arg['body'];


            $mail->send();
            $sent = true;
        } catch (\Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return $sent;
    }




    /**
     * @param arg is an associative array that contains key parameters
     *  @param arg[body]
     *  @param arg[receiver]
     *  *  @param arg[sender]
    */
    public function sendSMS($arg){
        $body = $arg['body'];
        $receiver = $arg['receiver'];
        $sender = (isset($arg['sender']))? $arg['sender'] : "LyonXchange";

        $ebulksms = new \App\Helpers\EBulkSMS($_ENV['SMS_USERNAME'], $_ENV['SMS_API_KEY']);

        $result = $ebulksms->useJSON(
             $ebulksms->json_url, 
             $ebulksms->username, 
             $ebulksms->apikey, 
             0,
             $sender, 
             $body, 
             $receiver
        );	

        return $result;
    }
    
 
    
    /**
     * @param arg is a string
     * This method notifies the agents/admin by SMS when a new txn has been created
    */
    public function notifyOfNewTxnBySMS($arg, $txnID){
        $DB = new Database;
        $this->DB = $DB->connect();
        $this->User = new \App\Models\User($this->DB);
        $this->Transaction = new \App\Models\Transaction($this->DB);

        $txn = $this->Transaction->findOneWhere([
            "id" => $txnID
        ]);

        $customer = $this->User->findOneWhere([
            "id" => $txn['userId']
        ]);

        $message = "Customer ".$customer['username']." wants to sell ". $txn['productName']." @ #". number_format($txn['amount']);
        $message .= "\nID: ".$txn['id'];
        $message .= "\nOn: ". date("d-M-Y h:ia");
        $message .= "\nOpen link below to Follow Up"; 


        if($arg == "agents") {
            $message.= "\nhttps://lyonxchange.com.ng/agent-dashboard/transaction/".$txn['id'];  

            $agents = $this->User->findAllWhere([
                "level" => 1
            ]);
            try {
                foreach ($agents as $agent) {
                    $send = $this->sendSMS([
                        "body" => $message,
                        "receiver" => $agent['phone'],
                        "sender" => "LyonXBOT"
                    ]);

                }
            } catch (\Throwable $th) {
                //throw $th;
            } 
        }

        if($arg == "admins") {
            $message.= "\nhttps://lyonxchange.com.ng/admin-dashboard/transaction/".$txn['id'];  

            $admins = [];

            $admins = $this->User->findAllWhere([
                "level" => 2
            ]);
            $super_admin =$this->User->findOneWhere([
                "level" => 3
            ]);

            $admins[] = $super_admin;

            try {
                foreach ($admins as $admin) {
                    $send = $this->sendSMS([
                        "body" => $message,
                        "receiver" => $admin['phone'],
                        "sender" => "LyonXBOT"
                    ]);

                }
            } catch (\Throwable $th) {
                //throw $th;
            } 
        }
    
    }
    

    /**
     * @param arg is a string
     * This method notifies the agents/admin by Email when a new txn has been created
    */
    public function notifyOfNewTxnByEmail($arg, $txnID){
        $DB = new Database;
        $this->DB = $DB->connect();
        $this->User = new \App\Models\User($this->DB);
        $this->Transaction = new \App\Models\Transaction($this->DB);

        $txn = $this->Transaction->findOneWhere([
            "id" => $txnID
        ]);

        $customer = $this->User->findOneWhere([
            "id" => $txn['userId']
        ]);

        $message = "<p>Customer <b>".$customer['username']."</b> wants to sell ". $txn['productName']." @ #". number_format($txn['amount'])."</p>";
        $message .= "\n<p> ID: <b>".$txn['id']."</b></p>";
        $message .= "\n<p> On: ". date("d-M-Y h:ia")."</p>";
        $message .= "\n<p>Open link below to Follow Up </p>"; 


        if($arg == "agents") {
            $message.= "\n<p>https://lyonxchange.com.ng/agent-dashboard/transaction/".$txn['id']."</p>";  

            $agents = $this->User->findAllWhere([
                "level" => 1
            ]);
            try {
                foreach ($agents as $agent) {
                    // $send = $this->sendSMS([
                    //     "body" => $message,
                    //     "receiver" => $agent['phone'],
                    //     "sender" => "LyonXBOT"
                    // ]);

                    $send = $this->sendEmail([
                        "sender_email" => "no-reply@lyonxchange.com.ng",
                        "sender_name" => "LyonXchange - New Transaction",
                        "receiver_email" => $agent['email'],
                        "receiver_name" => $agent['full_name'],
                        "subject" => "LyonXchange - New Transaction Notification",
                        "body" => $message
                    ]);

                }
            } catch (\Throwable $th) {
                //throw $th;
            } 
        }

        if($arg == "admins") {
            $message.= "\n<p>https://lyonxchange.com.ng/admin-dashboard/transaction/".$txn['id']."</p>";  

            $admins = [];

            $admins = $this->User->findAllWhere([
                "level" => 2
            ]);
            $super_admin =$this->User->findOneWhere([
                "level" => 3
            ]);

            $admins[] = $super_admin;

            try {
                foreach ($admins as $admin) {
                    $send = $this->sendEmail([
                        "sender_email" => "no-reply@lyonxchange.com.ng",
                        "sender_name" => "LyonXchange - New Transaction",
                        "receiver_email" => $admin['email'],
                        "receiver_name" => $admin['full_name'],
                        "subject" => "LyonXchange - New Transaction Notification",
                        "body" => $message
                    ]);
                }
            } catch (\Throwable $th) {
                //throw $th;
            } 
        }
    }
    

}
