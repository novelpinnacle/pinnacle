<style>
#myaccordian{

}
#myaccordian h3{
	font-size: 16px;
	background: var(--main-bg-color1);
	padding:10px;
	color:#fff;
	margin-top: 0;
	margin-bottom: 2px;
}
.border-round{
	border-radius: 5px;
}
.border-not-round{
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}
#myaccordian p{
	padding:20px 10px;
	margin:0;
	background: #e5e5e5;
}
#myaccordian h3:hover{
	cursor: pointer;
}
.faqcontent{
	transition: all .3s;
	max-height: 0;
	overflow: hidden;
	margin-bottom: 5px;
}
.showfaq{
	max-height: 20em;
}

</style>
<section class="breadcrumbs overlay">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2>Frequently Asked Questions</h2>
						<ul class="bread-list">
							<li><a href="index.html">Home<i class="fa fa-angle-right"></i></a></li>
							<li class="active"><a href="event-single.html">FAQs</a></li>
						</ul>
					</div>
				</div>
			</div>
</section>

<section class="section faqs">
<div class="container">

<div id="myaccordian">

<h3 class="border-round" id='qa' onclick="openContent('a',this)"> Question 1</h3>
<div id="a" class="faqcontent"><p>This is the answer</p></div>

<h3 class="border-round" onclick="openContent('b',this)"> Question 2</h3>
<div id="b" class="faqcontent"><p>This is the Second answer</p></div>

</div>
		
 </div>
</section>

<script>
	function openContent(id,ele){
		eles=document.querySelectorAll(".faqcontent");
		h3s=document.querySelectorAll("#myaccordian h3");
		for(i=0;i<eles.length;i++){
			eles[i].classList.remove("showfaq");
			h3s[i].classList.remove("border-not-round");
		}
		$("#"+id).addClass("showfaq");
		ele.classList.add("border-not-round");
	}
</script>