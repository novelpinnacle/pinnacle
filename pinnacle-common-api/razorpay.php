<?php 
    
    $req = file_get_contents("php://input");
    $req = json_decode($req,true);
    extract($req);
    
    	$string = $myOrderId."|".$razorPaymentId;
		$mySignature =  hash_hmac('sha256', $string, "cBJw3gzBaYtCgcjQfo9ASNdQ");

		if($mySignature == $razorSignature){
		    echo json_encode(["success"=>true]);
		}
		else{
		    echo json_encode(["success"=>false]);
		}
    
?>