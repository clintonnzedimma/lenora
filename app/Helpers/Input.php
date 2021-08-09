<?php 
/**
 * @author Clinton Nzedimma
 * @package Input helpers
 */
namespace App\Helpers;

class Input
{

    public function sanitize ($param) {
	    return htmlentities(strip_tags(trim($param)));
    }

    
    public function mandatory_fields ($required_fields) {
        $check_val = null;
        foreach ($_REQUEST as $key => $value) {
            if (empty($value) && in_array($key, $required_fields) ===true) {
                $check_val = true;
                break 1;
            }
        }	
            return ($check_val==true) ? false : true;
    }


    public function is_phone_number($par){
        if (!preg_match("/[^0-9]/","$par")) return true;
    }

    public function rand_str($length = 4){
        $str = md5(uniqid(rand(), true));
        return substr($str, 0, $length);
    }

    public function is_invalid_username($str) {
        $val=$this->sanitize($str);
        if ( preg_match("/[^a-zA-Z0-9_]/","$val") 
            || preg_match("(')", "$val") 
             || preg_match("/[[:space:]]/", "$val") )  {
            return true;
        }
    }


    public function has_letters_only($str){
        if (!preg_match("/[^a-zA-Z\s]/","$str")) {
            return true;
        } 
    }

    public function is_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return $email;
    }

    function has_whitespace($string) {
        return (preg_match("/[\s]/", $string)) ? $string : false;
    }

	
}
?>