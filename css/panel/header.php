<style>
#header{
//box-shadow: 0 0 5px rgba(0,0,0,0.25);
	position: fixed;
	top:0;
	background-color: #fff;
	left: 0;
	width:100%;
	z-index: 1;
}
#logo{
	float: left;
	color:var(--main-bg-color1);
	margin-right: 40px;
	padding: 17.9px 0px;
	padding: 6.7px 0;
	font-size: 17px;
	font-weight: 500;
}
#logo a:hover{
text-decoration: none;
}

.menu{
	list-style-type: none;
	margin:0;
	padding: 0;
	border-bottom:1px solid #d6d6d6;
}
.menu>li{
	display: inline-block;
	padding:0;
	float: left;
	position: relative;
	border-right:1px solid #d6d6d6;
}
.menu>li:last-child{
	border-right: none;
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
padding: 6px;
color:#252525;
font-size: 16px;
}	
.menu>li:hover .header-menu-item,.header-menu-item.active{
text-decoration: none;
font-weight: bold;
border-bottom:2px solid var(--main-bg-color1);	
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