
<button onclick="rzp1.open()" >Click To Payment</button>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

	var options = {
		"key": "<?= $order_data["key"] ?>", // Enter the Key ID generated from the Dashboard
		"amount": "<?= 100 ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
		"currency": "INR",
		"name": "Pinnacle Educare",
		"description": "PTQE2022 FEES",
		"image": "https://pinnacloeducare.com/images/logo-only.png",
		"order_id": "<?= $order_data["order_id"] ?>",
		"callback_url":"https://www.pinnacloeducare.com/home/payment/1/two",
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
</script>