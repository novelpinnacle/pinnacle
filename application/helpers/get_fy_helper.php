<?php 
function get_fy(){
	$date=date_create(date("Y-m-d"));

	if(date_format($date,"m")>=4){
		$fy=(date_format($date,"Y"))."-".(date_format($date,"Y")+1);
	}
	else{
		$fy=(date_format($date,"Y")-1)."-". date_format($date,"Y");
	}
	return $fy;	
}
?>