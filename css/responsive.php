<style>
@media screen and (max-width: 768px){
	body{
		padding-top: 60px;
	}
.bars-container {
	z-index: 2;
  display: inline-block;
  position: absolute;
  right:10px;
  top:10px;
  cursor: pointer;
}

.bar1, .bar2, .bar3 {
  width: 35px;
  height: 5px;
  background-color: var(--main-bg-color2);
  margin: 6px 0;
  transition: 0.4s;
}

.change .bar1 {
  -webkit-transform: rotate(-45deg) translate(-9px, 6px);
  transform: rotate(-45deg) translate(-9px, 6px);
}

.change .bar2 {opacity: 0;}

.change .bar3 {
  -webkit-transform: rotate(45deg) translate(-8px, -8px);
  transform: rotate(45deg) translate(-8px, -8px);
}

.mobile-menu-wrapper{
	display: block;
	position: fixed;
	z-index: 2;
	background: #fff;
	top:60px;
	left:0;
	width:100%;
	transition: all .3s;
	opacity: 0;
	visibility: hidden;
	transform: scale(.5);
	box-shadow: 0 5px 5px rgba(0,0,0,0.25);
}
.show-mobile-menu{
	opacity: 1;
	visibility: visible;
	transform: scale(1);
}
.mobile-menu{
	margin:0;padding:0;list-style-type: none;
}
.mobile-menu li{
	display: block;
	position: relative;
	margin-bottom: 2px;
}
.mobile-menu li i.fa-angle-right{
	position: absolute;
	right:15px;
	top:5px;
	font-size: 25px;
}
.header-menu-item{
display: block;
padding:5px 15px;
}
.mobile-menu li:hover .header-menu-item,.header-menu-item.active{
text-decoration: none;
border:none;
background: var(--main-bg-color1);
color:#fff;
}
.mobile-menu>li:hover>.fa{color:#fff;}
.sub-menu{
	position: relative;
	width: 100%;
	opacity: 1;
	margin-left: 15px;
	visibility: visible;
	transform: scale(1);
	max-height: 0;
	padding-top: 2px;
	overflow: hidden;
	box-shadow: none;
	transition: all .3s;
}
.mobile-submenu-show{
	max-height: 20em;
}

.sub-menu li a{
	padding:3px 10px;
}
.sub-menu li a:hover{
	background: var(--main-bg-color1);
	color:#fff;
	text-decoration: none;
}

	#topbar{
		display: none;
	}
	.menu{
		display: none;
	}
	#header{
		height:60px;
	}
	#header-box{
		width:50%;
		left: 7px;
	}
	#header-box img{
		height:60px;
	}
	.slider-text {
		padding: 0 50px;
		width: 100%;
		left:0;
		top:10px;
		text-align: center;
	}
	.slider-right,.slider-center{
		text-align:center;
	}
	.slider-text h1{
		font-size: 18px;
		line-height: 1.2em;
	}
	.slider-text p{
		font-size: 13px;
		line-height: 1.4em;
	}
	.slider-right p{
		padding: 0;
	}
	.slider-text .button{
		margin-top: 20px;
	}
	.slider-text .w3-btn{font-size: 12px;padding: 0px 10px;}
	.carousel-indicators{
		display: none;
	}
	.carousel-inner .item img{
		width: 100%;
		height:200px;
	}	
	.carousel-control{
		width:40px;
		height:40px;
		top:calc(50% - 25px);
	}
	.carousel-control.left{
		left:7px;
	}
	.carousel-control.right{
		right:7px;
	}
	.carousel-control .glyphicon-chevron-left{
		color:#fff;
		top:calc(50% - 0px);
		margin-left: -10px;
	}
	.carousel-control .glyphicon-chevron-right{
		color:#fff;
		top:calc(50% - 0px);
		margin-right: -10px;
	}
.section{
	padding:30px 0;
}
.section-title {
	text-align: center;
	margin-bottom: 30px;
	padding: 0px;
}
.section-title h2 {
	font-size: 30px;
}
.section-title p{
	font-size:14px;
}

.enroll-right{
	margin-top: 50px;
}
.enroll .section-title h2{
	font-size: 20px;
	line-height: 1.4em;
}
.skill-main .col-xs-4{
	padding-left: 0px;
	padding-right: 0px;
}
.skill-main h2{
	font-size: 25px;
}
.skill-main h4{
	font-size: 14px;
}
.cta {
	background-repeat: repeat-y;
}
.cta .cta-inner {
	padding: 30px
}
.cta .cta-inner h2 {
	font-size: 20px;
	line-height: 1.4em;
}

.testimonials .item{
	padding-top: 20px;
}

.news .item{
	margin-bottom: 20px;
}

.single-testimonial{
	z-index: 1;
}

.footer .useful-links ul li {
	display: inline-block;
	margin-right: 5px;
}
.blog-detail{
	box-shadow: 0 0 10px rgba(0,0,0,.25);
	padding: 10px;
}
.blog.single [class*="col-"],.events.single [class*="col-"]{
	padding:0 10px;
}
.events.single .container,.blog.single .container{
	padding: 0;
}


.section.pages h2{
	font-size: 22px;
}
.contact-bottom [class*="col-"]{
	margin-bottom: 20px;
}
#contact-form{
	margin-top: 20px;
}
.container.images{
	padding:0;
}
.video-wrapper iframe{
	width: 100%;
	height: auto;
}

#resultmodal{
	top:70px;
	transform: translateY(0);
	width: 95%;
	left:2.5%;
	right: 2.5%;
}
#resultmodal img{
	padding:4px;
}
#resultmodal i.fa{
	right: inherit;
	top:-30px;
	right:-6px;
	height:30px;
	width: 30px;
	font-size: 20px;
	line-height: 30px;
	box-shadow: 0 0 5px #999;
}

}
</style>