<div class="container boxc">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-4">
			<div class='boxes'>
				<div class='body'>
					<h2>CMS</h2>
					<p>This is where you can create and update Website's Content like Slideshow,Events,News and more</p>
					<a href='<?=base_url()?>cms' class='w3-btn b-primary'>Access</a>
				</div>
				<div class='footer'>
					
				</div>
			</div>
		</div>
		<div class="col-sm-4">
		<div class='boxes'>
				<div class='body'>
					<h2>ERP</h2>
					<p>This is where you can Manage Studets,Teachers,Attendance and many more things.</p>
					<a href='<?=base_url()?>erp' class='w3-btn b-primary'>Access</a>
				</div>
				<div class='footer'>
					
				</div>
			</div>
		</div>

		<div class="col-sm-2"></div>
		<div class="clearfix"></div>
		<div class="col-sm-2"></div>

		<div class="col-sm-4">
			<div class='boxes'>
				<div class='body'>
					<h2>Test Platform</h2>
					<p>Our Test Platform</p>
					<a href='#' onclick="gotoTest(event)" class='w3-btn b-primary'>Access</a>
				</div>
				<div class='footer'>
					
				</div>
			</div>
		</div>
	
	</div>
</div>

<script>
function gotoTest(e){
  e.preventDefault()
  localStorage.setItem('email','<?=$_SESSION['username']?>')
  location.href = "https://www.pinnacloeducare.com/test/users";
}

</script>