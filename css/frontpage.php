
<style>
#myCarousel{
	z-index: 1;
}
.carousel-indicators .active{
	background-color:var(--main-bg-color1);
	border-color: var(--main-bg-color1);
}
.topper-outer-padding{
	padding: 10px;
	background-image: linear-gradient(to top, #f2dec5 0% 33%, #ffffff 33% 66%, #f2dec5 66% 100%);
}
.topper-wrapper{
	margin:5px;
	box-shadow: 0 0 10px rgba(0,0,0,0.25);
	border: 4px solid #e19248;
}
.topper-image-wrapper{
	/*background: linear-gradient(to top, white 50%, #f2dec5 50%);*/
	text-align: center;
}
.topper-image-wrapper img{
	border-radius: 100%;
	border: 4px solid #e19248;
}
.single-topper{
	/*margin-top: 30px;*/
}
.topper-content{
	background-color: #ffffff;
	text-align: center;
	padding-top:10px;
}
.topper-content h2{
	font-size:18px;
	font-weight: 700;
	color: white;
	background-color: #791415;
}
.topper-content #toppercontentcollege {
	background-color: #e19248;
}
.topper-content p{
	font-size: 16px;
	font-weight: 700;
}


/*=============
Styles for Sections Common Starts
===============
*/		
.section{
padding:90px 0;
}
.section-title{
text-align: center;
margin-bottom: 40px;
padding: 0 120px;
}
.section-title p{
color: #666;
font-size: 15px;
}
.section-title h2{
font-size: 38px;
font-weight: 700;
line-height: 46px;
padding-bottom: 12px;
position: relative;
margin-bottom: 18px;
}
.section-title h2 span{
color:var(--main-bg-color1);
}

.section-title h2::before{
position: absolute;
left: 50%;
content: "";
width: 100px;
height: 2px;
background: #666;
bottom: -1px;
margin-left: -50px;
}
.section-title h2::after{
position: absolute;
left: 50%;
content: "";
width: 100px;
height: 2px;
background:#666;
bottom: -6px;
margin-left: -63px;
}
/*=============
Styles for Sections Common End
===============
*/	

/*=============
Styles for Feaures Section Starts
===============
*/	
.our-features .single-feature {
background: #fff;
margin-top: 30px;
text-align: center;
}
.our-features .feature-head {
position: relative;
overflow: hidden;
}
.our-features .single-feature img {
width: auto;
display: inline-block;
height:140px;
}
.our-features .single-feature h2 {
font-weight: 600;
font-size: 16px;
margin: 15px 0;
}
.our-features .single-feature p{
color:#666;
}
/*=============
Styles for Features section Ends
===============
*/	


