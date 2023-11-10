<style>
html {
  scroll-behavior: smooth;
}
body {
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    font-size: 14px;
    color: #252525;
    line-height: 25px;
    position: relative;
    padding-top: 97px;
    transition: all .3s;
  -webkit-user-select: none;  /* Chrome 49+ */
  -moz-user-select: none;     /* Firefox 43+ */
  -ms-user-select: none;      /* No support yet */
  user-select: none; 
	}

.overlay{
	position:relative
}
.overlay::before {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 0.2;
	background: #000;
	content: "";
	-webkit-transition: all 0.4s ease;
	-moz-transition: all 0.4s ease;
	transition: all 0.4s ease;
}
:root{
	--main-bg-color1:#1f0000;
	--main-bg-color2:#f80; 
}
.b-primary,.b-primary:hover{
		background:var(--main-bg-color1);
		color:#fff;
}
.c-primary{
		color:var(--main-bg-color1);
}
.row{
		margin-left: 0;
		margin-right: 0;
}


.breadcrumbs {
    background: url(http://themelamp.com/html/learnedu/images/enroll-bg.jpg);
    background-position: 100%;
    position: relative;
    background-repeat: no-repeat;
    background-size: cover;
    text-align: center;
    padding: 80px 0;
}
.breadcrumbs.overlay::before {
	opacity: 0.6;
	background: #252525;
}
.breadcrumbs h2 {
	color: #fff;
	position: relative;
	text-transform: capitalize;
	font-size: 45px;
	font-weight: 700;
}
.breadcrumbs .bread-list {
	border-radius: 3px;
	background: transparent;
	display: inline-block;
	margin-top: 20px;
}
.breadcrumbs ul li {
	display: inline-block;
	position: relative;
}
.breadcrumbs ul li a {
	color: #fff;
	font-size: 18px;
	font-weight: 500;
	text-transform: capitalize;
}
.breadcrumbs ul li.active a {
	padding: 4px 20px;
	border-radius: 5px;
	color: #fff;
	background: var(--main-bg-color1);
}
.breadcrumbs ul li i{
	margin:0px 15px;
}
.jquery-dialog{
	display: none;
}

.sc-table{
	border-collapse: collapse;
	background: #fff;
	overflow: scroll;
	min-width: 100%;
}
.sc-table th,.sc-table td{
	border:1px solid #ccc;
}
.sc-table th{
color:#555;
padding: 3px 10px;
font-size: 15px;
font-weight: 500;
}
.sc-table td{
color:#555;
font-size: 14px;
padding: 2px 10px;
}
.table-wrapper{
	max-width: 100%;
	overflow: auto;
}
::-webkit-scrollbar {
  width: 7px;
  background:var(--main-bg-color1);
  height: 0px;

}
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
::-webkit-scrollbar-thumb {
  background: var(--main-bg-color1);
}
::-webkit-scrollbar-thumb:hover {
  background:var(--main-bg-color1);
}
.prevent-copy {  
  -webkit-user-select: none;  /* Chrome 49+ */
  -moz-user-select: none;     /* Firefox 43+ */
  -ms-user-select: none;      /* No support yet */
  user-select: none;          /* Likely future */   
}

#resultmodal{
	position: fixed;
	top:50%;
	transform: translateY(-50%);
	width: 70%;
	left: 15%;
	right: 15%;
	height:auto;
	z-index: 10;
	text-align: center;

}
#resultmodal img{
	display: inline-block;
	max-width: 100%;
	background:#f90;
	padding: 5px;
}
#resultmodal i.fa{
	cursor: pointer;
	position: absolute;
	right: -15px;
	top:-15px;
	color:red;
	font-size: 24px;
	background: #fff;
	border-radius: 100%;
	width: 30px;
	height: 30px;
	line-height:30px;
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


</style>
