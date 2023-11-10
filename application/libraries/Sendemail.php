<?php
class Sendemail
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
    }

    public function sendEmail($to,$subject,$message){

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: Pinnaclo Educare <query@pinnacloeducare.com>' . "\r\n";
		$headers.='Reply-To: query@pinnacloeducare.com'."\r\n";
		return mail($to,$subject,$message,$headers);
    }

}

?>