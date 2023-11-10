<style>
#main-header{
	position: fixed;
	width: 100%;
	z-index: 2;
	top:0;
	transition: all .3s;
	box-shadow: 0 0 5px rgba(0,0,0,0.35);
}
#topbar{
background:var(--main-bg-color1);
position: relative;
padding: 6px 0;
border-bottom: 1px solid #e2e2e2;
margin-left: 300px;
}
.top-bar-text{
	color:var(--main-bg-color2);
	font-size: 14px;
}
.fa-envelope,.fa-phone,.fa-map-o {
color:var(--main-bg-color2);
}
.top-left{
font-size: 16px;
}
.fa-youtube-play.top-social{
color:#c4302b;
}
.fa-facebook-official.top-social{
color: #3b5998;
}
.fa-twitter.top-social{
color:#1da1f2;
}
.top-social{
font-size: 20px;
margin:0 7px;
}
#header{
position: relative;
background:var(--main-bg-color1);
}
#header-box{
position: absolute;
width: 300px;
left: 0px;
top:0;
z-index: 2;
}
#header-box img{
	width: 100%;
	height: 99px;
}

.menu{
	list-style-type: none;
	margin:0;
	padding: 0;
	text-align: right;
}
.menu>li{
	display: inline-block;
	padding:15px 6px 15px 6px;
	position: relative;
}
.menu li .fa-angle-right {
	display: none;
}
.menu>li:hover .sub-menu{
	opacity: 1;
	visibility: visible;
	transform: scale(1);
}
.header-menu-item:first-child{
margin-left: 0;
}
.header-menu-item{
position: relative;
display: inline-block;
padding: 3px 2px;
color:var(--main-bg-color2);
font-size: 16px;
}	
.menu>li:hover .header-menu-item,.header-menu-item.active{
text-decoration: none;
color:var(--main-bg-color2);
border-bottom:2px solid var(--main-bg-color2);	
}

.sub-menu{
	transition: all .3s ease;
	transform: scale(.6);
	opacity: 0;
	visibility: hidden;
	padding: 0;
	z-index: 2;
	width:200px;
	position: absolute;
	left: 0;
	top:100%;
	box-shadow: 0 0  5px rgba(0,170,170,.45);
	background: #fff;
	text-align: left;
}
.sub-menu li{
	display: block;
}
.sub-menu li a{
	padding:8px 10px;
	font-size: 14px;
	display: block;
	color:#333;
}
.sub-menu li a:hover{
	background: var(--main-bg-color1);
	color:#fff;
	text-decoration: none;
}
.bars-container{
	display:none;
}
.mobile-menu-wrapper{
	display: none;
}


</style>