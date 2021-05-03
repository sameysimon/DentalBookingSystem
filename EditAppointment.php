<?php 
    session_start();
    include 'FunctionLibrary/QueryDatabase.php';
    include 'FunctionLibrary/CheckLogin.php';
    include 'FunctionLibrary/isTimeConflicting.php';

    function getInformation($previousDetails) {
        $statusOptions = array("Canceled", "Pending");//Default options to patient
        echo '<form action="" method="POST">';
        if (strcmp($_SESSION["userType"], "Dentist") == 0) {
            echo "dentist";
            //Dentist Selecting their Patient:
            echo "<label for='Patient'>Enter Patient</label><select required name='patientID'>";
            $dentistID = $_SESSION['username'];
            $stmt = queryDatabase("SELECT name, patientID FROM Patient WHERE dentistID = '$dentistID'");
            while ($row = $stmt->fetch()) {
                if (strcmp($previousDetails["patientID"], $row["patientID"]) == 0) {
                    //This is the patient previously booked for this appointment, set them to be selected.
                    echo "<option selected value='" . $row["patientID"] ."'>" . $row["name"] . " with ID " . $row["patientID"] . "</option>";
                } else {
                    //This is not the patient previously booked for this appointment, if there is one.
                    echo "<option value='" . $row["patientID"] ."'>" . $row["name"] . " with ID " . $row["patientID"] . "</option>";
                }
                
            }
            echo "</select></br>";
            echo "<input type='hidden' value='" . $_SESSION["username"] . "' name='dentistID'>";
            $statusOptions = array("Confirmed", "Canceled", "Complete", "Pending");

        } else {
            $patientID = $_SESSION["username"];
            echo "<input type='hidden' name='patientID' value='$patientID'>";
            $stmt = queryDatabase("SELECT name FROM Patient WHERE patientID = '$patientID'");
            $info = $stmt->fetch();
            echo "Patient";
            echo "<p>Appointment for " . $info["name"] . " </p>";
        }
        echo "<select name='status'>";
        foreach ($statusOptions as $key => $value) {
            if (strcmp($previousDetails['status'], $value) == 0) {
                //This is the previous status So pre-select it.
                echo "<option selected value='$value'>$value</option>";
            } else {
                //This isn't the previous status, if there is one.
                echo "<option selected value='$value'>$value</option>";
            }

        }
        echo "</select></br>";
        if (isset($previousDetails['startTime'])) {
            //There are previous time and date options:
            echo '<label for="startTime">Enter a start time: </label>';
            echo '<input required type="text" name="startTime" value="', $previousDetails["startTime"], '">';
            echo '<label for="endTime">Enter an end time: </label>';
            echo '<input type="text" name="endTime" value="', $previousDetails["endTime"], '">';

        } else {
            echo '<label for="startTime">Enter a start time: </label>';
            echo '<input required type="text" name="startTime"></br>';
            echo '<label for="endTime">Enter an end time: </label>';
            echo '<input required type="text" name="endTime"></br>';
        }
        
        if (isset($_GET["appointmentID"])) {
            //This apppointment has already been made, we are simply editing it.
            echo "<input type='hidden' value='" . $_GET["appointmentID"] . "' name='appointmentID'>";
        }
        echo "<input type='submit' value='Submit'>";
    }


?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="./Style/Style.css">
    <link rel="stylesheet" href="./Style/Table.css">
    <link rel="stylesheet" href="./Style/Form.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
</head>
<body>

    <div class="Content">
        <a href="./StaffHome.php"><button class="BackButton">Home</button></a>
        <h1>Appointment  Page</h1>
        <div class="smallTextFields">
                <?php
                    if (isset($_REQUEST["appointmentID"])) {
                        //edit appointment with request's details
                        echo "<p>appointmentID recieved meaning we are editing an appointment.</p>";
                        $dentistID = "";
                        $patientID = "";
                        if (strcmp($_SESSION['userType'], "Dentist")) {
                            $dentistID = $_SESSION['username'];
                        } else {
                            $stmt = queryDatabse("SELECT dentistID FROM Patient WHERE patientID = '" . $_SESSION['username'] . "'");
                            $info = $stmt->fetch();
                            $dentistID = $info["dentistID"];
                        }
                        if (isTimeConflicting($dentistID, $_REQUEST["startTime"], $_REQUEST["endTime"])) {
                            echo "<p>Sorry, this place is booked.</p>";
                        } else {
                            queryDatabase("UPDATE Appointment
                            SET dentistID = '$dentistID', startTime = '" . $_REQUEST['startTime'] ."', patientID = '$patientID', endTime = '" . $_REQUEST['endTime'] . "', status = '" . $_REQUEST['status'] ."'
                            WHERE appointmentID = '12345'");
                            echo "<p>Congratulations! Appointment edited.</p>";
                        }
                    } else if (isset($_REQUEST["startTime"])) {
                        //Create appointment with result's details
                        echo "<p>no appointment, but startTime recieved meaning we are generating a new appointment</p>";
                        $dentistID = "";
                        $patientID = "";
                        if (strcmp($_SESSION['userType'], "Dentist")) {
                            $dentistID = $_SESSION['username'];
                        } else {
                            $stmt = queryDatabse("SELECT dentistID FROM Patient WHERE patientID = '" . $_SESSION['username'] . "'");
                            $info = $stmt->fetch();
                            $dentistID = $info["dentistID"];
                        }
                        if (isTimeConflicting($dentistID, $_REQUEST["startTime"], $_REQUEST["endTime"])) {
                            echo "<p>Sorry, this place is booked.</p>";
                        } else {
                            queryDatabase("INSERT INTO Appointment (dentistID, patientID, startTime, endTime, status) VALUES ('$dentistID', '$patientID', '" . $_REQUEST['startTime'] ."', '" . $_REQUEST['endTime'] . "', '" . $_REQUEST['status'] . "'");
                            echo "<p>Congratulations! Appointment made.</p>";
                        }
                    } else {
                        //User just arrived. Get Details
                        echo "<p>no time or appointment recieved, so still need to get them</p>";
                        if (isset($_GET["appointmentID"])) {
                            echo "<p>Do have an existing appointment though.</p>";
                            $stmt = queryDatabase("SELECT * FROM Appointment WHERE appointmentID = '" . $_GET['appointmentID'] ."'");
                            $previous = $stmt->fetch();
                            getInformation($previous)
                        }
                        
                    }
                   

                    
                ?>
        </div>
    
    </div>
</body>
</html>
