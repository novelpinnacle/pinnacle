<?php include 'css/panel/calendar.php'; ?>
<style>
.detailbox{
	border:1px solid #ddd;
	height: calc(100vh - 120px);
	padding:0 10px;
	border-radius: 4px;
	position: relative;
}

.times{
	font-size: 12px;
	position: relative;
	line-height: 1.5em;

	line-height: 2.4;
	font-size: 9px;
}
.hiphen{
	position:absolute;
	left: 30px;
	top:9.8px;
}
.showdetail,.showdetail2{
	position: absolute;
	left:50px;
	background: #3185eb;
	color:#fff;
	padding: 0 10px;
	top:0;
	line-height: 1.5em;
	font-size: 10px;
	width:calc(100% - 74px);
	border:1px solid #fff;
	height: 40px;
	border-radius: 4px;
}

#detail-title,#detail-title2 {
	padding:5px;
	margin:0 -10px;
	background-color:var(--main-bg-color1);;
	color:#fff;
	border-radius: 4px 4px 0 0;
}
</style>
<div id="content">
	<div class='container-fluid'>
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Active Timetables</h4>
			</div>
			<div class="mycardbody">
				<div class="row">
					<div class="col-sm-6">
						<?php
							$CI =& get_Instance();
							$CI->load->library("calendarteacher");
							echo $CI->calendarteacher->show($timetables);
						?>
					</div>
					<div class="col-sm-6 wp">
						<div class="row">
							<div class="col-sm-6 wp">
								<div id="detailbox" class="detailbox">
									<div id="detail-title"></div>
								<?php 

									for($i=8;$i<=20;$i++){
									  
									  for($j=0;$j<=55;$j+=30){
									      
									      if($i<12){
									        $ampm="AM";      
									      }else{
									        $ampm="PM";      
									      }
									      
									      $j=$j<10?"0$j":$j;
									      $h=$i;
									      if($i>12){
									       $h=$i-12;     
									      }

									      $time="$i:$j";
									      $id=str_replace(":","",str_replace(" ", "",$time)); 
									     echo "<div class='times' id='$id'>$time - <div class='hiphen'>-</div> </div>";
									    
									  } 
									  
									}
								
								?>
									<div id="dd"></div>
								</div>
							</div>
							<div class="col-sm-6 wp">
								<div id="detailbox2" class="detailbox">
									<div id="detail-title2"></div>
								<?php 

									for($i=8;$i<=20;$i++){
									  
									  for($j=0;$j<=55;$j+=30){
									      
									      if($i<12){
									        $ampm="AM";      
									      }else{
									        $ampm="PM";      
									      }
									      
									      $j=$j<10?"0$j":$j;
									      $h=$i;
									      if($i>12){
									       $h=$i-12;     
									      }

									      $time="$i:$j";
									      $id=str_replace(":","",str_replace(" ", "",$time)); 
									     echo "<div class='times' id='$id'>$time - <div class='hiphen'>-</div> </div>";
									    
									  } 
									  
									}
								
								?>
									<div id="dd2"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

function getOffsetById(id){
	return document.getElementById(id).offsetTop;
}

