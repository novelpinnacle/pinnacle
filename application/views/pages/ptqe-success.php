<style>
	label span {
		color: #FF5733;
	}
	.w_0{width:0 !important} 
	.h_0{height: 0 !important;}
	.w_30{width: 30px !important}
	.pl30{padding-left:30px !important}
	.pr30{padding-right:30px !important}
	.ovflow_hdn{overflow: hidden !important}
	.d_inline_block{
		display: inline-block !important;
	}
	.d-flex{
		display: -ms-flexbox!important;
    	display: flex!important;
	}
	.align-items-center{
		align-items:center
	}
	.flex-fill{
		-ms-flex: 1 1 auto!important;
    	flex: 1 1 auto!important;
	}
	.flex-auto{
		-ms-flex: 0 0 auto!important;
    	flex: 0 0 auto!important;
	}
	.w_100{
		width: 100% !important;
	}
	.color_1{
		color: #f3a23a !important;
		font-size: 11px;
		display: inline-block;
		line-height:1
	}
	.mt_3{
		margin-top:15px
	}
	.ptqe_req_section{
		background: #f3a23a;
		padding:20px;
		margin: 20px 0;
	}
	.ptqe_req_section .form_title{
		margin: 0;
		font-size: 30px;
		background: #f3a23a;
		color: #fff;
		padding: 5px 10px;
	}
	.ptqe_req_section .logo_box{
		width:200px;
		max-width: 200px;
	}
	.ptqe_req_section .ptqe_req_block{
		border: 7px solid #fff;
		padding:20px 10px;
	}
	.ptqe_req_section .ptqe_reg_page{
		background:#fff;
		padding: 20px;
	}
	.ptqe_req_section .ptqe_reg_page .ptqe_reg_form{
		margin-top: 50px;
	}
	.ptqe_req_section .ptqe_reg_form .upload_photo_block{
		width:220px;
		padding: 10px;
	}
	.ptqe_req_section .ptqe_reg_form .upload_photo_block .upload_photo_box{
		height: 100%;
		border: 2px solid #000;
		max-height: 170px;
	}
	.ptqe_req_section .ptqe_reg_form .form_label_2{
		font-weight:400;
		font-size: 18px;
	}
	.ptqe_req_section .ptqe_reg_form .form_label{
		min-width:180px;
		font-weight:400;
		font-size: 18px;
		margin-right: 10px;
	}
	.ptqe_req_section .ptqe_reg_form .form_input{
		height:30px;
		min-width:30px;
		border: 2px solid #000;
		position: relative;
	}
	.ptqe_req_section .ptqe_reg_form input[type=checkbox],
	.ptqe_req_section .ptqe_reg_form input[type=radio]{
		width: 100% !important;
		margin: 0 !important;
		height: 100%;
		position: absolute;
		opacity: 0;
	}
	.ptqe_req_section .ptqe_reg_form input[type=checkbox] + span:before,
	.ptqe_req_section .ptqe_reg_form input[type=radio] + span:before{
		position: relative;
	}
	.ptqe_req_section .ptqe_reg_form input[type=checkbox]:checked + span:before,
	.ptqe_req_section .ptqe_reg_form input[type=radio]:checked + span:before{
		content: '\f00c';
		font-family: "FontAwesome";
		position:absolute;
		font-size: 14px;
		left: 5px;
	}
	.ptqe_req_section .ptqe_reg_form button{
		background: #f3a23a;
		border: 1px solid #f3a23a;
		border-radius: 25px;
		font-weight:800;
		font-size: 22px;
    	margin-top: 20px;
		padding: 10px 20px;
	}
	.ptqe_req_section .ptqe_reg_form .form_cls_sel {
		display: inline-block;
		min-width: 150px;
		vertical-align: middle;
	}
	.ptqe_req_section .ptqe_reg_form .class_no {
		vertical-align: middle;
		position: relative;
		top: -8px;
		display: inline-block;
		margin-left: 10px;
		font-size: 18px;
	}
	.ptqe_req_section .ptqe_reg_form .form_declaration {
		margin-left: 10px;
		font-size:18px
	}

	.ptqe_req_section .admit_card .form_label {
		width: 240px;
		font-weight:400;
		font-size: 18px;
		margin-right: 10px;
	}
	.ptqe_req_section .admit_card input[type=text].form_input {
		height: 30px;
		min-width: 30px;
		border: 0px;
		border-bottom: 2px solid #000;
		position: relative;
	}
	.ptqe_req_section .admit_card .form_cls_sel {
		display: inline-block;
		min-width: 100px;
		vertical-align: middle;
	}
	.ptqe_req_section .admit_card .upload_photo_block .upload_photo_box {
		height: 100%;
		border: 2px solid #000;
		max-height: 250px;
	}
	.ptqe_req_section .admit_card .upload_photo_block .upload_photo_box .photo_label {
		color: #f3a23a !important;
		font-size: 20px;
    	font-weight: 700;
		display: inline-block;
		line-height:1;
		text-align:center;
	}
