<?php include("css/panel/chat.php"); ?>
<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Chat System <span style=font-size:16px;></span></h4>
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
							 echo "<div data-sid='11' class='chat-thumb ut' onclick='openChat(11,\"Admim\")'>Admin</div>";
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
		$.post(baseurl+"user/sendchat",{'message':event.target.value,'receipient':activeID},function(data){
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
		$.post(baseurl+"user/sendgroupchat",{'message':event.target.value,'receipient':activeGroupID},function(data){
			data=JSON.parse(data);
			if(data.status){
				$("#chats-wrapper").prepend(sms);
				target.value='';	
			}
		});		
	}

	var interval=null;

	function getChats(id){
		$.get(baseurl+"user/getchats/"+id,function(data){
			$("#chats-wrapper").html("");
			$("#chats-wrapper").append(data);
		});	
	}

	function openChat(userid,name){
		activeID=userid;
		document.getElementById("cf").setAttribute("onkeyup","if(event.keyCode==13){sendSMS();}");
		$(".chat-thumb").removeClass("active");
		$("#chatfield").show();
		$("#chatter-info").show();
		$("#chatter-info").html(name);
		event.target.classList.add("active");
		$("#chats-wrapper").html("");
		$.get(baseurl+"user/getchats/"+userid,function(data){
			$("#chats-wrapper").append(data);
		});

		let cnt=event.target.getElementsByClassName("chat-count");
		if(cnt.length>0){
			cnt[0].remove();
		}

		if(interval!=null){
			clearInterval(interval);
		}
		interval=setInterval(function(){getChats(userid);},3000);

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
		$.get(baseurl+"user/getgroupchats/"+batchid,function(data){
			$("#chats-wrapper").append(data);
		});

		if(interval!=null){
			clearInterval(interval);
		}

	}

	var liveInterval=null;
	function getStudentByBatch(bid){

		if(liveInterval!=null){
			clearInterval(liveInterval);
		}

		if(bid==""){ $("#loadusers").html(""); return;}
		$.get(baseurl+"user/getStudentsByBatch/"+bid,function(data){
			$("#loadusers").html("<div class='title-in-chats'>Students</div>"+data);
			getLiveChatsCount();
			liveInterval=setInterval(function(){getLiveChatsCount();},3000);
		});

	}

	function getLiveChatsCount(){
		var eles=document.querySelectorAll("[data-sid]");
		var sids=[];
		for(let e of eles){
			sids.push(e.getAttribute("data-sid"));
		}
		$.post(baseurl+"user/getlivechatscount/",{'sids':sids+""},function(data){
			list=JSON.parse(data);
			for(let l of list){
				$("[data-sid="+l.sender+"] .chat-count").remove();
				$("[data-sid="+l.sender+"]").append("<div class='chat-count' onclick='event.stopPropagation();this.parentElement.click()' >"+l.cnt+"</div>");
			}
		});
	}

	function getLiveChatsOfAll(){
		$.get(baseurl+"user/getlivechatsofall",function(data){
			if(data=="no"){ $("#loadnew").html("");return;}
			$("#loadnew").html("");
			$("#loadnew").append("<div class='title-in-chats'>New Chats</div>"+data);
		});
	}
	getLiveChatsOfAll();
	setInterval(getLiveChatsOfAll,3000);
</script>