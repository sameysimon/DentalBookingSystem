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
            function queryDatabase($query) {
                $db_hostname = "studdb.csc.liv.ac.uk";
                $db_database = "sgskolke";
                $db_username = "sgskolke";
                $db_password = "psimon";
                $db_charset = "utf8mb4";
              
                $dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset";
                $opt = array(
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false);
                try {
                  $pdo = new PDO($dsn,$db_username,$db_password,$opt);
                  return $pdo->query($query); 
                } catch (\Throwable $th) {
                  exit("PDO Error: ".$e->getMessage()."<br>");
                }
            }
            $errorMsg;
            if (is_set($_REQUEST["Login-Type"]) == false) {
                //Details have been entered.
                $loginTable
                $usernameAttr;
                if ($_REQUEST["Login-Type"] == "Patient") {
                    $loginTable = "Patient";
                    $usernameAttr = "patientID";
                } else {
                    $loginTable = "Dentist";
                    $usernameAttr = "dentistID";
                }
                $stmt = queryDatabase("SELECT $usernameAttr, password FROM $loginTable WHERE $usernameAttr = '", $_REQUEST['username'], "' AND password = '", $_REQUEST['password'], "'");
                $info = $stmt->fetch();
                if (empty($info)) {
                    //No patient with this username and password.
                    echo "<p>Incorrect username and/or password</p>"
                } else {
                    if ($loginTable == "Patient") {
                        session_start();
                        $_SESSION["username"] = $_REQUEST["username"];
                        header("Location: PatientHome.php", true, 301);
                        exit();
                    } else {
                        
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