@media print{
	label span {
		color: #FF5733;
	}
	.w_0{width:0 !important} 
	.h_0{height: 0 !important;}
	.w_30{width: 30px !important}
	.pl30{padding-left:30px !important}
	.pr30{padding-right:30px !important}
	.ovflow_hdn{overflow: hidden !important}
	.d_inline_block{
		display: inline-block !important;
	}
	.d-flex{
		display: -ms-flexbox!important;
    	display: flex!important;
	}
	.align-items-center{
		align-items:center
	}
	.flex-fill{
		-ms-flex: 1 1 auto!important;
    	flex: 1 1 auto!important;
	}
	.flex-auto{
		-ms-flex: 0 0 auto!important;
    	flex: 0 0 auto!important;
	}
	.w_100{
		width: 100% !important;
	}
	.color_1{
		color: #f3a23a !important;
		font-size: 11px;
		display: inline-block;
		line-height:1
	}
	.mt_3{
		margin-top:15px
	}
	.ptqe_req_section{
		background: #f3a23a;
		padding:20px;
		margin: 20px 0;
	}
	#formtitleid{
		margin: 0;
		font-size: 30px;
		background: #f3a23a;
		color: #fff;
		padding: 5px 10px;
	}
	.ptqe_req_section .logo_box{
		width:200px;
		max-width: 200px;
	}
	.ptqe_req_section .ptqe_req_block{
		border: 7px solid #fff;
		padding:20px 10px;
	}
	.ptqe_req_section .ptqe_reg_page{
		background:#fff;
		padding: 20px;
	}
	.ptqe_req_section .ptqe_reg_page .ptqe_reg_form{
		margin-top: 50px;
	}
	.ptqe_req_section .ptqe_reg_form .upload_photo_block{
		width:220px;
		padding: 10px;
	}
	.ptqe_req_section .ptqe_reg_form .upload_photo_block .upload_photo_box{
		height: 100%;
		border: 2px solid #000;
		max-height: 170px;
	}
	.ptqe_req_section .ptqe_reg_form .form_label_2{
		font-weight:400;
		font-size: 18px;
	}
	.ptqe_req_section .ptqe_reg_form .form_label{
		min-width:180px;
		font-weight:400;
		font-size: 18px;
		margin-right: 10px;
	}
	.ptqe_req_section .ptqe_reg_form .form_input{
		height:30px;
		min-width:30px;
		border: 2px solid #000;
		position: relative;
	}
	.ptqe_req_section .ptqe_reg_form input[type=checkbox],
	.ptqe_req_section .ptqe_reg_form input[type=radio]{
		width: 100% !important;
		margin: 0 !important;
		height: 100%;
		position: absolute;
		opacity: 0;
	}
	.ptqe_req_section .ptqe_reg_form input[type=checkbox] + span:before,
	.ptqe_req_section .ptqe_reg_form input[type=radio] + span:before{
		position: relative;
	}
	.ptqe_req_section .ptqe_reg_form input[type=checkbox]:checked + span:before,
	.ptqe_req_section .ptqe_reg_form input[type=radio]:checked + span:before{
		content: '\f00c';
		font-family: "FontAwesome";
		position:absolute;
		font-size: 14px;
		left: 5px;
	}
	
	.ptqe_req_section .ptqe_reg_form .form_cls_sel {
		display: inline-block;
		min-width: 150px;
		vertical-align: middle;
	}
	.ptqe_req_section .ptqe_reg_form .class_no {
		vertical-align: middle;
		position: relative;
		top: -8px;
		display: inline-block;
		margin-left: 10px;
		font-size: 18px;
	}
	.ptqe_req_section .ptqe_reg_form .form_declaration {
		margin-left: 10px;
		font-size:18px
	}

	.ptqe_req_section .admit_card .form_label {
		width: 240px;
		font-weight:400;
		font-size: 18px;
		margin-right: 10px;
	}
	.ptqe_req_section .admit_card input[type=text].form_input {
		height: 30px;
		min-width: 30px;
		border: 0px;
		border-bottom: 2px solid #000;
		position: relative;
	}
	.ptqe_req_section .admit_card .form_cls_sel {
		display: inline-block;
		min-width: 100px;
		vertical-align: middle;
	}
	.ptqe_req_section .admit_card .upload_photo_block .upload_photo_box {
		height: 100%;
		border: 2px solid #000;
		max-height: 250px;
	}
	.ptqe_req_section .admit_card .upload_photo_block .upload_photo_box .photo_label {
		color: #f3a23a !important;
		font-size: 20px;
    	font-weight: 700;
		display: inline-block;
		line-height:1;
		text-align:center;
	}
}

