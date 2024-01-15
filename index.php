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
		<input type="text" name="uname" placeholder="Enter your username..." ><br>
		<br>
        </div>

		<br>
		Email:
		<br>
		<input type="email" name="userid" placeholder="Enter your email..."><br>

		Password:
		<br>
		<input type="password" name="password" placeholder="Enter your password" required><br>
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


NICKS WORK

<!-- login form-->
<section class="projects-section bg-dark" id="">
            <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h2 class="section-heading mb-5">
                                <span class="section-heading-upper"> </span>
                                <!-- <span class="section-heading-lower">Rate My Cake</span> -->
                            </h2>
                            
                            <div style="display: inline-block; text-align: center;">
                                <form action="logindb.php" method="post" enctype="multipart/form-data">

                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="username" required>
                                <br>
                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>
                                  <br>

                                  <input style="width:100%;" type="submit" value="create account" />
                                </form>
                            </div>
                            <?php  
                              if ((isset($_SESSION["error"])) && ($_SESSION["error"])){
                                echo $_SESSION["error"];
                                $_SESSION["error"] = "";

                              } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
PHP========================
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mistymountains";

$uname = $_POST["username"];
$pword = $_POST["password"];
// $email = $_POST["email"];

echo $uname;
echo $pword;
// echo $email;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $sql = "INSERT INTO userdb (username,password)
// VALUES (?,?)";

$stmt = $conn->prepare("INSERT INTO userdb (username,password)
VALUES (?,?)");
$stmt->bind_param("ss",$uname ,$pword);
$stmt->execute();
$conn->close();

$header = "index.php";

// header("location:".$header);
// exit();
?>