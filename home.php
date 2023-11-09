<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Business Casual - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
    </head>
    <body onload="start()">
    
    <div style="  position: absolute;
  bottom: 10px;
  width: 50%;
  ">
    <form method=""> 
    <textarea id="w3review" name="w3review" rows="4" cols="50">
</textarea>    
    <button>Send</button>
</div>
    <?php
    //include 'header.php';
    
    
    
    ?>    
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
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