<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Chat Room Login</title>
    <!-- Bootstrap CSS link (make sure to include it in your project) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 50px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        #login-reg {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Welcome to the Chat Room</h3>
                </div>
                <div class="card-body">
                    <form class="form" id="form" name="form" action="login.php" method="post">
                        <input type="hidden" id="auth" name="auth" value="login">
                        <div id="username" style="display:none;" class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="userid">Email</label>
                            <input name="userid" type="email" class="form-control" id="userid" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" name="sub" id="sub" class="btn btn-success btn-lg btn-block">Log In</button>
                        <button id="login-reg" name="login-reg" type="button" class="btn btn-secondary btn-lg btn-block mt-3" onclick="changeUi()">Don't have an account? Register...</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (make sure to include them in your project) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function changeUi() {
        if (document.forms["form"]["auth"].value == "login") {
            document.getElementById("username").style.display = "block";
            document.forms["form"]["auth"].value ="reg";
            document.forms["form"]["sub"].innerHTML ="Register";
            document.querySelector("#login-reg").innerHTML = "Already have an account? Log In...";
        } else if (document.forms["form"]["auth"].value == "reg") {
            document.getElementById("username").style.display = "none";
            document.forms["form"]["auth"].value ="login";
            document.forms["form"]["sub"].innerHTML = "Log In";
            document.querySelector("#login-reg").innerHTML= "Don't have an account? Register...";
        }
    }
</script>
</body>
</html>
