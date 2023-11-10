<style>
	
	.toprow {
		padding: 20px 0
	}

	img {
		display: block;
		max-width: 100%;
	}

	.why {
		margin-top: 50px;
		margin-bottom: 50px;
	}

	.why-image-wrapper {
		padding-top: 50px;
	}

	.detail-title {
		text-transform: uppercase;
		font-weight: 500;
		font-size: 15px;
		color: #03a9fc
	}

	.detail-value {
		color: #777;
		font-size: 14px;
	}

	.how-to-content {
		padding-top: 70px;
	}

	.how-to-steps {
		position: relative;
		padding: 25px;
		padding-left: 80px;
		box-shadow: 0 0 4px rgba(0, 0, 0, .25);
		margin-bottom: 20px;
	}

	.how-to-steps>div {
		position: absolute;
		top: 12px;
		left: 10px;
		width: 50px;
		height: 50px;
		display: flex;
		justify-content: center;
		align-items: center;
		box-shadow: 0 0 4px rgba(0, 0, 0, .25);
		border-radius: 100%;
	}

	.question {
		font-weight: 500;
	}

	.answer {
		padding-left: 10px;
	}


	.faqs,
	.syllabus {
		margin-top: 40px;
	}

	/* Avneesh css start */ 
	
	.p-0{padding: 0px !important;}
	.m-0{margin: 0px !important;}
	.fw-100{font-weight:100 !important}
	.fw-200{font-weight:200 !important}
	.fw-300{font-weight:300 !important}
	.fw-400{font-weight:400 !important}
	.fw-500{font-weight:500 !important}
	.fw-600{font-weight:600 !important}
	.fw-700{font-weight:700 !important}
	.fw-800{font-weight:800 !important}
	.fs-14{font-size:14px !important}
	.fs-15{font-size:15px !important}
	.fs-16{font-size:16px !important}
	.fs-17{font-size:17px !important}
	.fs-18{font-size:18px !important}
	.fs-19{font-size:19px !important}
	.fs-20{font-size:20px !important}
	.fs-21{font-size:21px !important}
	.fs-22{font-size:22px !important}
	.fs-23{font-size:23px !important}
	.fs-24{font-size:24px !important}
	
	.ptqe_info_section .page_banner_section .register_block {
		background: #7B1417;
		padding: 15px;
	}
	.ptqe_info_section .page_banner_section .register_block .reg_btn_box {
		max-width: 550px;
    	margin: 0 auto;
	}
	.text_color_1{
		color: #7B1417 !important;
	}
	.bg_01{
		background: #F4CF9E !important;
	}
	.bg_02{
		background: #6B0C0F !important;
	}
	.btn_01 {
		display:inline-block;
		background: #F2A23A;
		border: 1px solid #F2A23A;
		font-size: 20px;
		font-weight: 500;
		color: #fff;
		padding: 10px 25px;
		border-radius: 25px;
	}
	.btn_02 {
		display:inline-block;
		background: #6B0C0F;
		border: 1px solid #6B0C0F;
		font-size: 16px;
		font-weight: 500;
		color: #fff;
		padding: 5px 25px;
		border-radius: 25px;
	}
	.row.secondary{
		margin-top: 50px
	}
	.about_us_section{
		padding:50px 0 0 ;
	}
	.about_us_section .section_header h1{
		margin: 0;
		margin-bottom:5px;
		font-size:30px;
	}
	.about_us_section .section_subheader h4{
		margin: 0;
		margin-bottom:30px;
		font-size:15px;
	}
	.about_us_section .section_subheader p{
		margin-bottom: 0px;
		font-size: 12px;
    	text-align: left;
	}
	.about_us_section .desc_block {
		padding: 30px 0;
	}
	.about_us_section .desc_block .row+.row {
		margin-top: 20px;
	}
	.about_us_section .desc_block .info_block{
		border: 2px solid #F4CF9E;
		border-radius: 35px;
		min-height: 110px;
		padding: 25px 10px 10px 55px;
		margin: 5px 0;
	}
	.about_us_section .desc_block .info_block .img_box{
		max-width:55px
	}
	.about_us_section .desc_block .info_block .info{
		flex: 1 1 auto;
    	padding-left: 30px;
	}
	.about_us_section .desc_block .info_block .info span{
		display: block;
		font-size: 10px
	}
	.about_us_section .desc_block .info_block .info span+span{
		line-height: 1.2;
	}
	.talent_enc_block{
		padding: 40px;
	}
	.talent_enc_block .img_box{
		border: 5px solid #7b1517;
    	border-radius: 10px;
		max-width: 450px;
	}
	.talent_enc_block .tal_about_box{
		max-width: 400px;
		margin: auto;
	}
	.talent_enc_block .title h2{
		font-size: 28px;
		line-height: 1.4
	}
	.talent_enc_block .subtitle{
		line-height: 1.2;
		font-size: 12px;
		margin-top: 40px;
    	margin-bottom: 50px;
	}
	.talent_enc_block .link{
		font-size: 12px;
		margin-top: 50px;
	}
	.ptqe_syllabus_section{
		padding: 50px 0;
	}
	.ptqe_syllabus_section .ptqe_sp_block{
		flex-wrap: wrap;
    	justify-content: space-around;
		margin-top: 20px;
		margin-bottom: 40px;
	}
	.ptqe_syllabus_section .ptqe_sp_box{
		min-width: 160px;
		text-align: center;
		border-radius: 25px;
		padding: 5px;
		margin-top: 20px;
	}
	.ptqe_syllabus_section .ptqe_sp_box.dark{
		border: 1px solid #f4cf9e;
	}
	.ptqe_syllabus_section .ptqe_sp_box.light{
		border: 1px solid #b84f53;
	}
	.ptqe_syllabus_section .ptqe_sp_box .ptqe_sp_inner{
		border-radius: 25px;
		padding-bottom: 10px;
	}
	.ptqe_syllabus_section .ptqe_sp_box.dark .ptqe_sp_inner{
		background: #b84f53;
		color: #fff;
	}
	.ptqe_syllabus_section .ptqe_sp_box.light .ptqe_sp_inner{
		background: #f4cf9e;
		color: #000;
	}
	.ptqe_syllabus_section .ptqe_sp_inner .img_box{
		padding-top: 20px;
    	padding-bottom: 10px;
	}
	.ptqe_syllabus_section .img_box img{
		margin: auto
	}
	.ptqe_syllabus_section .desc_box p{
		font-weight: bold;
		margin-bottom: 5px;
		line-height: 1.1;
	}
	.ptqe_syllabus_section .smp_box{
		background: url(https://pinnacloeducare.com/images/ptqe-2023/sample_paper_bg.png) center/100% 100% no-repeat;
		min-height: 110px;
		display: flex;
		align-items: center;
		padding: 15px;
	}
	.ptqe_syllabus_section .smp_box .desc_box{
		padding-left: 20px;
    	padding-right: 20px;
	}
	.ptqe_syllabus_section .smp_box .desc_box p.title{
		font-size: 16px;
    	margin-bottom: 10px;
	}
	.ptqe_syllabus_section .smp_box .desc_box p.sub{
		color: #b84f53;
    	font-size: 12px;
	}
	.ptqe_syllabus_section .smp_box .desc_box a.sub{
		color: #b84f53;
    	font-size: 12px;
    	font-weight: bold;
	}
	.ptqe_syllabus_section .smp_box .img_box2{
		margin-left: 15px;
	}
	.why_ptqe_section{
		padding: 50px 0 ;
	}
	.why_ptqe_section .why_ptqe{
		justify-content: space-around;
		margin-top: 30px;
	}
	.why_ptqe_section .why_ptqe_box{
		background: url(http://localhost:8888/yuvika/images/ptqe-2023/why_ptqe_bg.png) center/contain no-repeat;
		height: 300px;
		width: 300px;
		padding: 25px;
	}
	.why_ptqe_section .why_ptqe_box .title{
		margin-top: 10px;
    	padding-left: 10px;
	}
	.why_ptqe_section .why_ptqe_box .desc{
		margin-top: 20px;
		padding-left: 10px;
		line-height: 1;
		font-size: 12px;
	}
	.ptqe_reg_section{
		padding: 20px 0;
	}
	.ptqe_reg_section .ptqe_reg_block .info h3{
		font-size: 18px;
		margin:0;
	}
	.ptqe_reg_section .ptqe_reg_block .sub{
		display: block;
		font-size: 12px;
		font-weight: 600;
		line-height: 1.2;
		margin-top: 10px;
		max-width:380px;
	}
	.ptqe_reg_section .on_off_reg_block .bar_header {
		position: relative;
		margin: 30px 0 20px;
	}
	.ptqe_reg_section .on_off_reg_block  .bar_header span{
		display: inline-block;
	}
	.ptqe_reg_section .on_off_reg_block  .bar_header span.img_box{
		position: absolute;
		width: 60px;
		height: 60px;
		top: -10px;
	}
	.ptqe_reg_section .on_off_reg_block  .bar_header span.img_box img{
		position:absolute
	}
	.ptqe_reg_section .on_off_reg_block  .bar_header span:not(.img_box){
		height: 40px;
		background: #f5c07a;
		min-width: 220px;
		border-radius: 25px;
		padding-top: 8px;
		padding-left: 50px;
		font-weight: 800;
		position: relative;
		z-index: -1;
		left: 25px;
	}
	.ptqe_reg_section .on_off_reg_block .desc{
		margin-left: 15px;
    	font-size: 13px;
	}
	/* .ptqe_imp_dates_section .ptqe_imp_dates{
		padding: 5px;
		border-radius: 25px;
	} */
	.ptqe_imp_dates_section .section_header{
		margin-top: 30px;
	}
	.ptqe_imp_dates_section .ptqe_imp_dates {
		margin: 30px 0 50px;
	}
	.ptqe_imp_dates_section .ptqe_imp_dates .row{
		padding: 5px;
		border-radius: 25px;
	}
	.ptqe_imp_dates_section .ptqe_imp_dates .row + .row{
		margin-top: 20px !important;
	}
	.ptqe_imp_dates_section .imp_dates_box{
		background: #ffffff;
		padding: 5px 60px;
    	border-radius: 25px;
		height: 100px
	}
	.ptqe_imp_dates_section .imp_dates_box .title{
		margin-top: 10px;
	}
	.ptqe_imp_dates_section .ml{
		margin-left: 40px;
	}
	.ptqe_imp_dates_section .mr{
		margin-right: 40px;
	}
	.ptqe_imp_dates_section .imp_dates_box .img_box{
		display: inline-block;
		max-width: 80px;
    	margin-right: 40px;
	}
	.ptqe_winners_section .ptqe_winners_box .img_box{
		width:200px;
		height:200px;
		border-radius: 50%;
		position:relative;
		overflow: hidden;
		margin: auto;
	}
	.ptqe_winners_section .ptqe_winners_box .winners_img{
		width: 170px;
		height: 170px;
		border-radius: 50%;
		position: relative;
		overflow: hidden;
		margin: auto;
		margin-top: 15px;
	}
	.ptqe_winners_section .ptqe_winners_box .img_box .box_frame{
		position:absolute;
	}
	.ptqe_winners_section .ptqe_winners_box .img_box img:not(.box_frame){
		width:100%;
		object-fit: cover;
		object-position: center;
   		height: 100%;
	}
	.ptqe_winners_section .ptqe_sp_inner .desc_box{
		margin-top: 10px;
	}
	.ptqe_testinomial_section{
		padding:50px 0;
	}
	.ptqe_testinomial_section .subheader {
		color: #6b0c0f;
		font-size: 30px;
		font-weight: 500;
		margin: 20px 0 40px;
	}
	.ptqe_testinomial_section .testinomial_right {
		padding: 20px;
	}
	.ptqe_testinomial_section .testinomial_right .right_box{
		position: relative;
		z-index: 0;
		padding:10px;
		min-height: 400px;
	}
	.ptqe_testinomial_section .testinomial_right .right_box::before {
		content: "";
		background: url("<?= base_url() ?>images/ptqe-2023/testinomial_bg.png") center/100% 100%  no-repeat;
		position: absolute;
		width: calc(100%);
		height: calc(100%);
		z-index: -1;
		top: 0px;
		left: 0px;
	}

	.ptqe_testinomial_section .testinomial_right .start_box{
		max-width: 60px;
	}
	
	.ptqe_testinomial_section .testinomial_right .usrs_img{
		width: 100px;
		height: 100px;
		border-radius: 50%;
		position: relative;
		overflow: hidden;
		margin: auto;
		margin-top: 15px;
	}
	.ptqe_testinomial_section .testinomial_right .usrs_img img{
		width:100%;
		object-fit: cover;
		object-position: center;
   		height: 100%;
	}
	.ptqe_testinomial_section .testinomial_right .usrs_block .desc_box {
		margin-left: 15px;
	}
	.ptqe_testinomial_section .testinomial_right .comments_box,
	.ptqe_testinomial_section .testinomial_right .usrs_block .desc_box {
		font-size: 17px;
	}
	.ptqe_testinomial_section .testinomial_right .usrs_block .desc_box p:last-child {
		color: #ffffff;
		font-weight: 500;
	}im
	.ptqe_testinomial_section .testinomial_right .usrs_block .desc_box p > span {
		padding: 4px 10px;
		border-radius: 5px;
	}

	.d-flex {
			display: -ms-flexbox!important;
			display: flex!important;
			flex-wrap: wrap;
		}
		.flex-fill {
			flex: 1 1 auto
		}
		.align-items-center{
			-ms-flex-align: center!important;
			align-items: center!important;
		}
		.align-items-start{
			-ms-flex-align: center!important;
			align-items: start!important;
		}
	
	@media only screen and (min-width:768px){
		
		.ptqe_testinomial_section .testinomial_right {
			max-width: 50%;
		}
	}
	@media only screen and (min-width:1200px){
		.about_us_section .desc_block .info_block .info {max-width: 230px;}
	}
	@media only screen and (min-width:768px) and (max-width: 1199px){
		.about_us_section .desc_block .info_block .info {max-width: 160px;}
		.about_us_section .desc_block .info_block{min-height:148px;}
	}
	@media only screen and (max-width: 991px){
		.ptqe_imp_dates_section .ptqe_imp_dates .imp_dates_box.even{
			margin-top: 20px;
		}
		.ptqe_testinomial_section .testinomial_left{
			display: none;
		}
		.ptqe_testinomial_section .testinomial_right{
			max-width: 100%;
		}
		.about_us_section .desc_block .info_block .info {max-width: 480px;}
		
	}
	/* Avneesh css emd */
</style>


<div class="container-fluid p-0">
	<div class="ptqe_info_section">
		<section class="page_banner_section">
			<div class="banner_block">
				<div class="banner_img">
					<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/ptqe_banner.png" alt="img">
				</div>
			</div>
			<div class="register_block text-center">
				<div class="reg_btn_box text-left">
				<a href="<?= base_url() ?>ptqe" class="tex-center btn_01"> Register Now <i class="fa fa-angle-double-right fw-800"></i></a>
				</div>
				
			</div>
		</section>
		<section class="about_us_section container">
			<div class="section_header text-center">
				<h1 class=" fw-800 ">About PTQE 2023</h1>
			</div>
			<div class="section_subheader text-center">
				<h4 class="fw-800 text_color_1">Exam Date : 2nd October 2022</h4>
				<p>PTQE brings an amazing opportunity for the young talents to pave their way towards an illustrious & bright career. This test will equip students with the Pinnacle advantage that will allow them to explore their intrinsic potential and open doors to a world of competitive & scholastic exams.</p>
			</div>
			<div class="desc_block">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-4">
						<div class="info_block d-flex align-items-start">
							<div class="img_box">
								<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/calender.png" alt="img">
							</div>
							<div class="info">
								<span class="fs-14 fw-800">Exam Date</span>
								<span class="">Offline: 2nd October, 2022</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-4">
						<div class="info_block d-flex align-items-start">
							<div class="img_box">
								<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/notes.png" alt="img">
							</div>
							<div class="info">
								<span class="fs-14 fw-800">Exam Conduction Process</span>
								<span class="">PTQE 2023 will be conducted in Offline mode only.</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-4">
						<div class="info_block d-flex align-items-start">
							<div class="img_box">
								<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/reminder.png" alt="img">
							</div>
							<div class="info">
								<span class="fs-14 fw-800">Exam Result</span>
								<span class="">Result will be declared on 21st October 2022 (It will be declared on www.pinnacloeducare. com and will also be shared by SMS at applicant's registered Mobile No.)</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-4">
						<div class="info_block d-flex align-items-start">
							<div class="img_box">
								<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/schlorship.png" alt="img">
							</div>
							<div class="info">
								<span class="fs-14 fw-800">Get Up to 100%* Scholarship</span>
								<span class="">On our Classroom courses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-4">
						<div class="info_block d-flex align-items-start">
							<div class="img_box">
								<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/prizes.png" alt="img">
							</div>
							<div class="info">
								<span class="fs-14 fw-800">Win Exciting Prizes</span>
								<span class="">Lucky winners will win many expensive prizes & gifts</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-4">
						<div class="info_block d-flex align-items-start">
							<div class="img_box">
								<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/cash.png" alt="img">
							</div>
							<div class="info">
								<span class="fs-14 fw-800">Cash Awards</span>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="ptqe_imp_dates_section bg_01">
			
			<div class="ptqe_imp_dates_block container">
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">IMPORTANT DATES</h2>
						</div>
					</div>
				</div>
				<div class="ptqe_imp_dates">
					<div class="row bg_02 m-0">
						<div class="col-12 col-sm-12 col-md-5  p-0">
							<div class="imp_dates_box odd d-flex align-items-center">
								<div class="img_box">
									<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/online_start.png" alt="img">
								</div>
								<div class="">
								<div class="title fw-800">
									<span>31<sup>st</sup> Aug, 2022</span>
								</div>
								<div class="desc">
									<p>Online Registration Starts</p>
								</div>
								</div>
							</div>
						</div>
						<div class="col-12  col-sm-12 col-md-5 col-md-offset-2 p-0">
							<div class="imp_dates_box even d-flex align-items-center">
								<div class="img_box">
									<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/online_start.png" alt="img">
								</div>
								<div class="">
								<div class="title fw-800">
									<span>10<sup>th</sup> Oct, 2022</span>
								</div>
								<div class="desc">
									<p>Last Registration Date</p>
								</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row bg_02 m-0">
						<div class="col-12  col-sm-12 col-md-5  p-0">
							<div class="imp_dates_box odd d-flex align-items-center">
								<div class="img_box">
									<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/stage_1.png" alt="img">
								</div>
								<div class="">
								<div class="title fw-800">
									<span>2<sup>nd</sup>, 16<sup>th</sup> Oct, 2022</span>
								</div>
								<div class="desc">
									<p>Exam Date Stage-1</p>
								</div>
								</div>
							</div>
						</div>
						<div class="col-12  col-sm-12 col-md-5 col-md-offset-2 p-0">
							<div class="imp_dates_box even d-flex align-items-center">
								<div class="img_box">
									<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/result_1.png" alt="img">
								</div>
								<div class="">
								<div class="title fw-800">
									<span>21<sup>st</sup> Oct, 2022</span>
								</div>
								<div class="desc">
									<p>Result Stage-1 (till 5 PM)</p>
								</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row bg_02 m-0">
						<div class="col-12  col-sm-12 col-md-5  p-0">
							<div class="imp_dates_box odd d-flex align-items-center">
								<div class="img_box">
									<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/stage_2.png" alt="img">
								</div>
								<div class="">
								<div class="title fw-800">
									<span>30<sup>th</sup> Oct, 2022</span>
								</div>
								<div class="desc">
									<p>Exam Date Stage-2</p>
								</div>
								</div>
							</div>
						</div>
						<div class="col-12  col-sm-12 col-md-5 col-md-offset-2 p-0">
							<div class="imp_dates_box even d-flex align-items-center">
								<div class="img_box">
									<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/result_2.png" alt="img">
								</div>
								<div class="">
									<div class="title fw-800">
										<span>6<sup>th</sup> Nov, 2022</span>
									</div>
									<div class="desc">
										<p>Result Stage-2</p>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
				</div>
				
				
			</div>
		</section>

		<section class="ptqe_reg_section ">
			
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">REGISTRATION PROCESS</h2>
						</div>
					</div>
				</div>
				<div class="ptqe_reg_block">
					<div class="row">
						<div class="col-12 col-sm-6">
							<div class="info">
								<h3 class="fw-800">How to Register</h3>
								<span class="sub">Take the first step for your better future by registering for PTQE (Pinnacle Talent Quest Exam)</span>
								<div class="on_off_reg_block">
									<div class="bar_header">
									<span class="img_box"><img src="<?= base_url() ?>images/ptqe-2023/online.png" alt=""></span>
										<span>Online Registration</span>
									</div>
									<div class="desc">
										<p class="m-0">1. Choose the register button among the dropdown list of PTQE-2023 </p>
										<p class="m-0">2. Fil in the personal details in the registration form and submit the form. </p>
										<p class="m-0">3. Make the payment using the preferred mode of payment. </p>
										<p class="m-0">4. Get your Admit Card for PTQE Stage-1 & take the printout of it while appearing in exam. </p>
									</div>
								</div>
								<div class="on_off_reg_block">
								<div class="bar_header">
									<span class="img_box"><img src="<?= base_url() ?>images/ptqe-2023/offline.png" alt=""></span>
									
									<span>Offline Registration</span>
								</div>
									<div class="desc">
										<p class="m-0">Purchase form from your school if it has agreed for PTQE 2023 registration, fill in and deposit at your school or you can visit Pinnacle Educare Institute, Sangrur for offline registration.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="img_box">
							<img src="<?= base_url() ?>images/ptqe-2023/reg_img.png" alt="">
							</div>
						</div>
					</div>
					
				</div>
				
				
			</div>
		</section>
		
		<section class="talent_enc_section bg_01">
			
			<div class="talent_enc_block container">
				<div class="row">
					<div class="col-12 col-sm-6">
						<div class="img_box">
							<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/award.png" alt="img">
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="tal_about_box">
							<div class="title">
								<h2 class="fw-800 fs-24">Pinnacle Talent Recognition & Reward Exam</h2>
							</div>
							<div class="subtitle">
								<p>With the noble cause of nurturing young talents by Pinnacle team, this exam has gained very high importance among the students. PTQE is conducted in two stages to analyse the conceptual, analytical & intuitive thinking type ability with Artificial Intelligence enabled tools. Inclusion of Logical & Mathematical puzzle-based questions makes it unique among all the Olympiads.</p>
							</div>
							<div class="link">
								<a href="<?= base_url() ?>" class="tex-center btn_01 bg_02 fs-18"> Know About Us <i class="fa fa-angle-double-right fw-800"></i></a>
							</div>
						</div>
					</div>
					
				</div>
				
			</div>
		</section>

		<section class="ptqe_syllabus_section">
		
			<div class="ptqe_syllabus_block container">
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">PTQE Syllabus & Pattern</h2>
						</div>
					</div>
					<div class="col-12">
						<div class="ptqe_sp_block d-flex align-items-center">
							<div  class="ptqe_sp_box dark">
								<div class="ptqe_sp_inner">
									<div class="img_box">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/books.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="">Class V</p>
										<a class="downloadlink" href="<?=base_url()?>images/ptqe-2023/5th_syllabus.pdf">Syllabus & Pattern</a>
									</div>
								</div>
							</div>
							<div class="ptqe_sp_box light">
								<div class="ptqe_sp_inner">
									<div class="img_box">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/books.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="">Class VI</p>
										<a class="downloadlink" href="<?=base_url()?>images/ptqe-2023/6th_syllabus.pdf">Syllabus & Pattern</a>
									</div>
								</div>
							</div>
							<div class="ptqe_sp_box dark">
								<div class="ptqe_sp_inner">
									<div class="img_box">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/books.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="">Class VII</p>
										<a class="downloadlink" href="<?=base_url()?>images/ptqe-2023/7th_syllabus.pdf">Syllabus & Pattern</a>
									</div>
								</div>
							</div>
							<div class="ptqe_sp_box light">
								<div class="ptqe_sp_inner">
									<div class="img_box">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/books.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="">Class VIII</p>
										<a class="downloadlink" href="<?=base_url()?>images/ptqe-2023/8th_syllabus.pdf">Syllabus & Pattern</a>
									</div>
								</div>
							</div>
							<div class="ptqe_sp_box dark">
								<div class="ptqe_sp_inner">
									<div class="img_box">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/books.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="">Class IX</p>
										<a class="downloadlink" href="<?=base_url()?>images/ptqe-2023/9th_syllabus.pdf">Syllabus & Pattern</a>
									</div>
								</div>
							</div>
							<div class="ptqe_sp_box light">
								<div class="ptqe_sp_inner">
									<div class="img_box">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/books.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="">Class X</p>
										<a class="downloadlink" href="<?=base_url()?>images/ptqe-2023/10th_syllabus.pdf">Syllabus & Pattern</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">PTQE stage-1 Sample Papers</h2>
						</div>
					</div>
					<div class="col-12">
						<div class="row">
							<div class="col-6 col-sm-6 col-md-4">
									<div class="smp_box">
										<div class="img_box1">
											<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
										</div>
										<div class="desc_box">
											<p class="title">Class VI</p>
											<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_6th.pdf">Sample Paper</a>
										</div>
										<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_6th.pdf">
											<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
										</a>
									</div>
									
							</div>
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class VII</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_7th.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_7th.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class VIII</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_8th.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_8th.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
						</div>
						<div class="row secondary">
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class IX</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_9th.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_9th.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class X</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_10th.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_10th.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class XI M</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thM.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thM.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
						</div>
						<div class="row secondary">
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class XI NM</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thNM.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thNM.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">PTQE stage-2 Sample Papers</h2>
						</div>
					</div>
					<div class="col-12">
						<div class="row">
							<div class="col-6 col-sm-6 col-md-4">
									<div class="smp_box">
										<div class="img_box1">
											<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
										</div>
										<div class="desc_box">
											<p class="title">Class VI</p>
											<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_6thstage2.pdf">Sample Paper</a>
										</div>
										<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_6thstage2.pdf">
											<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
										</a>
									</div>
									
							</div>
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class VII</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_7thstage2.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_7thstage2.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class VIII</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_8thstage2.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_8thstage2.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
						</div>
						<div class="row secondary">
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class IX</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_9thstage2.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_9thstage2.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class X</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_10thstage2.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_10thstage2.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
<!--							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class XI M</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thMstage2.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thMstage2.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
-->
						</div>
<!--
						<div class="row secondary">
							<div class="col-6 col-sm-6 col-md-4">
								<div class="smp_box">
									<div class="img_box1">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/paperboard.png" alt="img">
									</div>
									<div class="desc_box">
										<p class="title">Class XI NM</p>
										<a class="sub downloadlink" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thNMstage2.pdf">Sample Paper</a>
									</div>
									<a class="img_box1" href="<?=base_url()?>images/ptqe-2024/SamplePaper_11thNMstage2.pdf">
										<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2024/download.png" alt="img">
									</a>
								</div>
							</div>
						</div>
-->
					</div>
				</div>
				
			</div>
		</section>
		<section class="why_ptqe_section bg_01">
			
			<div class="why_ptqe_block container">
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">Why PTQE is Different ? ...</h2>
						</div>
					</div>
				</div>
				<div class="why_ptqe d-flex align-items-center">
					<div class="why_ptqe_box">
						<div class="img_box">
							<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/milestone.png" alt="img">
						</div>
						<div class="title fw-800">
							<span>Pinnacle</span>
						</div>
						<div class="desc">
							<p>
							PTQE is the initial step for career aspirants to reach at Pinnacle of their set goals. In essence, it pioneers them on the path of achieving their targeted goals and to an illustrious & bright career. Our Institute has the ability to raise Students’ potential manifold.
							</p>
						</div>
					</div>
					<div class="why_ptqe_box">
						<div class="img_box">
							<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/trust.png" alt="img">
						</div>
						<div class="title fw-800">
							<span>SWOT Analysis</span>
						</div>
						<div class="desc">
							<p>
							PTQE question papers are designed meticulously taken in consideration the scientifically & analytically driven parameters for the real assessment of the young minds. The in-depth analysis of performance enables the student to know the scope for improvement & evaluate the Analytical Skills required for success in various other careers & life.
							</p>
						</div>
					</div>
					<div class="why_ptqe_box">
						<div class="img_box">
							<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/competitive.png" alt="img">
						</div>
						<div class="title fw-800">
							<span>Career Guidance</span>
						</div>
						<div class="desc">
							<p>
							Performance in PTQE determines the academic potential for Success in respective forthcoming higher Competitive Exams. Thus, students can confidently choose the career path looking at their forte & improve themselves in the weak areas essential for success in future.
							</p>
						</div>
					</div>
				</div>
				
				
			</div>
		</section>
		<section class="ptqe_winners_section">
		
			<div class="ptqe_winners_block container">
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">PTQE Winners 2021</h2>
						</div>
					</div>
					<div class="col-12">
						<div class="ptqe_winners d-flex align-items-center">
						<div class="owl-carousel winners_owl_carousel">
							<!-- winners box start -->
							<div>
								<div  class="ptqe_winners_box dark">
									<div class="ptqe_sp_inner">
										<div class="img_box">
											<img class="box_frame" src="<?= base_url() ?>images/ptqe-2023/winners_frame.png" alt="img">
											<div class="winners_img">
												<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/bharti.png" alt="img">
											</div>
										</div>
										<div class="desc_box text-center">
											<p class="m-0"><b>Bharti Garg</b></p>
											<p class="m-0">Class: 10th, Rank 1</p>
										</div>
									</div>
								</div>
							</div>
							<!-- winners box end -->
							<!-- winners box start -->
							<div>
								<div  class="ptqe_winners_box dark">
									<div class="ptqe_sp_inner">
										<div class="img_box">
											<img class="box_frame" src="<?= base_url() ?>images/ptqe-2023/winners_frame.png" alt="img">
											<div class="winners_img">
												<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/vrishti.png" alt="img">
											</div>
										</div>
										<div class="desc_box text-center">
											<p class="m-0"><b>Vrishti Mittal</b></p>
											<p class="m-0">Class: 9th, Rank 1</p>
										</div>
									</div>
								</div>
							</div>
							<!-- winners box end -->
							<!-- winners box start -->
							<div>
								<div  class="ptqe_winners_box dark">
									<div class="ptqe_sp_inner">
										<div class="img_box">
											<img class="box_frame" src="<?= base_url() ?>images/ptqe-2023/winners_frame.png" alt="img">
											<div class="winners_img">
												<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/pulkit.png" alt="img">
											</div>
										</div>
										<div class="desc_box text-center">
											<p class="m-0"><b>Pulkit Kansal</b></p>
											<p class="m-0">Class: 8th, Rank 2</p>
										</div>
									</div>
								</div>
							</div>
							<!-- winners box end -->
							<!-- winners box start -->
							<div>
								<div  class="ptqe_winners_box dark">
									<div class="ptqe_sp_inner">
										<div class="img_box">
											<img class="box_frame" src="<?= base_url() ?>images/ptqe-2023/winners_frame.png" alt="img">
											<div class="winners_img">
												<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/pranavi_1.png" alt="img">
											</div>
										</div>
										<div class="desc_box text-center">
											<p class="m-0"><b>Pranavi</b></p>
											<p class="m-0">Class: 9th, Rank 2</p>
										</div>
									</div>
								</div>
							</div>
							<!-- winners box end -->
							
							
						</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="ptqe_testinomial_section bg_01">
		
			<div class="ptqe_testinomial_block container">
				<div class="row">
					<div class="col-12">
						<div class="section_header text-center">
							<h2 class=" fw-800 ">TESTIMONIAL</h2>
							<p class="subheader">What Our Student Says</p>
						</div>
					</div>
					<div class="col-12">
						<div class="ptqe_testinomial">
							<div class="d-flex align-items-center justify-content-center">
								<div class="testinomial_left flex-fill ">
										<div class="img-box">
											<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/testinomial_left.png" alt="img">
										</div>
								</div>
								<div class="testinomial_right flex-fill ">
										<div class="owl-carousel testinomial_owl_carousel">
											<!-- testinomial carousal start -->
											<div class="right_box">
												<div class="img-box start_box">
													<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/testinomial_start.png" alt="img">
												</div>
												<div class="comments_box">
													<p>All Students having different academic potential get equal opportunity & guidance at Pinnacle. By scoring a single digit rank in PTQE, I realised my academic potential, which boosted my confidence in me. I highly recommend PTQE to all my fellow juniors for identification of their forte.</p>
												</div>
												<div class="usrs_block d-flex align-items-center">
													<div class="usrs_img">
													
														<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/tanish.png" alt="img">
													</div>
													<div class="desc_box text-left flex-fill">
														<p class="m-0"><b>Tanish Chugh</b></p>
														<p class="m-0"><span class="bg_02">Studying in IIT BHU</span></p>
													</div>
												</div>
											</div>
											<!-- testinomial carousal end -->
											<!-- testinomial carousal start -->
											<div class="right_box">
												<div class="img-box start_box">
													<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/testinomial_start.png" alt="img">
												</div>
												<div class="comments_box">
													<p>I give the major credit of the journey traversed from average performer to IIT to the PTQE which gave me morale boost at the competitive platform to excel in life</p>
												</div>
												<div class="usrs_block d-flex align-items-center">
													<div class="usrs_img">
														<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/savneet.png" alt="img">
													</div>
													<div class="desc_box text-left flex-fill">
														<p class="m-0"><b>Savneet Kaur</b></p>
														<p class="m-0"><span class="bg_02">Studying in IIT Jammu</span></p>
													</div>
												</div>
											</div>
											<!-- testinomial carousal end -->
											<!-- testinomial carousal start -->
											<div class="right_box">
												<div class="img-box start_box">
													<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/testinomial_start.png" alt="img">
												</div>
												<div class="comments_box">
													<p>PTQE’s analysis report initiated my journey & made me realize my strengths & weaknesses to work on for achieving my dream of being a Doctor. I am thankful to my mentors for guiding me on the path of success.</p>
												</div>
												<div class="usrs_block d-flex align-items-center">
													<div class="usrs_img">
														<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/arshdeep.png" alt="img">
													</div>
													<div class="desc_box text-left flex-fill">
														<p class="m-0"><b>Arshdeep</b></p>
														<p class="m-0"><span class="bg_02">Studying in GMC Patiala</span></p>
													</div>
												</div>
											</div>
											<!-- testinomial carousal end -->
											<!-- testinomial carousal start -->
											<div class="right_box">
												<div class="img-box start_box">
													<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/testinomial_start.png" alt="img">
												</div>
												<div class="comments_box">
													<p>PTQE motivated me for achieving great heights in life. After getting the rewards in PTQE, my competitive spirit got enhanced & I started taking keen interest in preparation of Advance Olympiads to prove my mettle at National level.</p>
												</div>
												<div class="usrs_block d-flex align-items-center">
													<div class="usrs_img">
														<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/pratham.png" alt="img">
													</div>
													<div class="desc_box text-left flex-fill">
														<p class="m-0"><b>Pratham Garg</b></p>
														<p class="m-0"><span class="bg_02">Studying in class 10th</span></p>
													</div>
												</div>
											</div>
											<!-- testinomial carousal end -->
											<!-- testinomial carousal start -->
											<div class="right_box">
												<div class="img-box start_box">
													<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/testinomial_start.png" alt="img">
												</div>
												<div class="comments_box">
													<p>Scoring the top position in PTQE has provided me immense confidence & motivation of preparing for the prestigious exam JEE Advanced.</p>
												</div>
												<div class="usrs_block d-flex align-items-center">
													<div class="usrs_img">
														<img class="img-responsive" src="<?= base_url() ?>images/ptqe-2023/pranavi.png" alt="img">
													</div>
													<div class="desc_box text-left flex-fill">
														<p class="m-0"><b>Pranavi</b></p>
														<p class="m-0"><span class="bg_02">Studying in Class 10<sup>th</sup></span></p>
													</div>
												</div>
											</div>
											<!-- testinomial carousal end -->
											
										</div>
										
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<script>
	$(document).ready(function(){
		$(".winners_owl_carousel").owlCarousel({
			loop:true,
			margin:10,
			responsiveClass:true,
			responsive:{
				0:{
					items:1,
					nav:true,
				},
				768:{
					items:3,
					nav:true,
				},
				1119:{
					items:4,
					nav:true,
					loop:true,
				}
			}
		});
		$(".testinomial_owl_carousel").owlCarousel({
			loop:true,
			margin:0,
			responsiveClass:true,
			items:1,
			nav:true,
			0:{
				items:1,
				nav:true,
			},
			
		});
	});
</script>

<!-- <div class="container">

	<div class="section-title syllabus">
		<h2>About PTQE</h2>
	</div>


	<div class="row toprow">
		<div class="col-sm-6 wp">
			<div>
				<img src="<?= base_url() ?>images/ptqe-2021/top-left.png">
			</div>
		</div>
		<div class="col-sm-6 wp">
			<div>
				<img src="<?= base_url() ?>images/ptqe-2021/top-right.PNG">
			</div>
		</div>
	</div>

	<p>Pinnacle Talent Quest Exam (PTQE) is the Talent recognition, reward &amp; encouragement
		exam with the purpose of helping the students to initiate them towards their goal of
		becoming a doctor or an engineer by providing them with an opportunity to get up to 100%
		scholarship and career guidance of experts. PTQE helps students to know their strengths
		and weaknesses to work on, for achieving the desired results as per the current educational
		standards. Analysis report of PTQE helps the student in identifying the academic strength
		using Artificial Intelligence tools.</p>

	<div class="row why">
		<div class="col-sm-6 wp">
			<div class="why-image-wrapper">
				<img src="<?= base_url() ?>images/ptqe-2021/why-ptqe.png">
			</div>
		</div>
		<div class="col-sm-6 wp">
			<h1>Details of PTQE 2022</h1>
			<div class="detail-title">Eligibility</div>
			<div class="detail-value">Class VII, VIII, IX, X Studying Students</div>
			<div class="detail-title">Exam Fees</div>
			<div class="detail-value">Rs 200 (Including all Taxes)</div>
			<div class="detail-title">Exam Date</div>
			<div class="detail-value">Stage-1:29th August &amp; 26th September, 2022 (Online)</div>
			<div class="detail-value">Stage-2 10th October</div>
			<div class="detail-title">Exam Timings</div>
			<div class="detail-value">11:00 AM to 12:30 PM</div>

		</div>
	</div>
	<div id="how-to-register" style="position: relative;top:-100px"></div>
	<div class="section-title">
		<h2>How to register</h2>
	</div>
	<div class="row">
		<div class="col-sm-6 wp pr">
			<div>
				<p>Take the first step for your better future by registering for PTQE (Pinnacle Talent Quest Exam)</p>
				<img src="<?= base_url() ?>images/ptqe-2021/female-student.jpg">
			</div>
		</div>
		<div class="col-sm-6 wp pl how-to-content">
			<div class="how-to-steps">
				<div>1</div> Choose the register button among the dropdown list of PTQE-2022
			</div>
			<div class="how-to-steps">
				<div>2</div> Fill in the personal details in the registration form and submit the form.
			</div>
			<div class="how-to-steps">
				<div>3</div>Make the payment using the preferred mode of payment.
			</div>
			<div class="how-to-steps">
				<div>4</div> Get your login credentials for PTQE Stage-1.
			</div>
		</div>
	</div>

	<a href="<?=base_url()?>ptqe2021/register" class="w3-btn b-primary">Register Now</a>

	<div class="section-title syllabus">
		<h2>Syllabus</h2>
	</div>

	<ul>
		<li>PTQE stage-1 question paper will comprise of
			Maths, Mental Ability, Physics, Chemistry &amp; Biology (For classes 7 th to 10 th )
		</li>
		<li> For Stage I, NCERT Curriculum will be followed. For each class, NCERT
			syllabus of current year will be used to create test papers. E.g. for setting
			class 8 paper, syllabus of class 8 will be followed and so forth. All questions
			will be of objective type with syllabus as prescribed above.</li>
		<li> Marking scheme will be +4 for correct answer &amp; -1 for wrong answer</li>
		<li> Stage II examination will be based on Mathematical Puzzles and Reasoning.</li>
	</ul>

	<div class="section-title faqs">
		<h2>FAQ's</h2>
	</div>

	<p class="question">Q. How will I get the id &amp; password for appearing in PTQE?</p>
	<p class="answer"> When you will follow the proper steps for registration as mentioned above then
		after the completion of registration process, online account will be created
		automatically and credentials for login will be informed via message on the
		mentioned contact no. In case of any issues, kindly contact the office</p>
	<p class="question">Q. What will be level of questions in PTQE Stage-1?</p>
	<p class="answer">
		Questions will be based on application of concepts. Level will be quite good. So
		prepare well and be ready to crack it.</p>
	<p class="question">Q. Who will be eligible to appear in Stage-2?</p>
	<p class="answer"> Only those students would be allowed for Stage-2 exams, who will be able to
		clear the Stage-1 exam as per cutoff criteria.</p>
	<p class="question">Q. Should I appear for PTQE 2022 if I want to crack IIT JEE and pursue a career in
		engineering?</p>
	<p class="answer">Yes, PTQE is a great way to initiate the preparation for IIT JEE and other engineering
		entrance exams. The scholarships attained can be used for taking admission in Pinnacle.
		Our courses are meticulously designed for JEE coaching to prepare students for IIT
		entrance exam</p>
	<p class="question">Q. Should I appear for PTQE 2022 if I want to crack NEET and pursue a career in Medical?</p>
	<p class="answer">Again, PTQE is a great way to initiate the preparation for NEET as well and other medical
		entrance exams. The scholarships attained can be used for taking admission in Pinnacle.
		Our courses are meticulously designed to prepare students for NEET. Rigorous practice
		material and sheets, personal care are the unique features of Pinnacle that has helped
		students a lot in achieving great ranks in NEET.</p>
	<p class="question">Q. Should I appear for PTQE 2022 if I want to crack NTSE?</p>
	<p class="answer">Preparing for NTSE requires the rigorous practice with the competitive approach. Students
		who are currently in classes 7 th , 8 th or 9 th can achieve scholarship via PTQE, that can be used
		for taking admission in our Foundation courses which are meticulously designed to cover
		NCERT, ICSE syllabus along with the preparation of Olympiads, NTSE. These courses are
		focused on understanding basic concepts and help students to strengthen their conceptual
		clarity.</p>
	<p class="question">Q. What are benefits of appearing for PTQE?</p>
	<p class="answer">The main benefit of PTQE will be the in depth assessment of the subject knowledge and the
		conceptual clarity via paper designed by subject experts. The Analysis report will be
		generated using the application of Artificial Intelligence tools. The other major benefit will be
		Scholarships that are meant to encourage and nurture talented students who wish to receive
		IIT coaching, NEET coaching or Foundation coaching. Several meritorious students have
		availed the benefits of scholarships, secured admission in Pinnacle coaching courses and
		gone on to crack IIT Main, JEE Advanced, NEET and many other medical and engineering
		entrance exams.</p>

</div> -->