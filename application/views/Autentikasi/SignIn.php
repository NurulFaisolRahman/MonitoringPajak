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
	<style type="text/css">
		.capbox {
			background-color: #92D433;
			border: #B3E272 0px solid;
			display: inline-block;
			*display: inline; zoom: 1; /* FOR IE7-8 */
			padding: 8px 8px 8px 8px;
			}
		.capbox-inner {
			font: bold 15px arial, sans-serif;
			color: #000000;
			background-color: #DBF3BA;
			margin: 5px auto 0px auto;
			padding: 3px;
			-moz-border-radius: 4px;
			-webkit-border-radius: 4px;
			border-radius: 4px;
			}
		#CaptchaDiv {
			font: bold 17px verdana, arial, sans-serif;
			font-style: italic;
			color: #000000;
			background-color: #FFFFFF;
			padding: 4px;
			-moz-border-radius: 4px;
			-webkit-border-radius: 4px;
			border-radius: 4px;
			}
		#CaptchaInput { margin: 1px 0px 1px 0px; width: 270px; }
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="LogoBP2DMalang.jpeg" alt="IMG">
				</div>

				<form class="login100-form" onsubmit="event.preventDefault();">
					<!-- <span class="login100-form-title">
						SIGN IN <br> MONITORING PAJAK
					</span> -->

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
					
					<div class="capbox">
						<div id="CaptchaDiv"></div>
							<div class="capbox-inner">
							Input Captcha :<br>
							<input type="hidden" id="txtCaptcha">
							<input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="TombolLogin">
							<b>SIGN IN</b>
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

		  GantiCaptcha();

		  $("#TombolLogin").click(function() {
		  	if ($("#Username").val() == '') {
	  			alert('Mohon Input Username')
	  		} else if ($("#Password").val() == '') {
	  			alert('Mohon Input Password')
	  		} else {
	  			if (checkform(this)) {
			 	    var DataLogin = { Username: $("#Username").val(), Password: $("#Password").val() };
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
			  	} 
	  		}
		  });

		  function checkform(theform){
		    var why = "";
		    if($("#CaptchaInput").val() == ""){
		      why += "Mohon Input Captcha";
		    }
		    if($("#CaptchaInput").val() != ""){
		      if(ValidCaptcha($("#CaptchaInput").val()) == false){
		        why += "Input Captcha Tidak Sesuai";
		      }
		    }
		    if(why != ""){
		      alert(why);
		      GantiCaptcha();
		      document.getElementById("CaptchaInput").value = '';
		      return false;
		    }
		    else {
		      return true;
		    }
		  }

		  function GantiCaptcha(){
		    var Captcha = '';
		    var characters = 'AaBbCcD1dEeFf2GgHhI3iJjKk4LlMmN5nOoPp6QqRrS7sTtUu8VvWwX9xYyZz';
		    var charactersLength = characters.length;
		    for ( var i = 0; i < 5; i++ ) {
		       Captcha += characters.charAt(Math.floor(Math.random() * charactersLength));
		    }
		    document.getElementById("txtCaptcha").value = Captcha;
		    document.getElementById("CaptchaDiv").innerHTML = Captcha;
		  }

		  function ValidCaptcha(){
		    var str1 = document.getElementById('txtCaptcha').value;
		    var str2 = document.getElementById('CaptchaInput').value;
		    if (str1 == str2){
		      return true;
		    }else{
		      return false;
		    }
		  }
		});
	</script>
</body>
</html>
