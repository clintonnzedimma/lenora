<?php  
/**
 * Beamify service class for Lenora
 */
namespace App\Services;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;


class VideoAPI
{

    public function generate_token($room_name = 'test-room',    $identity = null)
    {
        // Substitute your Twilio Account SID and API Key details
        $accountSid = $_ENV['TW_SID'];
        $apiKeySid = $_ENV['TW_SID'];
        $apiKeySecret = $_ENV['TW_TKN'];

        if($identity == null) $identity = uniqid();

        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom($room_name);
        $token->addGrant($grant);

        // Serialize the token as a JWT
        echo $token->toJWT();
    }
  

}
