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

@media screen and (max-width: 768px){
	#chats-wrapper{
		height:60vh;
	}	
	#chatfield{
		bottom:0;
		left:0;
	}
	#cf{
		width: 80%;
	}
	#chatfield button{
		position: absolute;
		right:4px;
		top:20px;
		padding:20px;
	}
}
</style>
