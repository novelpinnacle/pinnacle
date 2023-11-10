<style>
.mycardbody{
	padding:0;
}
.chat-row{
	height:90vh;
}
.chat-thumb-wrapper{
	padding:0 0px;
	background: #fff;
	height:100%;
	overflow-y: auto;
}
.chat-thumb{
	position: relative;
	padding:7px 10px;
	border-bottom: 1px solid #ddd;
	font-weight: 500;
	cursor: pointer;
}

.chat-roll{
	position: absolute;
	right:10px;
	bottom: 10px;
	color:#888;
	font-size: 12px;
}

.chat-count{
	position: absolute;
	top:17px;
	right:100px;
	height: 30px;
	width: 30px;
	text-align: center;
	line-height: 30px;
	border-radius: 100%;
	background: #090;
	color:#fff;
}

.chat-thumb.ut .chat-count{
	top:5px;
}

.chat-cb{
	font-size: 12px;
	color:#888;
}

.chat-thumb:last-child{
	border-bottom: none;
}
.chat-thumb.active{
	background: #efefef;
}

.chat-area{
	height: 100%;
	background-image: url(<?=base_url()?>images/chat-bg.png);
	background-size: cover;
	padding-bottom: 100px;
	padding-top: 50px;
}

#chatter-info{
	display: none;
	position: absolute;
	top:0;
	left: 0;
	width: 100%;
	padding:12px;
	background: #fff;
	border-left: 1px solid #ddd;
}

#chatfield{
	display: none;
	position: absolute;
	bottom:0;
	width: 100%;
	padding:10px;
	background: #fff;
}
#chatfield textarea{
	resize: none;
	height: 80px;
	outline: none;
	border-radius: 15px;
}

#chats-wrapper{
	display: flex;
	flex-direction: column-reverse;
	align-items: flex-end;
	height: 100%;
	overflow-y: auto;
}
.sent-sms,.rec-sms{
	padding: 5px 15px;
	border-radius: 4px;
	background: #dcf8c6;
	margin:5px 40px;
}
.rec-sms{
	background: #fff;
	align-self: flex-start;
}

.title-in-chats {
	padding: 10px;background:green;color:#fff;
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
						<textarea id="cf" class="w3-input w3-border"  onkeydown="if(event.keyCode==13){event.preventDefault();}" onkeyup="if(event.keyCode==13){sendSMS()}" placeholder="Type a message"></textarea>
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
			$.get(baseurl+"user/getallforchatbyname/"+name,function(data){
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
		if(event.target.value.trim().length==0) { event.target.value=''; return};
		var sms="<div class='sent-sms'>"+event.target.value+"</div>";
		var target=event.target;
		$.post(baseurl+"user/submitsendsms",{'message':event.target.value,'receipient':activeID},function(data){
			data=JSON.parse(data);
			if(data.status){
				$("#chats-wrapper").prepend(sms);
				target.value='';	
			}
		});		
	}
	var activeGroupID;
	function sendGroupSMS(){
		if(event.target.value.trim().length==0) { event.target.value=''; return};
		var sms="<div class='sent-sms'>"+event.target.value+"</div>";
		var target=event.target;
		$.post(baseurl+"user/sendgroupsms",{'message':event.target.value,'receipient':activeGroupID},function(data){
			data=JSON.parse(data);
			if(data.status){
				$("#chats-wrapper").prepend(sms);
				target.value='';	
			}
		});		
	}

	var interval=null;

	function openChat(userid,name){
		activeID=userid;
		document.getElementById("cf").setAttribute("onkeyup","if(event.keyCode==13){sendSMS();}");
		$(".chat-thumb").removeClass("active");
		$("#chatfield").show();
		$("#chatter-info").show();
		$("#chatter-info").html(name);
		event.target.classList.add("active");
		$("#chats-wrapper").html("");
		$.get(baseurl+"user/getsms/"+userid,function(data){
			$("#chats-wrapper").append(data);
		});
	}

	function openGroupChat(batchid,name){
		activeGroupID=batchid;
		$(".chat-thumb").removeClass("active");
		$("#chatfield").show();
		$("#chatter-info").show();
		$("#chatter-info").html(name);
		document.getElementById("cf").setAttribute("onkeyup","if(event.keyCode==13){sendGroupSMS();}");
		event.target.classList.add("active");
		$("#chats-wrapper").html("");
		$.get(baseurl+"user/getgroupsms/"+batchid,function(data){
			$("#chats-wrapper").append(data);
		});
	}

	function getStudentByBatch(bid){
		if(bid==""){ $("#loadusers").html(""); return;}
		$.get(baseurl+"user/getStudentsByBatch/"+bid,function(data){
			$("#loadusers").html("<div class='title-in-chats'>Students</div>"+data);
		});

	}
</script>