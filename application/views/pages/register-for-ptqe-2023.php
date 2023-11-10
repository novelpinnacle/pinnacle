<style>
	label span {
		color: #FF5733;
	}
	.fw-400{font-weight: 400 !important}
	.w_0{width:0 !important} 
	.h_0{height: 0 !important;}
	.w_30{width: 30px !important}
	.ovflow_hdn{overflow: hidden !important}
	.d_inline_block{
		display: inline-block !important;
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

	@media only screen and (min-width:768px){
		.pl30{padding-left:30px !important}
		.pr30{padding-right:30px !important}
		.d-flex{display: -ms-flexbox!important;display: flex!important;}
		.align-items-center{align-items:center}
		.flex-fill{-ms-flex: 1 1 auto!important;flex: 1 1 auto!important;}
		.flex-auto{-ms-flex: 0 0 auto!important;flex: 0 0 auto!important;}
	}
	@media only screen and (min-width:768px) and (max-width: 991px){
		.ptqe_req_section .logo_box{width:100px;max-width: 100px;}
	}
	@media only screen and (max-width:767px){
		.pull_xs_left{float: left !important;}
		.mt_xs_15{margin-top: 15px !important;}
		.ptqe_req_section .ptqe_reg_page .ptqe_reg_form {margin-top: 20px;}
		.ptqe_req_section .form_title{font-size: 18px;}
		.ptqe_req_section .logo_box {width: 100px;}
		.ptqe_req_section .ptqe_reg_form .form_input:not(.d_inline_block){width: 100%;}
		.ptqe_req_section .ptqe_reg_form .form_label{min-width: 70px;}
		.ptqe_req_section .ptqe_reg_form .form_declaration{margin-left: 40px}
		
	}
</style>

<div class="container-fluid">
	<div class="ptqe_req_section">
		<div class="ptqe_req_block">
			<div class="ptqe_reg_page">
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<div class="logo_box"><img src="<?= base_url() ?>images/ptqe-2023/logo1.png" alt="logo" class="img-responsive"></div>
					</div>
					<div class="col-xs-12 mt_xs_15 col-sm-6 text-center"> <label class="form_title">Registration Form</label> </div>
					<div class="col-xs-13 col-sm-3 hidden-xs">
						<div class="logo_box"><img src="<?= base_url() ?>images/ptqe-2023/logo2.png" alt="logo" class="img-responsive"></div>
					</div>
				</div>
				<div class="ptqe_reg_form">
					<form id="form" action="<?= base_url() ?>fe/saveptqe" method="post">
						<div class="d-flex">
							<div class="flex-fill">
								
									<div class=" d-flex align-items-center">
										<div class="flex-auto"><label class="form_label">Name</label></div>
										<div class="flex-fill"><input type="text" name="name"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z  ]+)*$" class="form_input w_100" required></div>
									</div>
								
								
									<div class=" d-flex align-items-center mt_3">
										<div class="flex-auto"><span class="color_1 w_100 hidden-xs"></span><label class="form_label">DOB</label></div>
										<div class="flex-fill">
											<div class="d-flex">
												<div class="flex-fill "><span class="color_1 w_100 hidden-xs"></span> <input type="text" name="dob" class="form_input datepicker" required></div>
												<div class="flex-fill">
													<label class="form_label">Gender</label>
													<div class="d_inline_block">
														<span class="color_1 w_100">M/F</span>
														<div class="d_inline_block ">
														<input type="text" name="gender" class="form_input w_30" required>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
								
									<div class="d-flex align-items-center mt_3">
										<div class="flex-auto"><span class="color_1 w_100 hidden-xs"></span><label class="form_label">Category</label></div>
										<div class="flex-fill">
											<div class="d_inline_block">
												<span class="color_1 w_100">GEN</span>
												<div class="d_inline_block form_input">
													<input type="radio" name="category" class="w_100" value="gen" required>
													<span></span>
												</div>
											</div>
											<div class="d_inline_block">
												<span class="color_1 w_100">OBC</span>
												<div class="d_inline_block form_input">
													<input type="radio" name="category" class="w_100" value="obc" required>
													<span></span>
												</div>
											</div>
											<div class="d_inline_block">
												<span class="color_1 w_100">SC</span>
												<div class="d_inline_block form_input">
													<input type="radio" name="category" class="w_100" value="sc" required>
													<span></span>
												</div>
											</div>
											<div class="d_inline_block">
												<span class="color_1 w_100">ST</span>
												<div class="d_inline_block form_input">
													<input type="radio" name="category" class="w_100" value="st" required>
													<span></span>
												</div>
											</div>
											<div class="d_inline_block">
												<span class="color_1 w_100">PH</span>
												<div class="d_inline_block form_input">
													<input type="radio" name="category" class="w_100" value="ph" required>
													<span></span>
												</div>
											</div>
										</div>
									</div>
								
									<div class="d-flex align-items-center mt_3">
										<div class="flex-auto"><label class="form_label">Father`s/Guardian`s Name</label></div>
										<div class="flex-fill"><input type="text" name="fname"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z  ]+)*$" class="form_input w_100" required></div>
									</div>
								

									<div class="d-flex align-items-center mt_3">
										<div class="flex-auto"><span class="color_1 w_100 hidden-xs"></span><label class="form_label">Present Class</label></div>
											<div class="flex-fill">
												<div class="form_cls_sel">
													<div class="d_inline_block">
														<div class="d_inline_block form_input">
														<input type="radio" name="batchId" class="w_100" value="88" required>
														<span></span>
														</div>
														<span class="class_no" >6 <sup>th</sup></span>
													</div>
												</div>

												<div class="form_cls_sel">
													<div class="d_inline_block">
														<div class="d_inline_block form_input">
														<input type="radio" name="batchId" class="w_100" value="89" required>
														<span></span>
													</div>
													<span class="class_no" >7 <sup>th</sup></span>
												</div>
											</div>

											<div class="form_cls_sel">
												<div class="d_inline_block">
													<div class="d_inline_block form_input">
														<input type="radio" name="batchId" class="w_100" value="90" required>
														<span></span>
													</div>
													<span class="class_no" >8 <sup>th</sup></span>
												</div>
											</div>
											
											<div class="form_cls_sel">
												<div class="d_inline_block">
													<div class="d_inline_block form_input">
														<input type="radio" name="batchId" class="w_100" value="91" required>
														<span></span>
													</div>
													<span class="class_no" >9 <sup>th</sup></span>
												</div>
											</div>
											<div class="form_cls_sel">
												<div class="d_inline_block">
													<div class="d_inline_block form_input">
														<input type="radio" name="batchId" class="w_100" value="92" required>
														<span></span>
													</div>
													<span class="class_no" >10 <sup>th</sup></span>
												</div>
											</div>
											<div class="form_cls_sel">
												<div class="d_inline_block">
													<div class="d_inline_block form_input">
														<input type="radio" name="batchId" class="w_100" value="93" required>
														<span></span>
													</div>
													<span class="class_no" >11 <sup>th</sup>M</span>
												</div>
											</div>
											<div class="form_cls_sel">
												<div class="d_inline_block">
													<div class="d_inline_block form_input">
														<input type="radio" name="batchId" class="w_100" value="94" required>
														<span></span>
													</div>
													<span class="class_no" >11 <sup>th</sup>NM</span>
												</div>
											</div>			
										</div>
									</div>
								

							</div>
						
						</div>
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto"><label class="form_label">School Name</label></div>
								<div class="flex-fill"><input type="text" name="school"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z  ]+)*$" class="form_input w_100" required></div>
							</div>
						
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto"><label class="form_label">School City</label></div>
								<div class="flex-fill">
									<div class="d-flex align-items-center">
										<div class="flex-fill pr30"><input type="text" name="schoolCity"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z  ]+)*$" class="form_input w_100" required></div>
										<div class="flex-fill  d-flex align-items-center mt_xs_15">
											<label class="flex-auto form_label_2">School State</label>
											<div class="flex-fill pl30">
												<input type="text" name="schoolState" class="form_input w_100" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto"><label class="form_label">Permanent Address</label></div>
								<div class="flex-fill"><input type="text" name="address" class="form_input w_100" required></div>
							</div>
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto"><label class="form_label">City</label></div>
								<div class="flex-fill">
									<div class="d-flex align-items-center">
										<div class="flex-fill pr30"><input type="text" name="city"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z  ]+)*$" class="form_input w_100" required></div>
										<div class="flex-fill  d-flex align-items-center mt_xs_15">
											<label class="flex-auto form_label_2">District</label>
											<div class="flex-fill pl30">
												<input type="text" name="district" class="form_input w_100" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto"><label class="form_label">State</label></div>
								<div class="flex-fill">
									<div class="d-flex align-items-center">
										<div class="flex-fill pr30"><input type="text" name="state"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z  ]+)*$" class="form_input w_100" required></div>
										<div class="flex-fill  d-flex align-items-center mt_xs_15">
											<label class="flex-auto form_label_2" pattern="^[0-9]*$">Pin Code</label>
											<div class="flex-fill pl30">
												<input type="text" name="pincode" class="form_input w_100" required>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto"><label class="form_label">Contact No.</label></div>
								<div class="flex-fill">
									<div class="d-flex align-items-center">
										<div class="flex-fill pr30"><input type="text" name="phone"  title="Only Numeric Values Allowed" pattern="^[0-9]*$" class="form_input w_100" required></div>
										<div class="flex-fill  d-flex align-items-center mt_xs_15">
											<label class="flex-auto form_label_2">Whatsapp No.</label>
											<div class="flex-fill pl30">
												<input type="text" name="fmobile" title="Only Numeric Values Allowed" pattern="^[0-9]*$" class="form_input w_100" required>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto"><label class="form_label">Email Id</label></div>
								<div class="flex-fill"><input type="text" name="email"  class="form_input w_100" required></div>
							</div>
							<div class="d-flex align-items-center mt_3">
								<div class="flex-auto form_input d_inline_block pull_xs_left"><input type="checkbox" name="declaration"  class="" required><span></span></div>
								<div class="flex-fill form_declaration "><b>DECLARATION:</b> I hereby declare that all the information submitted by me in the registration form is correct.</div>
							</div>
							<div class="w_100 text-center">
								<button type="submit" value="submit" >Submit</button>
							</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
	
