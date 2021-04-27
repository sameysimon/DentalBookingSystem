<?php
    session_start();
    include 'FunctionLibrary/QueryDatabase.php';
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="./Style/Style.css">
    <link rel="stylesheet" href="./Style/Form.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="Content">
        <h1>Dentist Booking System</h1>
        <?php
            
            $errorMsg;
            if (isset($_REQUEST["Login-Type"])) {
                //Details have been entered.
                $loginTable = "";
                $usernameAttr = "";
                if ($_REQUEST["Login-Type"] == "Patient") {
                    $loginTable = "Patient";
                    $usernameAttr = "patientID";
                } else {
                    $loginTable = "Dentist";
                    $usernameAttr = "dentistID";
                }
                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                $query = "SELECT $usernameAttr FROM $loginTable WHERE $usernameAttr = '$username' AND password = md5('$password')";
                $stmt = queryDatabase($query);
                $info = $stmt->fetch();
                if (empty($info)) {
                    //No patient with this username and password.
                    echo "<p>Incorrect username and/or password</p>";
                } else {
                    if ($loginTable == "Patient") {
                        session_start();
                        $_SESSION["username"] = $_REQUEST["username"];
                        header("Location: PatientHome.php", true, 301);
                        exit();
                    } else {
                        session_start();
                        $_SESSION["username"] = $_REQUEST["username"];
                        header("Location: StaffHome.php", true, 301);
                        exit();
                    }
                }

            }
            
        ?>      
        <div class="centerFields">
            <form action="" method="POST">
                <div class="loginType">
                    <input type="radio" name="Login-Type" value="Patient" checked> Patient
                    <input type="radio" name="Login-Type" value="Dentist"> Dentist
                </div>
                <div class="loginTextFields">
                    Username: <input type="text" name="username" id="userName" required> <br/>
                    Password: <input type="password" name="password" id="password" required>
                </div>
                <input class="submitButton" value="Login" type="submit">
            </form>
        </div>
        <script>

        </script>
    </div>
</body>
</html>