</style>

<?php

$class6 = null;
$class7 = null;
$class8 = null;
$class9 = null;
$class10 = null;
$class11M = null;
$class11NM = null;

if($batchId=="88"){
	$class6 = "checked";
}
if($batchId=="89"){
	$class7 = "checked";
}
if($batchId=="90"){
	$class8 = "checked";
}
if($batchId=="91"){
	$class9 = "checked";
}
if($batchId=="92"){
	$class10 = "checked";
}
if($batchId=="93"){
	$class11M = "checked";
}
if($batchId=="94"){
	$class11NM = "checked";
}

?>
<div id="printablearea" class="container-fluid">
	<div class="ptqe_req_section">
		<div class="ptqe_req_block">
			<div class="ptqe_reg_page">
				<div class="row">
					<div class="col-3 col-sm-3">
						<div class="logo_box"><img src="<?= base_url() ?>images/ptqe-2023/logo1.png" alt="logo" class="img-responsive"></div>
					</div>
					<div class="col-3 col-sm-6 text-center"> <label id="formtitelid" class="form_title">Admit Card</label> </div>
					<div class="col-3 col-sm-3">
						<div class="logo_box"><img src="<?= base_url() ?>images/ptqe-2023/logo2.png" alt="logo" class="img-responsive"></div>
					</div>
				</div>
				<div class="ptqe_reg_form admit_card">
						<div class="d-flex">
							<div class="flex-fill">
							<div class="d-flex align-items-center">
									<div class="flex-auto"><label class="form_label">Roll No</label></div>
									<div class="flex-fill"><input type="text" name="rollno" placeholder="PTQE<?php echo  $rollno ?>" class="form_input w_100" readonly></div>
								</div>	
							<div class="d-flex align-items-center">
									<div class="flex-auto"><label class="form_label">Name</label></div>
									<div class="flex-fill"><input type="text" name="name" placeholder="<?php echo  $name ?>" title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" class="form_input w_100" readonly></div>
								</div>
								<div class="d-flex align-items-center mt_3">
									<div class="flex-auto"><label class="form_label">Father`s/Guardian`s Name</label></div>
									<div class="flex-fill"><input type="text" name="fname" placeholder="<?php echo  $fname ?>" title="Only Alphabets Allowed"  class="form_input w_100" readonly></div>
								</div>
								<div class="d-flex align-items-center mt_3">
									<div class="flex-auto"><span class="color_1 w_100"></span><label class="form_label">Present Class</label></div>
									<div class="flex-fill">
										
										<div class="form_cls_sel">
											<div class="d_inline_block">
												
												<div class="d_inline_block form_input">
													<input type="radio" disabled="true" name="batchId" class="w_100" value="88" <?php echo $class6; ?>>
													<span></span>
												</div>
												<span class="class_no">6 <sup>th</sup></span>
											</div>
										</div>
										<div class="form_cls_sel">
											<div class="d_inline_block">
												<div class="d_inline_block form_input">
													<input type="radio" disabled="true" name="batchId" class="w_100" value="89" <?php echo $class7; ?>>
													<span></span>
												</div>
												<span class="class_no">7 <sup>th</sup></span>
											</div>
										</div>
										<div class="form_cls_sel">
											<div class="d_inline_block">
												<div class="d_inline_block form_input">
													<input type="radio" disabled="true" name="batchId" class="w_100" value="90" <?php echo $class8; ?>>
													<span></span>
												</div>
												<span class="class_no">8 <sup>th</sup></span>
											</div>
										</div>
										<div class="form_cls_sel">
											<div class="d_inline_block">
												<div class="d_inline_block form_input">
													<input type="radio" disabled="true" name="batchId" class="w_100" value="91" <?php echo $class9; ?>>
													<span></span>
												</div>
												<span class="class_no">9 <sup>th</sup></span>
											</div>
										</div>
										<div class="form_cls_sel">
											<div class="d_inline_block">
												<div class="d_inline_block form_input">
													<input type="radio" disabled="true" name="batchId" class="w_100" value="92" <?php echo $class10; ?>>
													<span></span>
												</div>
												<span class="class_no">10 <sup>th</sup></span>
											</div>
										</div>
										<div class="form_cls_sel">
											<div class="d_inline_block">
												<div class="d_inline_block form_input">
													<input type="radio" disabled="true" name="batchId" class="w_100" value="93" <?php echo $class11M; ?>>
													<span></span>
												</div>
												<span class="class_no">11 <sup>th</sup>M</span>
											</div>
										</div>
										<div class="form_cls_sel">
											<div class="d_inline_block">
												<div class="d_inline_block form_input">
													<input type="radio" disabled="true" name="batchId" class="w_100" value="94" <?php echo $class11NM; ?>>
													<span></span>
												</div>
												<span class="class_no">11<sup>th</sup>NM</span>
											</div>
										</div>
																
									</div>
								</div>
								<div class="d-flex align-items-center mt_3">
									<div class="flex-auto"><label class="form_label">School Name</label></div>
									<div class="flex-fill"><input type="text" name="schoolName"  title="Only Alphabets Allowed"  class="form_input w_100" placeholder="<?php echo $school ?>" readonly></div>
								</div>
								<div class="d-flex align-items-center mt_3">
									<div class="flex-auto"><label class="form_label">Test Date & Timings</label></div>
									<div class="flex-fill"><input type="text" name="testTime"  title="Only Alphabets Allowed"  class="form_input w_100" required></div>
								</div>
								<div class="d-flex align-items-center mt_3">
									<div class="flex-auto"><label class="form_label">Pinnacle Educare Representative</label></div>
									<div class="flex-fill"><input type="text" name="pinnacleRepresentative"  title="Only Alphabets Allowed"  class="form_input w_100" required></div>
								</div>
							</div>
							<div class="upload_photo_block">
								<div id="upload_ph_box" class="upload_photo_box d-flex align-items-center">
									<img id="prvw_ph" src="#" alt="your image" class="img-responsive w_0 h_0 ovflow_hdn" />
									<span class="photo_label">Affix your recent passport size photograph</span>
								</div>
								
								
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="w_100 text-center">
		<button onclick="printDiv('printablearea')"  type="button" value="print Admit Card" >Print</button>
	</div>
</div>

<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>