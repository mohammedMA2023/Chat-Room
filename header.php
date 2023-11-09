<?php
		session_start();
		if (isset($_SESSION["status"])){
      if ($_SESSION["status"] != "loggedIn"){
			header("location:index.php");
			exit();
        
      
    }
  }



		
  ?>
<!DOCTYPE html>
<HTML>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css"> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
</head>

<body onload="getScreen()">
		
	<header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">A Free Bootstrap Business Theme</span>
                <span class="site-heading-lower">Business Casual</span>
            </h1>
        </header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <form name="form1" method="post" action="login.php"> 
                <ul class="navbar-nav mx-auto">
                    <input type="hidden" id="width" name="width" value="">
		<input type="hidden" id="time" name="time" value="">
		<input type="hidden" id="height" name="height" value="">
	    <input type="hidden" id="auth" name="auth" value="logout">
   
		
		
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Home</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about.php">About</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.php">Products</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="store.php">Store</a></li>
                        <?php 
                          if ($_SESSION["status"] == "loggedIn"){
                            echo '<li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="store.php">Pre-Order Products</a></li>'; 
                          }
                        
                        ?>
                        <input type="hidden" id="auth" name="auth" value="logout">
                        <input type="hidden" name="userid"  value="">
		
		
		<br>
		<input type="hidden" name="password" value=""><br>
                        <input onclick="stopTime()" type="submit" class="nav-item px-lg-4" formaction="login.php" value="Log Out">
                    </ul>
                </div>
</form>
            </div>
        </nav>
	
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


