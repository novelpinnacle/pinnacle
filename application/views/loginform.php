<!DOCTYPE html>
<html>
<head>
	<title>Login - Pinnaclo Educare Institute, Sangrur</title>
<meta charset="utf-8">
<link rel="icon" href="<?=base_url()?>favicon.jpg" type="image/jpg">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">
<?php 
include 'css/style.php';
?>
<style>
body{
	background: #fff;
	font-family: 'Roboto',sans-serif;
	padding-top:0;
}
#form{
	position: relative;
	z-index: 2;
	padding: 25px 20px;
	max-width: 280px;
	margin:10px auto 0 auto;
	background: #fff;
	box-shadow: 0 0 10px rgba(0,0,0,0.25);
}
.form-title{
	padding:10px 20px;
	font-weight: 700;
	font-size: 18px;
	margin-top:-25px;
	margin-left: -20px;
	margin-right: -20px;
	margin-bottom: 10px;
	background:var(--main-bg-color1);
	color:#fff ;
}
.w3-input{
	height:33px;
}
.row{
	margin:0;
}
.w3-btn{
	width:100%;
	padding: 6px 20px;
	font-size: 17px;
}
.alert{
	position: relative;
	z-index: 2;
	max-width: 340px;
	margin:10px auto;
}

#logo{
	max-width: 280px;
	margin:0px auto;
}
#logo img{
	max-width: 100%;
	cursor: pointer;
}

#flex{
	display: flex;
	flex-wrap: wrap;
	justify-content: flex-start;
	position: fixed;
	top:50%;
	left: 0;
	transform: translateY(-50%);
}
#result{
	width:78%;
	box-shadow: 0 0 10px rgba(0,0,0,0.25);
	text-align: center;
}
#result>img{
	max-width: 100%;
	height: auto;
}
#lform{
	width: 22%;
}

@media screen and (max-width: 1000px){
	#result{
		width: 100%;
		order:2;
	}
	#lform{
		order:1;
		width: 100%;
		margin-bottom:50px;
	}
}

@media screen and (max-width: 500px){
	body{
			padding-top: 10px;
	}
	#flex{
		position: relative;
		transform: translate(0,0);
	}
}

</style>
</head>
<body>
<div class="container-fluid">
	<div id="flex">
		<div id='result'><img src="<?=base_url()?>images/results.jpg"></div>
		<div id="lform">
			<div id="logo">
				<img onclick="window.location='<?=base_url()?>'" src="<?=base_url()?>images/logo.png">
			</div>

			<div id="form">
			<div class='form-title'>Login Form</div>
				<form action="<?=base_url()?>login" method="post">
					<div class="form-group">
						<label class="w3-text-grey">Enter Username</label>
						<input type="text" name="username" class="w3-input w3-border">
					</div>
					<div class="form-group">
						<label class="w3-text-grey">Enter Password</label>
						<input type="password" name="password" class="w3-input w3-border">
					</div> 
					<div class="form-group text-center">
						<label class='w3-text-grey'><input type="checkbox" name="remember"> Keep Me Logged In</label>
					</div>
					<div class="form-group row">
						<input type="submit" value="Login" class="w3-btn b-primary pull-right">
					</div>

					<p style="margin-top:10px;" class="w3-text-red"><b>Note:</b> For Students Username is Roll No. and Password is D.O.B.<br> For Eg. If D.O.B. is 8 April 2004 then Password is <b>08042004</b>.</p>

				</form>
			</div>
				<?php if(isset($status) && !empty($status)){
					echo "<div class='alert alert-danger' style='margin-top:20px'>Username was wrong</div>";
				} ?>
		</div>
	</div>
</div>



</body>
</html>