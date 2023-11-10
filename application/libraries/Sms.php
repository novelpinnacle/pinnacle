<?php
class Sms
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
    }

    public function sendSMS($mobile,$msg){
    	$mobile=$mobile;
		$msg=urlencode($msg);
		$url="http://pro.eglsms.in/app/smsapi/index.php?key=25E3C2685481C8&campaign=0&routeid=2&type=text&contacts=$mobile&senderid=SMSDTL&msg=$msg";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page = curl_exec($ch);
		curl_close($ch);
		return $curl_scraped_page;
    }
 }