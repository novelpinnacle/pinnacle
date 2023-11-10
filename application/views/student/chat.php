<?php include("css/panel/chat.php"); ?>
<style>
	.rec-sms span,.sent-sms span{
		font-size: 12px;
	}
</style>
<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Chat System <span style=font-size:16px;></span></h4>
		</div>
		<div class="mycardbody">
			<div class="row chat-row">
				<div class="col-sm-3 wp chat-thumb-wrapper">
					<div id="loadnew"></div>
					<div id="teachers">
						<div class='title-in-chats'>Teachers</div>
						<?php 
							 echo "<div data-sid='11' class='chat-thumb ut' onclick='openChat(11,\"Admin\")'>Admin</div>";
							 foreach ($teachers as $v) {
							 	echo "<div data-sid='$v->id' class='chat-thumb ut' onclick='openChat($v->id,\"$v->name\")'>$v->name</div>";
							 }
							
						?>
					</div>					
				</div>
				<?php if(!isMobile()) {?>
				<div class="col-sm-9 wp chat-area">
				<div id="chatter-info">Person Name</div>
					<div id="chats-wrapper"></div>
					<div id="chatfield">
						<textarea id="cf" class="w3-input w3-border"  onkeydown="if(event.keyCode==13){event.preventDefault();}" onkeyup="if(event.keyCode==13){sendSMS()}" placeholder="Type a message"></textarea>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>

	<div class="modal" id="chatmodal">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Chat</h4>
	      </div>
	      <div class="modal-body chat-area" style="position:relative">
	       		<div id="chats-wrapper"></div>
				<div id="chatfield">
					<textarea id="cf" class="w3-input w3-border"  onkeydown="if(event.keyCode==13){event.preventDefault();}" onkeyup="if(event.keyCode==13){sendSMS()}" placeholder="Type a message"></textarea>
					<button class='btn btn-default' onclick="sendSMS()"><i class='fa fa-send'></i></button>
				</div>
	      </div>
	 <!--      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div> -->
	    </div>

	  </div>
	</div>

</div>



<script>
var baseurl="<?=base_url()?>";

var activeID;
	function sendSMS(){
		var msg=$("#cf").val();
		if(msg.trim().length==0) { $("#cf").val(""); return};
		var sms="<div class='sent-sms'>"+msg +"</div>";
		
		$("#chats-wrapper").prepend(sms);
		$.post(baseurl+"student/sendchat",{'message':msg,'receipient':activeID},function(data){
			data=JSON.parse(data);
			if(data.status){
				$("#cf").val("");
			}
		});		
	}
	var interval=null;

	function getChats(id){
		$.get(baseurl+"student/getchats/"+id,function(data){
			$("#chats-wrapper").html("");
			$("#chats-wrapper").append(data);
		});	
	}

	function openChat(userid,name){

		<?php if(isMobile()) {?>
		$("#chatmodal").modal();
		<?php }?>

		activeID=userid;
		$(".chat-thumb").removeClass("active");
		$("#chatfield").show();
		$("#chatter-info").show();
		$("#chatter-info").html(name);
		event.target.classList.add("active");
		$("#chats-wrapper").html("");
		$.get(baseurl+"student/getchats/"+userid,function(data){
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

	function getLiveChatsCount(){
		var eles=document.querySelectorAll("[data-sid]");
		var sids=[];
		for(let e of eles){
			sids.push(e.getAttribute("data-sid"));
		}
		$.post(baseurl+"student/getlivechatscount/",{'sids':sids+""},function(data){
			list=JSON.parse(data);
			for(let l of list){
				$("[data-sid="+l.sender+"] .chat-count").remove();
				$("[data-sid="+l.sender+"]").append("<div class='chat-count' onclick='event.stopPropagation();this.parentElement.click()' >"+l.cnt+"</div>");
			}
		});
	}

	getLiveChatsCount();
	setInterval(getLiveChatsCount,3000);

</script>