<?php include("css/panel/chat.php"); ?>
<style>
	.rec-sms span,.sent-sms span{
		font-size: 12px;
	}
	#chats-wrapper{
		padding-bottom: 30px;
	}
	#cf{
		width: calc(100% - 100px);
		float: left;
	}
	#sendbtn{
		float: right;
		margin-top: 20px;
	}
</style>

<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">SMS System <span style=font-size:16px;></span></h4>
		</div>
		<div class="mycardbody">
			<div class="row chat-row">
				<div class="col-sm-3 wp chat-thumb-wrapper">
					<div class="form-group" style="padding:10px">
						<select class="w3-input w3-border" onchange="getStudentByBatch(this.value)">
							<option value="">Select Course &amp; Batch</option>
							<?php 
							foreach ($cb as $v) {
								echo "<option value=$v->id>$v->course - $v->batch</option>";
							}
							?>
						</select>
					</div>
					<div class='form-group' style="padding:0 10px 0 10px">
						<input class='w3-input w3-border' onkeyup="loadAll(this.value)" placeholder="Seach by name or rollno">
					</div>
					<div id="loadbyname"></div>
					<div id="loadnew"></div>
					<div id="loadusers"></div>
					<div id="groups">
						<div class='title-in-chats'>Groups of Courses &amp; Batches</div>
						<?php 
							foreach ($cb as $v) {
								echo "<div class='chat-thumb' onclick='openGroupChat($v->id,\"$v->course - $v->batch\")'>$v->course - $v->batch</div>";
							}
						?>
					</div>
					<div id="uandt">
						<div class='title-in-chats'>Teachers and Staff</div>
						<?php 
							foreach ($uandt as $v) {
								echo "<div data-sid='$v->id' class='chat-thumb ut' onclick='openChat($v->id,\"$v->name\")'>$v->name</div>";
							}
						?>
					</div>					
				</div>
				<div class="col-sm-9 wp chat-area">
					<div id="chatter-info">Person Name</div>
					<div id="chats-wrapper"></div>
					<div id="chatfield">
						
						 <label><input type="radio" name="to" checked value="student"> Student</label>
						 <label><input type="radio" name="to" value="parent"> Parent</label>
						 <label><input type="radio" name="to" value="both"> Both</label>
						 <label id='student_phone' style="float:right;margin-right:100px"></label>
					
						 <textarea id="cf" class="w3-input w3-border" placeholder="Type a message"></textarea>
						 <button onclick="sendSMS()" id="sendbtn" class='btn btn-primary'><i class='fa fa-send'></i> Send</button>
						 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";
	
	function loadAll(name){
		if(name.trim()!=""){
			$.get(baseurl+"erp/getallforchatbyname/"+name,function(data){
				if(data=="no"){
					$("#loadbyname").html("<div class='w3-text-red' style='padding:10px'>No Records Found</div>");
					return;
				}
				$("#loadbyname").html("<div class='title-in-chats'>Students</div>"+data);
			});	
		}else{
			$("#loadbyname").html("");
		}
	}

var activeID;
	function sendSMS(){
		var textmsg=$("#cf").val();
		if(textmsg.trim().length==0) {return};
		$("#loading").show();
		var sms="<div class='sent-sms'>"+textmsg+"</div>";
		var to=$("input[name='to']:checked").val();
		$.post(baseurl+"erp/submitsendsms",{'message':textmsg,'receipient':activeID,'to':to},function(data){
			$("#loading").hide();
			data=JSON.parse(data);
			if(data.status){
				$("#chats-wrapper").prepend(sms);
				$("#cf").val('');
			}
		});		
	}
	var activeGroupID;
	function sendGroupSMS(){
		var textmsg=$("#cf").val();
		if(textmsg.trim().length==0) {return};
		$("#loading").show();
		var sms="<div class='sent-sms'>"+textmsg+"</div>";
		var to =$("input[name='to']:checked").val();
		$.post(baseurl+"erp/sendgroupsms",{'message':textmsg,'receipient':activeGroupID,'to':to},function(data){
			$("#loading").hide();
			data=JSON.parse(data);
			if(data.status){
				$("#chats-wrapper").prepend(sms);
				$("#cf").val('');
			}
		});		
	}

	var interval=null;

	function openChat(userid,name,phone='',fphone=''){
		if(phone!=''){
			student_phone.innerHTML="Student Phone = "+phone+". Father Phone = "+phone;
		}else{
			student_phone.innerHTML='';
		}
		activeID=userid;
		document.getElementById("sendbtn").setAttribute("onclick","sendSMS()");
		$(".chat-thumb").removeClass("active");
		$("#chatfield").show();
		$("#chatter-info").show();
		$("#chatter-info").html(name);
		event.target.classList.add("active");
		$("#chats-wrapper").html("");
		$.get(baseurl+"erp/getsms/"+userid,function(data){
			$("#chats-wrapper").append(data);
		});
	}

	function openGroupChat(batchid,name){
		student_phone.innerHTML='';
		activeGroupID=batchid;
		$(".chat-thumb").removeClass("active");
		$("#chatfield").show();
		$("#chatter-info").show();
		$("#chatter-info").html(name);
		document.getElementById("sendbtn").setAttribute("onclick","sendGroupSMS()");
		event.target.classList.add("active");
		$("#chats-wrapper").html("");
		$.get(baseurl+"erp/getgroupsms/"+batchid,function(data){
			$("#chats-wrapper").append(data);
		});
	}

	function getStudentByBatch(bid){
		if(bid==""){ $("#loadusers").html(""); return;}
		$.get(baseurl+"erp/getStudentsByBatch/"+bid,function(data){
			$("#loadusers").html("<div class='title-in-chats'>Students</div>"+data);
		});

	}
</script>