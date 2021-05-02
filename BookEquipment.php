<?php 
    session_start();
    include 'FunctionLibrary/QueryDatabase.php';
    include  'FunctionLibrary/CheckLogin.php';
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="./Style/Style.css">
    <link rel="stylesheet" href="./Style/Table.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="Content">
        
        <?php
            echo "<h1>Book Equipment ID: " . $_GET["equipmentID"] . "</h1>";
            $success = false;
            if (isset($_POST["appointment"]) == true) {
                echo "input";
                //Got input -> proccess input
                //Get the time for this appointment:
                $stmt = queryDatabase("SELECT appointmentTime AS Time FROM Appointment WHERE appointmentID = '" . $_POST["appointment"] . "'");
                $result = $stmt->fetch();
                $time = $result["Time"];
                echo "$time";
                //Check if there's an appointment using this equipment at this time:
                $stmt = queryDatabase("SELECT appointmentID FROM Appointment WHERE equipmentID = '" . $_GET["equipmentID"] . "' AND appointmentTime = '$time'");
                echo "input3";
                $conflicting = $stmt->fetch();
                if (empty($conflicting)) {
                    //There are no appointments using this equipment at the time of the appointment you selected!
                    queryDatabase("UPDATE Appointment SET equipmentID = '" . $_GET["equipmentID"] . "' WHERE appointmentID = '" . $_POST['appointment'] . "'");
                    echo "<h3>Reservation made! Congratulations!</h3>";
                    echo "<a href='./StaffHome.php'><button>Staff Home</button></a>"
                    $success = true;
                } else {
                    //The equipment isn't available.
                    echo "<p>This piece of equipment in use at this time.</p>";
                   
                    
                }
            }
            if (isset($_POST["appointment"]) == false || $success == false) {
                //No input -> get input
                echo "No input";
                echo "<form action='' method='POST'>";
                $stmt = queryDatabase('SELECT Patient.name AS Name, Appointment.appointmentTime AS Time, Appointment.appointmentID AS ID FROM Patient, Appointment WHERE Appointment.dentistID = "' . $_SESSION["username"] . '" AND Appointment.PatientID = Patient.PatientID');
                $radioIndex = 0;
                while ($row = $stmt->fetch()) {
                    echo "<input type='radio' name='appointment' id=$radioIndex value='" . $row["ID"] . "'>";
                    echo "<label for='$radioIndex'>Reserve for " . $row["Time"] . " with " . $row["Name"] . ", appointment ID " . $row["ID"] . "</label><br>";
                    $radioIndex = $radioIndex + 1;
                }
                if ($radioIndex == 0) {
                    //There were no appointments.
                    echo "<h3>Hooray! You have no appointments.</h3>";
                } else {
                    echo "<input type='submit' value='Reserve Equipment'>";
                }
                
                echo "</form>";
            }
        ?>
        
        </div>
    </div>
</body>
</html>