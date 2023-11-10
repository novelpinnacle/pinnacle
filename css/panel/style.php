<style>
body{
	background: #d8d8d8;
	padding-top: 40px;
}
.wp{
	padding: 0;
}
.pl{
	padding-left: 5px;
}
.pr{
	padding-right: 5px;
}
#content{
	padding:10px 10px;
	padding-bottom: 0;
}
.boxc{
	margin-top: 50px;
}
.boxes{
	background: #fff;
	margin-bottom: 30px;
	box-shadow: 0 0 10px rgba(0,0,0,0.25);
	border-bottom: 2px solid var(--main-bg-color1);
}
.boxes .body{
	padding:20px 15px;
	text-align: center;
}
.body h2{
	margin-top: 0;
	font-size: 60px;
	font-weight: 700;
	color:var(--main-bg-color1);
}
.body p{
	font-size: 15px;
	color:#777;
}
.body .w3-btn{
	width:120px;
	font-size: 16px;
}
input.w3-input,select.w3-input{
	height:30px;
	padding-top:0;
	background: #fff;
	padding-bottom: 0;
}
.small-btn{
	height:30px;
	padding: 3px 10px;
}
.thumbnail-img{
	width: 100px;
	height:50px;
	display: block;
}

.mycard{
	z-index: 1;
    display: flex;
    flex-direction: column;
    border: 0;
    margin-top: 0px;
    border-radius: 6px;
    color: #333333;
    background: #fff;
    width: 100%;
    border:1px solid #d6d6d6;
}
.mycardheader{
	position: relative;
    border-radius: 3px 3px 0 0;
    margin-right: -1px;
    padding:10px 15px;
 }

.mycardtitle{
	margin:0;
    font-weight: 500;
    font-size: 17px;
    color:#fff;
}
.mycardbody{
    padding: 15px 25px;
}

.jquery-dialog{
	display: none;
}

#loading{
display: none;
}

#loading-wrapper{
  position: fixed;
  width:200px;height:200px;
  top:calc(50% - 110px);
  left:calc(50% - 100px);
  z-index: 4;
  text-align: center;
  background-color: rgba(255,255,255,.55);
}
.fa.loading{
  font-size: 50px;
  position: fixed;
  z-index: 5;
  left:calc(50% - 25px);
  top:calc(50% - 55px);
}
#loadingtext{
  font-size: 20px;
  position: fixed;
  z-index: 5;
  top:calc(50% + 10px);
  left: calc(50% - 40px);
}

.message-wrapper{
	display: none;
	position: fixed;
	width: 100%;
	height: 100%;
	top:0;
	left: 0;
	background:rgba(0,0,0,0.1);
	z-index: 2;
	text-align: center;
}
	.message{
		position: relative;
		top:calc(50% - 100px);
		max-width: 400px;
		margin:0 auto;
		padding:30px 20px;
		box-shadow: 0 0 10px #888;
		background: #fff;
	}
	.messagecontent{
		padding: 10px 0;
	}
	.message .fa{
		position: absolute;
		right:5px;
		top:5px;
		font-size: 25px;
		cursor: pointer;
		color:#888;
	}
.message .fa:hover{
		color:#000;
}
.fa-close,.fa-remove{cursor: pointer;color:red;}
.file-wrapper{
	max-height:0;overflow:hidden;padding-left:100px;
}

.fancy-btn{
	border:1px solid #bbb;
	background: #cecece;
	color:#555;
	background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,1)), to(rgba(255,255,255,0)));
	padding:3px 10px;
	font-size: 13px;
	font-family: arial,helvetica,sans-serif;
	font-weight: bold;
}

.dt-buttons{
	float: right;
	margin-bottom: 10px;
}
#stable_filter{
	float: left;
	margin-bottom: 0px;
}

/** Related to Datatable and buttons etc **/

table.dataTable tbody td{
	padding:3px 18px;
}
table.dataTable thead th{
	padding:4px 18px;
}

.dataTables_info{
	float: left;
}
.dataTables_paginate{
	float: right;
}

.sc-table td{
	border:none;
	border-bottom: 1px solid #ddd;
}
.sc-table td:first-child{
	border-left: 1px solid #ddd;
}
.sc-table td:last-child{
	border-right: 1px solid #ddd;
}


td .btn{
	padding:2px 5px;
	margin:0 2px;
}
label span{
	color:red;
}

</style>