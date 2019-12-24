<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SIGN IN</title>
	<link rel="icon" href="Favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="Assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="LogoBP2DMalang.jpeg" alt="IMG">
				</div>

				<form class="login100-form" onsubmit="event.preventDefault();">
					<span class="login100-form-title">
						SIGN IN <br> MONITORING PAJAK
					</span>

					<div class="wrap-input100">
						<input class="input100" type="text" id="Username" placeholder="Username">
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" id="Password" placeholder="Password">
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="TombolLogin">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="Assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="Assets/vendor/bootstrap/js/popper.js"></script>
	<script src="Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="Assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.2
		})
		jQuery(document).ready(function($) {
		  "use strict";
		  $("#TombolLogin").click(function() {
		    var DataLogin = { Username: $("#Username").val(),
		                      Password: $("#Password").val()
		                    };
		  	$.ajax({
		      	type	: 'POST',
		  		url		: 'http://localhost/MonitoringPajak/Autentikasi/SignIn',
		  		data	: DataLogin,
		  		success	: function(Pesan){
		  			if(Pesan == '1' || Pesan == '2'){
		  				window.location = 'http://localhost/MonitoringPajak/Dashboard';
		  			} else if (Pesan == '3') {
		  				window.location = 'http://localhost/MonitoringPajak/Transaksi/Tahunan';
		  			} else{
		  				alert(Pesan)
		  			}
		  		}
		  	});
		    return false;
		  });
		});
	</script>
</body>
</html>