function createBoxes(index,fromid,toid,showid){
	var showdt=document.getElementsByClassName(showid)[index];
	nfid=fromid;
	isFromNull=false;
	isToNull=false;
	if(document.getElementById(fromid)==undefined){
		isFromNull=true;
		newfromid=fromid;//.substring(0,fromid.length-2);
		fromampm="";//fromid.substring(fromid.length-2);
		fromquarter=newfromid.substring(newfromid.length-2);
		
		if(fromquarter=="15"){
			if(newfromid.length==4){
				nfid=newfromid[0]+newfromid[1]+"00";+fromampm;
			}
			if(newfromid.length==3){
				nfid=newfromid[0]+"00"+fromampm;
			}
		}
		if(fromquarter=="45"){
			if(newfromid.length==4){
				nfid=newfromid[0]+newfromid[1]+"30"+fromampm;
			}
			if(newfromid.length==3){
				nfid=newfromid[0]+"30"+fromampm;
			}
		}
	}

	tmore=0;
	ntid=toid;
	if(document.getElementById(toid)==undefined){
		tmore=9;
		isToNull=true;
		newtoid=toid;//.substring(0,toid.length-2);
		toampm="";//toid.substring(toid.length-2);
		toquarter=newtoid.substring(newtoid.length-2);

		if(toquarter=="15"){
			if(newtoid.length==4){
				ntid=newtoid[0]+newtoid[1]+"00"+toampm;
			}
			if(newfromid.length==3){
				ntid=newtoid[0]+"00"+toampm;
			}
		}
		if(toquarter=="45"){
			if(newtoid.length==4){
				ntid=newtoid[0]+newtoid[1]+"30"+toampm;
			}
			if(newtoid.length==3){
				ntid=newtoid[0]+"30"+toampm;
			}
		}
	}

	minusHeight=0;
	plusHeight=10;

	if(isFromNull){
		minusHeight=9;
		plusHeight=19;
	}
	

	showdt.style.top=getOffsetById(nfid)+plusHeight+"px";
	showdt.style.height=((getOffsetById(ntid)+tmore)-getOffsetById(nfid)-minusHeight)-1+"px";
		

	if(document.getElementById(fromid)!=undefined){
		//showdt.style.top=getOffsetById(fromid)+10+"px";
	}
	if(document.getElementById(toid)!=undefined){
		//showdt.style.height=(getOffsetById(toid)-getOffsetById(fromid))-1+"px";
	}
}


Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}


var currentDate = new Date();
var date = String(currentDate.getDate()).padStart(2, '0');
var mm = String(currentDate.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = currentDate.getFullYear();

today=yyyy+"-"+mm+"-"+date;


var baseurl="<?=base_url()?>";

function loadDetails(dt,appendto,showid,titleid){
	document.getElementById(appendto).innerHTML="";
	$.post({url:baseurl+"user/getscheduledetailsbydate",data:{'dt':dt},success:function(data){
    	    var res=JSON.parse(data);
    	   	if(res.length==0){
    	   		document.getElementById(titleid).innerHTML="No Schedule Available";
    	   		return;
    	   	}
    	    var dt=document.getElementById(titleid);
    	    	dt.innerHTML=res[0].datef;
				var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
				var d = new Date(res[0].date);
				var dayName = days[d.getDay()];
				dt.innerHTML+=" ("+dayName+")";

			

    	    for(i=0;i<res.length;i++){
    	    	let fromid=res[i].from_time.replace(" ","").replace(":","");
    	    	let toid=res[i].to_time.replace(" ","").replace(":","");
    	    	let ele=document.createElement("div");
    	    	ele.setAttribute("class",showid);
    	    	ele.innerHTML=res[i].course + " "+res[i].batch;
    	    	ele.innerHTML+=" ";

    	    	ele.innerHTML+=res[i].printfrom+" - "+res[i].printto;

    	    	if(res[i+1]!=undefined){
    	    		nextfrom=parseInt(res[i+1].from_time.replace(":",""));
    	    		
    	    		if(toid>nextfrom){
    	    			ele.style.width="calc(50% - 30px)";
    	    		}
    	    	}
    	    	if(res[i-1]!=undefined){
    	    		prevto=parseInt(res[i-1].to_time.replace(":",""));
    	    		if(fromid<prevto){
    	    			ele.style.left="180px";
    	    			ele.style.width="calc(50% - 30px)";
    	    		}
    	    	}

    	    	document.getElementById(appendto).appendChild(ele);
    	    	createBoxes(i,fromid,toid,showid);
    	    }
    }}); 
}

loadDetails(today,'dd','showdetail','detail-title');


nextDate=currentDate.addDays(1);
 date = String(nextDate.getDate()).padStart(2, '0');
 mm = String(nextDate.getMonth() + 1).padStart(2, '0'); //January is 0!
 yyyy = nextDate.getFullYear();

next=yyyy+"-"+mm+"-"+date;
loadDetails(next,'dd2','showdetail2','detail-title2');
</script>