/*=============
Styles for CTA Section Starts
===============
*/	
.cta{
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
.cta .cta-inner {
    padding: 60px;
    height:410px;
    width: 100%;
    background-color: var(--main-bg-color1);
    opacity: .9;
}
.cta .text-content {
    z-index: 3;
    position: relative;
}
.cta .cta-inner h2 {
	font-weight: 700;
    font-size: 30px;
    margin-bottom: 45px;
    color: #fff;
}
.cta .cta-inner p {
    font-size: 16px;
    color: #fff;
}
.cta .cta-inner .button {
    margin-top: 45px;
}
/*=============
Styles for CTA Section Starts
===============
*/	

/*=============================
Styles for Teachers section starts
===============================*/
.team {
	padding:60px 0 90px;
}
.team .team-button{
	padding-left: 20px;
	margin-top:45px;
}
.team .button .btn{
	color:#fff;
}
.team .button .btn:before{
	background:#252525;
}
.team .button .btn:hover{
	background:transparent;
	color:#fff;
}
.team .single-team {
	position: relative;
	margin-top: 30px;
	height:300px;
}
.team .single-team img{
	height:100%;
	width:100%;
	text-align:center;
}

.team .team-hover {
	background:var(--main-bg-color1);
	position: absolute;
	left: 10px;
	top: 10px;
	padding: 75px 20px;
	text-align: center;
	visibility: hidden;
	-webkit-transition: all 0.4s ease;
	-moz-transition: all 0.4s ease;
	transition: all 0.4s ease;
	-webkit-transform: scale(0.5);
	-moz-transform: scale(0.5);
	transform: scale(0.5);
	bottom: 10px;
	right: 10px;
}
.team .single-team:hover .team-hover,
.team .single-team.active .team-hover{
	transform:scale(1.0);
	opacity:.8;
	visibility:visible;
}
.team .team-hover h4 {
	color: #fff;
	font-size: 20px;
}
.team .team-hover h4 span {
	display: block;
	color: #fff;
	font-weight: 400;
	font-size: 14px;
	margin-top: 5px;
}
.team .team-hover p {
	color: #fff;
	margin: 20px 0;
}
.team .team-hover .social{
	padding-bottom:42px;
}
.team .team-hover .social li {
	display: inline-block;
	margin-right: 10px;
}
.team .team-hover .social li:last-child{
	margin:0;
}
.team .team-hover .social li a{
	color:#fff;
	font-size:14px;
}
.team .team-hover .social li a:hover{
	opacity:0.6;
}
/*=============
Styles for Teacher Section Ends
===============
*/	

/*=============
Styles for Testimonials Section Starts
===============
*/	
.tes {
    background-image: url(images/library.jpg);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.wp{
	padding-left:0;
	padding-right:0;
}
.pr{
	padding-right: 5px;
}
.pl{
	padding-left: 5px;
}
.testimonials .section-title h2,
.testimonials .section-title p{
	color:#fff;
}
.testimonials .single-testimonial {
	text-align: left;
	background: #fff;
	padding: 30px;
	position: relative;
	margin-top: 37px;
	box-shadow: inherit;
	border-radius: 10px;
}
.testimonials .single-testimonial img{
	position:absolute;
	left:50%;
	margin-left:-37px;
	top:-37px;
	height:80px;
	width:80px;
	border-radius:100%;
	border:5px solid #fff;
	transition: all .4s ease;
	-webkit-box-shadow:0px 0px 20px rgba(0, 0, 0, 0.12);
	-moz-box-shadow:0px 0px 20px rgba(0, 0, 0, 0.12);
	box-shadow:0px 0px 20px rgba(0, 0, 0, 0.12);
}
.testimonials .single-testimonial:hover img{
	-webkit-transform:rotate(360deg);
	-moz-transform:rotate(360deg);
	transform:rotate(360deg);
}
.testimonials .single-testimonial p {
	font-size: 14px;
	line-height: 1.5em;
	position: relative;
	z-index: 4;
	color:#666;
	text-align: left;
}
.testimonials .main-content {
	position: relative;
	z-index: 4;
	margin: 35px 0;
}
.testimonials .main-content:before,
.testimonials .main-content:after{
	position: absolute;
	font-family: 'FontAwesome';
	font-size: 32px;
	z-index: -4;
}
.testimonials .main-content::before {
	left: 0;
	top: -33px;
	content: "\f10d";
	color:var(--main-bg-color1);
}
.testimonials .main-content::after {
	right: 0;
	bottom: -33px;
	content: "\f10e";
	color:var(--main-bg-color1);
}
.testimonials .single-testimonial h4 {
	font-weight: 700;
	font-size: 20px;
	position: relative;
	margin-bottom: 15px;
}
/*=============
Styles for Testimonials Section Ends
===============
*/

/*=============================
	Styles for Events Section Starts
===============================*/
.events .single-event {
	margin-top: 30px;
	height: 420px;
	margin: 5px;
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	transition: all 0.3s ease;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
}

.events .single-event .head{
	position:relative;
}
.events .single-event .head img{
	width: 100%;
	height: 225px;
}
.events .single-event .head .btn {
	position: absolute;
	top: 50%;
	background-color:var(--main-bg-color1);
	left: 50%;
	width: 50px;
	height: 50px;
	line-height: 50px;
	border-radius: 100%;
	line-height: 50px;
	padding: 0;
	margin: -25px 0 0 -25px;
	color: #fff;
	transition: ;
	-webkit-transform: scale(3);
	-moz-transform: scale(3);
	transform: scale(3);
	opacity:0;
	visibility:hidden;
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	transition:all 0.3s ease;
	z-index:35;
}
.events .single-event:hover .head .btn{
	transform:scale(1);
	opacity:1;
	visibility:visible
}
.events .single-event .head .btn:hover{
	background:#fff;
	color:#252525;
}
.events .single-event .head.overlay:before{
	opacity:0;
	visibility:hidden;
	z-index:34;
}
.events .single-event:hover .head.overlay:before{
	opacity:0.5;
	visibility:visible;
}
.events .event-content {
	margin-top: 10px;
	padding: 20px;
}
.events .event-content .meta{}
.events .event-content .meta span,.news .blog-content .meta span {
	margin-right: 10px;
	padding-right: 10px;
	border-right: 1px solid #e6e6e6;
	font-weight: 500;
	display: inline-block;
}
.events .event-content .meta span:last-child,.news .blog-content .meta span:last-child {
	margin:0;
	padding:0;
	border:none;
}
.events .event-content .meta span i,.news .blog-content .meta span i {
	margin-right:5px;
	color:var(--main-bg-color1);
}
.events .event-content h4 {
	font-size: 18px;
	margin: 10px 0;
	line-height: 1.6em;
}
.events .event-content h4 a{
	color:#252525;
	font-weight:700;
}
.events .event-content h4 a:hover{
	color:var(--main-bg-color1);
	text-decoration: none;
}
.events .event-content p{}

.event-btn{
	transition: all .3s ease;
	border:2px solid var(--main-bg-color1);
}
.event-btn:hover{
		text-decoration: none;
}
/*=============
Styles for Events Section Ends
===============
*/


/*=============================
Styles for Fun Facts Section starts
===============================*/
.fun-facts{
	background:url('http://themelamp.com/html/learnedu/images/cta-bg.jpg');
	background-size:cover;
	background-repeat:no-repeat;
	background-position:center;
	position:relative;
	padding:100px 0 130px
}
.fun-facts::before {
	opacity: 0.9;
	background-color: var(--main-bg-color1);
}
.fun-facts .single-fact {
	text-align: center;
	margin-top: 30px;
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	transition:all 0.3s ease;
}
.fun-facts .single-fact:hover{
	-webkit-transform:translateY(-15px);
	-moz-transform:translateY(-15px);
	transform:translateY(-15px);
}
.fun-facts .single-fact i {
	font-size: 40px;
	color: #fff;
	margin-bottom: 30px;
}
.fun-facts .single-fact .number {
	color: #fff;
	font-weight: 700;
	font-size: 40px;
	margin-bottom: 15px;
	position: relative;
	display: block;
	-webkit-transition: all 0.4s ease;
	-moz-transition: all 0.4s ease;
	transition: all 0.4s eas;
}
.fun-facts .single-fact p {
	color: #eee;
	font-size: 15px;
}
/*=============================
	Styles for fun facts end
===============================*/



/*=============================
	Styles for Latest News STarts
===============================*/
.blog {
	background: #fff;
}
.blog .blog-slider{
	margin-top: 30px;
}
.blog .single-blog {
	position: relative;
	margin: 30px 0 0;
	height: 450px;
	background: #fff;
	-webkit-box-shadow:0px 0px 10px rgba(0, 0, 0, .12);
	-moz-box-shadow:0px 0px 10px rgba(0, 0, 0, 0.12);
	box-shadow:0px 0px 10px rgba(0, 0, 0, 0.12);
	margin:5px;
}
.blog .blog-head{
	overflow:hidden;
}
.blog .blog-head:before{
	z-index:35;
	opacity:0;
	visibility:hidden;
}
.blog .single-blog:hover .blog-head:before{
	opacity:0.5;
	visibility:visible;
}
.blog .single-blog img{
	width:100%;
	height: 225px;
	transition: all .3s ease;
}
.blog .single-blog:hover img{
	transform:scale(1.2) rotate(5deg);
}
.blog .blog-head .date {
	position: absolute;
	left: 12px;
	top: 12px;
	text-align: center;
	border-radius: 100%;
	width: 70px;
	height: 70px;
	line-height: 70px;
	z-index: 33;
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	transition:all 0.3s ease;
	-webkit-transform: scale(0);
	-moz-transform: scale(0);
	transform: scale(0);
	opacity:0;
	visibility:hidden;
	z-index:36;
}
.blog .single-blog:hover .date{
	transform: scale(1);
	opacity:1;
	background-color: var(--main-bg-color1);
	visibility:visible
}
.blog .blog-head .date h4 {
	font-size: 25px;
	font-weight: 600;
	color: #fff;
	line-height: 1.6em;
	padding-top: 4px;
}
.blog .blog-head .date h4 span {
	font-size: 15px;
	font-weight: 600;
	color: #fff;
	display: block;
}
.blog .blog-main {
	margin-top: 50px;
	background: #f6f6f6;
	position: relative;
}
.blog .blog-content {
	padding: 20px;
}
.blog .blog-content .blog-title {
	font-size: 18px;
	font-weight: 700;
	margin-bottom: 5px;
}
.blog .blog-content .blog-title a{
	color:#252525;
	transition: all .3s ease;
}
.blog .blog-content .blog-title a:hover{
color:var(--main-bg-color1);
text-decoration: none;
}

.news-readmore{
position: absolute;
bottom:10px;
text-transform: uppercase;	
}
.news-readmore:hover{
	text-decoration: none;
}
/*=============================
Styles for Latest News Section Ends
===============================*/



/*=============================
Styles for Footer Starts
===============================*/
footer{
	background-color: var(--main-bg-color1);
	padding:40px 0;
	color:#c5c5c5;
}
footer h3{
	font-weight: 700;
	margin-bottom: 15px;
}
footer a,footer a:active{
	color:#c5c5c5;
	display: inline-block;
	text-decoration: none;
}
footer a:hover{
	color:var(--main-bg-color2);
	text-decoration: none;
}
.col-20{
	width:20%;
	float: left;
}

@media screen and (max-width: 768px){
	.col-20{
		width: 100%;
		margin-bottom: 20px;
	}
}

#footer{
	padding:20px 0;
	background-color:#3b0505;
	color: #c5c5c5;
}
#footer a,#footer a:active{
	color:#c5c5c5;
	display: inline-block;
	padding:0 10px;
}
#footer a:hover{
	color:var(--main-bg-color2);
	text-decoration: none;
}
/*=============================
	STyle for  Footer End
===============================*/
</style>