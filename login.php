<?php
session_start();
    $header = "";
    // Logging code
    // Get the type of request (GET or POST).
    $reqMethods = $_SERVER["REQUEST_METHOD"];
    // Get important server data, like the server name, IP, port, and software.
    $serverName = $_SERVER["SERVER_NAME"];
    $serverPort = $_SERVER["SERVER_PORT"];
    $serverIp = $_SERVER["SERVER_ADDR"];
    $serverSoftware = $_SERVER["SERVER_SOFTWARE"];
    // Access the user agent, which includes data about the user's platform.
    // If-elseif-else block to figure out the user's platform and then set the variable of the platform variable to get the user's platform.
    $platform = "";
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
    // Check for common platforms
        if (strpos($userAgent, 'Windows') !== false) {
            $platform = "Windows";
        } elseif (strpos($userAgent, 'Macintosh') !== false) {
            $platform = "MacOS";
        } elseif (strpos($userAgent, 'Linux') !== false) {
            $platform = "Linux";
        } else {
            $platform = "Unknown";
        }
    } else {
        $platform = "User agent information not available.";
    }
    // This will access the client's IP, name, and port.
    $ip = $_SERVER["REMOTE_ADDR"];
    $clientName = gethostbyaddr($ip);
    $clientPort = $_SERVER['REMOTE_PORT'];
    date_default_timezone_set("Europe/London");
    $date = date('d-m-Y H:i:s');
    // Check if the referer variable is set and not empty
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
        $clientScriptUrl = $_SERVER['HTTP_REFERER'];
    } else {
        $clientScriptUrl = "Unknown";
    }
    // This will collect some additional information about the server and client.
    // The scriptName variable will hold the name of the server script.
    // The acceptLanguage variable will hold the accept language of the client.
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    // Get the resolution of the client's screen.
    $width = $_POST['width'];
    $height = $_POST['height'];
    $res = "$width x $height";
    // Get the time the user spent on the website and the time it took to complete the form.
    $time = $_POST['time'];
    // Write all collected data to the log.txt file.
    $file = 'log.txt';

    $current = file_get_contents($file);
    $uName = $_POST["userid"];
    echo json_encode($_POST);
    $newLine = "Request Method: $reqMethods\n" . "Request Params:" . json_encode($_POST) . "\n" . "User: " . $uName . "\n" . "Cient IP: " . $ip . "\nClient Name: $clientName\n Client Port: $clientPort\n Client Platform: $platform\n Client Accept Language: $acceptLanguage\n Client Script URL: $clientScriptUrl\n Server Name: $serverName\n Server IP: $serverIp\n Server Port: $serverPort\n Server Script Name: $scriptName\n Server Software: $serverSoftware" . "Current Date: " . $date . "\n" .  "\n resolution: $res\n time spent on site: $time seconds" . "\r\n\n";
    $current = $current . $newLine;
    file_put_contents($file, $current);
    
    function assessPasswordSecurity($password) {
        // Check if the password contains at least 8 characters
        if (strlen($password) < 8) {
            return "Password must be at least 8 characters long.";
        }
    
        // Check if the password contains at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            return "Password must contain at least one uppercase letter.";
        }
    
        // Check if the password contains at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            return "Password must contain at least one lowercase letter.";
        }
    
        // Check if the password contains at least one digit
        if (!preg_match('/[0-9]/', $password)) {
            return "Password must contain at least one digit.";
        }
        // Check if the password contains at least one special character
        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            return "Password must contain at least one special character.";
        }
    
        // Password is secure
        return null;
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "login_db";
    $dbTable = "users";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);
    if ($conn->connect_error) {;
            die();
    }
    
    $uPass = $_POST["password"];
// Hash the entered password
    $hashedPassword = password_hash($uPass, PASSWORD_BCRYPT);
    switch ($_POST['auth']){
        case "login":
            // Use prepared statement to query the database
    $stmt = $conn->prepare("SELECT email, password FROM $dbTable WHERE email = ?");
    $stmt->bind_param("s", $uName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $storedHashedPassword = $row["password"];

            // Verify the entered password against the stored hashed password
            if ((password_verify($uPass, $storedHashedPassword)) && ($uName == $row["email"]) ) {
                $status = "loggedIn";
                $header = "home.php";
} else {
                $status = "loggedOut";
                $_SESSION['error'] = "Error: these details are incorrect. Please try again.";
                $header = "index.php";
			}
    }
    } else {
        $status = "loggedOut";
        $_SESSION['error'] = "Error: these details are incorrect. Please try again.";
        $header = "index.php";
	}
    break;
    case "reg":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST["password"];
            
            // Assess password security
            $securityError = assessPasswordSecurity($password);
            if ($securityError !== null) {
                // Password is not secure, set session variable and redirect
                $_SESSION['error'] = $securityError;
                $header = "index.php";
            }
             // Password is secure, you can continue with registration or other actions.
            else{
        $email = $_POST["userid"];
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Check if the email already exists in the database
        $stmt = $conn->prepare("SELECT email FROM $dbTable WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
            if ($result->num_rows > 0){
            // Email already exists, handle this case as needed
            $_SESSION['error'] = "Error: this email is already registered. Please try again.";
                $header = "index.php";
         } else {
                // Email and password don't exist, proceed to insert the new user
                // Hash the password
                // Insert the new user into the database
                $stmt = $conn->prepare("INSERT INTO $dbTable (username,email,password) VALUES (?, ?,?)");
                $u = "mohammed";
                $stmt->bind_param("sss",$u ,$email, $hashedPassword);
                 $stmt->execute();
                    $status = "loggedIn";
                    $header = "home.php";
            }
        }       
            }           
    break;
case "logout":
    session_destroy();
$header = "index.php";
break;
    }
$_SESSION["status"] = $status;
$conn->close();
//header("location:".$header);
//exit();
?>