<style>
	label span {
		color: #FF5733;
	}
</style>
<div class="container">
	<section class="section pages" style="padding:40px 0">
		<div class="row shadow">
			<div class="col-sm-12">
				<div class="section-title">
					<h2><span>PSAT 2023 Registration</span></h2>
				</div>
				<div class="mycardbody">
					<form id="form" action="<?= base_url() ?>fe/savepsat" method="post">
						<div class="row">
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Name <span>*</span></label>
									<input type="text" name="name"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" class="w3-input w3-border" required>
								</div>
							</div>
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Email</label>
									<input type="email" name="email" class="w3-input w3-border">
								</div>
							</div>
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Father Name <span>*</span></label>
									<input type="text" name="fname" title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" class="w3-input w3-border" required>
								</div>
							</div>
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Father Mobile <span>*</span></label>
									<input type="text" name="fmobile" minlength="10" maxlength="10" pattern="^[0-9]*$" title="Only Numeric values allowed" class="w3-input w3-border" required>
								</div>
							</div>
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Student Phone</label>
									<input type="text" id="sphone" name="phone" minlength="10" maxlength="10" pattern="^[0-9]*$" title="Only Numeric values allowed" class="w3-input w3-border">
								</div>
							</div>
								<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">School</label>
									<input type="text" name="school" class="w3-input w3-border">
								</div>
							</div>
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Current Class <span>*</span></label>
									<select name="batchId" class="w3-input w3-border" required>
										<option>Select Class</option>
										<option value="57">7th</option>
										<option value="58">8th</option>
										<option value="59">9th</option>
										<option value="60">10th</option>
									</select>
								</div>
							</div>
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Gender <span>*</span></label>
									<select name="gender" class="w3-input w3-border" required>
										<option>Male</option>
										<option>Female</option>
									</select>
								</div>
							</div>

							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">D.O.B <span>*</span></label>
									<input type="text" name="dob" class="w3-input w3-border datepicker" required>
								</div>
							</div>
							<div class='col-sm-4 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Village/City <span>*</span></label>
									<input type="text" name="city" class="w3-input w3-border" required>
								</div>
							</div>
							<div class='col-sm-12 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Address <span>*</span></label>
									<textarea name="address" class="w3-input w3-border" required></textarea>
								</div>
							</div>
							<div class="col-sm-3 wp pr">
								<div class="form-group">
									<input type="submit" value="Submit" class="w3-btn b-primary">
								</div>
							</div>
							<div class="col-sm-6 wp pr"></div>
							<div class="col-sm-6 wp pr">
								<div id="showselected"></div>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</section>
</div>

<script>
        $('#form').submit(function (evt) {
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
                    $("#loading").css("display", "none")
                    $("#form input[type=submit]").attr("disabled", false)
                    openModal({
                        title: 'Status',
                        content: data.message
                    })
                }
            });
        });
</script>