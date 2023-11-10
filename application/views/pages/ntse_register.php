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
					<h2><span>NTSE Registration</span></h2>
					<p></p>
				</div>
				<div class="mycardbody">
					<form id="form" action="<?= base_url() ?>home/save_ntse" method="post">
						<div class="row">
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Name <span>*</span></label>
									<input type="text" name="name"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" class="w3-input w3-border" required>
								</div>
							</div>
							<div class='col-sm-2 wp pr'>
								<div class='form-group'>
									<label class="w3-text-grey">Email <span>*</span></label>
									<input type="email" name="email" class="w3-input w3-border" required>
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

<div class="modal" id="ntseDialog" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Status</h4>
        </div>
        <div class="modal-body">
            <div id="ntseContent"></div>
            <button class="w3-btn b-primary" onclick="rzp1.open();" >Make Payment</button>
        </div>
      </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

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
			success: function(data) {
				$("#loading").css("display", "none")
				$("#form input[type=submit]").attr("disabled", false)
				
				if(data.success) {
				    sid = data.sid
				    $("#ntseContent").html(data.message);
				    $("#ntseDialog").modal({backdrop:'static'});
				    return
				}
				
				openModal({
				 	title: 'Status',
				 	content: data.message
				})
			
			}
		});
	});
</script>

<script>
	var sid = null;

	var options = {
		"key": "<?= $order_data["key"] ?>", // Enter the Key ID generated from the Dashboard
		"amount": "<?= 100 ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
		"currency": "INR",
		"name": "Pinnacle Educare",
		"description": "PTQE2021 FEES",
		"image": "https://pinnacloeducare.com/images/logo-only.png",
		"order_id": "<?= $order_data["order_id"] ?>",
		"handler": function(response, notes) {
			updateStudentDetails(sid, response.razorpay_order_id, response.razorpay_payment_id, response.razorpay_signature)
		},
		"prefill": {
			"name": "",
			"email": "",
			"contact": ""
		},
		"notes": {
			"address": "Pinnacle Educare Office"
		},
		"theme": {
			"color": "#F37254"
		},
	};
	var rzp1 = new Razorpay(options)
	rzp1.on('payment.failed', function(response) {
		let content = "";
		for (let [key, value] of Object.entries(response.error)) {
			if (key == 'metadata') {
				value = JSON.stringify(value)
			}
			content += `<tr><th>${key}</th><td>${value}</td>`;
		}

		openModal({
			title: 'Payment Failed',
			content: `<table class='sc-table'>${content}</table>`
		})
	})

	function updateStudentDetails(sid, orderId, razorPaymentId, razorSignature) {
		$.post({
			url: "<?= base_url() ?>home/updateStudentPaymentDetails",
			data: {
				sid: sid,
				order_id: orderId,
				payment_id: razorPaymentId,
				signature: razorSignature
			},
			dataType: 'json',
			success: function(data) {
				openModal({
					title: 'Status',
					content: data.message
				})
			}
		})
	}
</script>
