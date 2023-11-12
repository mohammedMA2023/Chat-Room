<!DOCTYPE html>
<HTML>
<head>

	<title>Test Signon - v0.3</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
	<br>
	<br>
	<div class="container border">
	<form name='form1' id='form1' action="login.php" method="post">
	<br>

		<input type="hidden" id="width" name="width" value=" 0">
		<input type="hidden" id="time" name="time" value=" 0">
		<input type="hidden" id="height" name="height" value=" 0">
	    <input type="hidden" id="auth" name="auth" value="login">

		<div class="inputs mb-3" style="text-align:center;margin:5px;width:100%;">
		<h1>Chat Room</h1>
		<div id="uName" class="inputs mb-3" style="text-align:center;margin:5px;width:100%;visibility:hidden;">
		Username:
		<br>
		<input id="uname" type="text" name="password" placeholder="Enter your password" name="uname"><br>
		<br>
        </div>
		<br>
		<input id="uname" type="text" name="password" placeholder="Enter your password" name="uname">
		<br>

		<br>
		Email:
		<br>
		<input type="email" name="userid" placeholder="Enter your email..."><br>

		Password:
		<br>
		<input type="password" name="password" placeholder="Enter your password"><br>
		<br>

<div class="parent">
<div class="child">
		<input name="sub" id="sub" type="submit"  class="btn btn-primary btn-block" onclick="stopTime()" value="Login" formaction="login.php">
</div></form></div>
<br>
<div class="child">
	<button style="width:35%;" name="changeUi" id="changeUi" type="button"  value="Register" class="btn btn-primary" onclick='{if (document.forms["form1"]["auth"].value == "login"){document.forms["form1"]["auth"].value ="reg";document.forms["form1"]["sub"].value ="Register";document.querySelector("#changeUi").innerHTML = "Log in";document.getElementById("uName").style.visibility="visible";}else if (document.forms["form1"]["auth"].value == "reg"){document.forms["form1"]["auth"].value ="login";document.forms["form1"]["sub"].value ="Log In";document.querySelector("#changeUi").innerHTML = "Register";document.getElementById("uName").style.visibility = "hidden";}}'>Register</button>
</div>
</div>

	<?php
		session_start();
		if (!isset($_SESSION["status"])){
			$_SESSION["status"] = "";
	}
		if ((isset($_SESSION["status"])) && ($_SESSION["status"] == "loggedIn")){
			header("location:home.php");
			exit();
	}



		if (isset($_SESSION["error"])){
				echo $_SESSION["error"];
				$_SESSION["error"] = "";



		}

  ?>
	<script>
	function changeUi(){

		if (document.forms["form1"]["auth"].value == "login"){

            document.getElementById("uName").style.visibility = "visible";
			document.forms["form1"]["auth"].value ="reg";
			document.forms["form1"]["sub"].value ="Register";
			document.querySelector("#changeUi").innerHTML = "Log in";



		}
		else if (document.forms["form1"]["auth"].value == "reg"){
            document.getElementById("uName").style.visibility = "hidden";
			document.forms["form1"]["auth"].value ="login";
			document.forms["form1"]["sub"].value ="Log In";

			document.querySelector("#changeUi").innerHTML = "Register";


		}





	}
</script>
<script>
	var startDate;

function stopTime() {
  let startTime = startDate.getTime();
  var dateNow = new Date();
  var timeNow = dateNow.getTime();
  var timediff = timeNow - startTime;
  document.forms["form1"]["time"].value = timediff / 1000;

}

function start() {
  startDate = new Date();
}

function getScreen() {
  if (!startDate) {
    start();
  }
  document.forms['form1']['width'].value = screen.width;
  document.forms['form1']['height'].value = screen.height;
}

	</script>

</body>

</html>


