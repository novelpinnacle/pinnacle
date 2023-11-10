<style>
body{
	font-family: roboto;
	padding-left: 180px;
	padding-top: 0;
}
#slogo{
	text-align: center;
	font-weight: 700;
	font-size: 20px;
	color:#ccc;
	padding:30px;
	border-bottom: 1px solid #ccc;
}
#slogo>a{
	text-decoration: none;
	color:#ccc;
}
#mobile-nav{
	display: none;
	position: fixed;
	width: 100%;
	top:0;
	left: 0;
	z-index: 4;
    background-color:var(--main-bg-color1);
    padding: 10px;
    box-shadow: 0 0 4px rgba(0,0,0,0.4);
}
#mobile-nav:after{
    content: '';
    display: block;
    clear: both;
}
#brand{
    float: left;
    font-size: 20px;
    color:#fff;
    font-weight: 500;
}
#ham{
    float: right;
}
#ham>div{
width: 35px;
height: 5px;
background-color: #fff;
margin: 4px 0;
}
nav{
	z-index: 3;
	top:0;
	left:0;
	position: fixed;
	width:180px;
	height:100%;
	overflow: auto;
	background-color:var(--main-bg-color1);
}
	nav>ul{
		list-style: none;
		margin: 0;
		padding: 0;
	}
	nav>ul>li{
	padding:0 0px;
	border-bottom:1px solid #3d3131;
	cursor: pointer;
	}
	nav>ul>li:last-child{border-bottom: none;}
	nav>ul>li>a{
		font-size:13px;
		display: block;
		color:#aaa;
		padding:5px 12px;
	}
	nav>ul>li.active>a,nav>ul>li:hover>a{
	text-decoration: none;
	color:#aaa;
	background: #380202;
	}

	.sidebar-submenu{
		max-height: 0;overflow: hidden;transition: all .4s ease-in-out;
		margin: 0;padding:0;list-style: none;
	}

	.sidebar-submenu>li>a{
		margin:1px 0;
		display: block;
		color:#aaa;
		padding:2px 15px;
		padding-left: 20px;
		font-size: 13px;
		text-decoration: none;
	}
	.sidebar-submenu>li:last-child>a{
		margin: 0;
	}
	.sidebar-submenu>li>a:hover,.sidebar-submenu>li>a.active {
		text-decoration: none;
		color:#aaa;
		background-color: #380202;
	}

	nav>ul>li.active .sidebar-submenu{
		max-height: 20em;
	}

	@media screen and (max-width: 768px){
		body{
			padding-top: 52px;
			padding-left: 0;
		}
		nav{
			top:51px;
			left:-180px;
			transition: all .3s;
		}
		.togglesidebar{
			left:0;
		}
		#mobile-nav{
			display: block;
		}
		#content{
			padding:10px 10px;
		}
	}

</style>