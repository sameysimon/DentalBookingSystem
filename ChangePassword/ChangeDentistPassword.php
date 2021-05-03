<?php 
    session_start();
    include 'FunctionLibrary/QueryDatabase.php';
    include 'FunctionLibrary/CheckLogin.php';//Check if user is logged in. If not, kick.
    
     
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../Style/Style.css">
    <link rel="stylesheet" href="../Style/Table.css">
    <link rel="stylesheet" href="../Style/Form.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="Content">
        <h1>Change Your Password:</h1>
        <div class="centerFields">
        <?php
            $success = false;
            if (isset($_REQUEST['oldPassword'])) {
                //Has entered new password:
                
                $stmt = queryDatabase("SELECT password FROM Dentist WHERE dentistID = '" . $_SESSION['username'] . "'");
                $info = $stmt->fetch();
                $hash = md5($_REQUEST['oldPassword']);
                if ((strcmp(md5($_REQUEST['oldPassword']), $info['password']) == 0)) {
                    //User entered their old password correctly
                    if (strcmp($_REQUEST['firstNewPassword'], $_REQUEST['secondNewPassword']) == 0) {
                        queryDatabase("UPDATE Dentist SET password = md5('" . $_REQUEST['firstNewPassword'] . "') WHERE dentistID = '" . $_SESSION['username'] . "'");
                        $success = true;
                        echo "<p>Success! Password Changed!";
                    } else {
                        echo ("<p>Passwords different</p>");
                    }

                    
                }
                if (success == false) {
                    echo "<p>You entered a detail incorrectly. Please try again.</p>";
                }

            }
            if ($success == false) {
                echo "<form method='POST' action=''><div class='smallTextFields'>";
                echo "<label for='oldPassword'>Enter old password: </label><input type='text' name='oldPassword'></br>";
                echo "<label for='firstNewPassword'>Enter new password: </label><input type='text' name='firstNewPassword'></br>";
                echo "<label for='secondtNewPassword'>Enter new password: </label><input type='text' name='secondNewPassword'></br>";
                echo "<input type='hidden' name='userType' value='" . $_GET['userType'] . "'>";
                echo "<input type='submit'>";
                echo "</form></div>";
            }
        ?>
        </div>
    </div>
</body>

</html>