</div>




<script>
	$('#form').submit(function(evt) {
		evt.preventDefault();
		$("#loading").css("display", "block");
		$("#form input[type=submit]").attr("disabled", true);
		var formData = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
            data: formData,
			cache: false,
			dataType: 'json',
			contentType: false,
			processData: false,
			success: function (data) {
				$("#loading").css("display", "none");
				$("#form input[type=submit]").attr("disabled", false);
				localStorage.setItem("sid",data.sid);
//				location.href="<=base_url()?>ptqe-success"
				window.location.replace("<?=base_url()?>ptqe-success?sid="+data.sid)
//				$.redirect("<=base_url()?>ptqe-success",{
//					sid: data.sid,
//					rollno: data.rollno
//				})
			}
		});
	});


	/*	function updateStudentDetails(sid, orderId, razorPaymentId, razorSignature) {
	    const username = localStorage.getItem("username");
		$.post({
			url: "< base_url() ?>home/updatePTQEStudentPaymentDetails",
			data: {
				sid: sid,
				username,
				order_id: orderId,
				payment_id: razorPaymentId,
				signature: razorSignature
			},
			dataType: 'json',
			success: function(data) {
			    $("#ptqeDialog").modal("hide");
				openModal({
					title: 'Status',
					content: data.message
				})
			}
		})
		}
	*/
</script>