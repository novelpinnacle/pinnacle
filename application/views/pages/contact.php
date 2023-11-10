<style>
.fa-map{color:var(--main-bg-color1);}
.contact .contact-info {
	text-align: left;
	position: relative;
	padding-left: 100px;
}
.contact .contact-info .icon {
	position: absolute;
	left: 0;
}
.contact .contact-info .icon i {
	width: 70px;
	height: 70px;
	line-height: 70px;
	border: 1px solid #e7e7e7;
	font-size: 25px;
	border-radius: 100%;
	text-align: center;
}
.contact .contact-info h3 {
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 5px;
}
.contact .contact-info a {
	color: #777;
}
.contact .contact-info p {
	color: #777;
	font-size: 15px;
}

#contact-form{
	padding: 15px;
	padding-top: 5px;
	box-shadow: 0 0 10px rgba(0,0,0,0.25);
}
#form-title{
	font-size: 20px;
	font-weight: 700;
	padding: 10px;
	padding-left: 0;
}
label span{
	color:red;
}
</style>

<section class="contact section">
<div class="container-fluid">

	<div class="contact-bottom">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-12">
							<!-- Contact-Info -->
							<div class="contact-info">
								<div class="icon inOut"><i class="fa fa-map"></i></div>
								<h3>Location</h3>
								<p>Pinnacle Educare, Opp. Kidzee School, Guru Nanak Colony, Sangrur</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<!-- Contact-Info -->
							<div class="contact-info">
								<div class="icon"><i class="fa fa-envelope"></i></div>
								<h3>Email Address</h3>
								<a href="mailto:novel.pinnacle@gmail.com">novel.pinnacle@gmail.com, </a>
								<a href="mailto:educare.pinnacle@gmail.com">educare.pinnacle@gmail.com</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<!-- Contact-Info -->
							<div class="contact-info">
								<div class="icon"><i class="fa fa-phone"></i></div>
								<h3>Get in Touch</h3>
								<p>+91-9815355955</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:40px">
				<div class="col-sm-8">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3446.4441614454377!2d75.83665931430339!3d30.252923515650362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3910511c7df6adbd%3A0x9e8a0016ca737855!2sPinnacle%20EduCare!5e0!3m2!1sen!2sin!4v1583144201189!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

				</div>
				<div class="col-sm-4">
						<div id="contact-form">
							<form id="form" action="<?=base_url()?>home/savecontact" method="post">
							<div id="form-title">Have a Query?</div>
								<div class="form-group">
									<label class="w3-text-grey">Name <span>*</span></label>
									<input type="text" name="name" class="w3-input w3-border" title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" required>
								</div>
									<div class="form-group">
									<label class="w3-text-grey">Email  <span>*</span></label>
									<input type="email" name="email" class="w3-input w3-border" required>
								</div>
									<div class="form-group">
									<label class="w3-text-grey">Mobile <span>*</span></label>
									<input type="text" name="phone" class="w3-input w3-border" minlength="10" maxlength="10" pattern="^[0-9]*$" title="Only Numeric values allowed" required>
								</div>
									<div class="form-group">
									<label class="w3-text-grey">Message <span>*</span></label>
									<textarea required name="message" style="height:70px" class="w3-input w3-border"></textarea>
								</div>
									<div class="form-group">
									<div><?php echo $this->session->flashdata('status'); ?>
										<?php echo validation_errors(); ?>
									</div>
									<input type="submit" class="w3-btn b-primary" value="Submit">
								</div>
							</form>
						</div>
				</div>	
				</div>


</div>
</section>