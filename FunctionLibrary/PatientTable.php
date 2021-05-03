<?php 
    include 'FunctionLibrary/QueryDatabase.php';//Import Database interaction methods
    function getPatients($dentistID) {
        //Query database for all information for this dentist:
        $stmt = queryDatabase("SELECT DISTINCT Patient.patientID AS ID, Patient.name AS Name, Patient.patientNotes AS Notes, MAX(Appointment.startTime) AS Date
        FROM Appointment, Patient
        WHERE Patient.patientID = Appointment.patientID AND Appointment.dentistID = '$dentistID'
        GROUP BY Name, Notes, ID
        ORDER BY Date DESC");
        echo "<table class='table'>
            <tr>
                <th>Patient Name</th>
                <th>Next Appointment</th>
                <th>Notes</th>
                <th></th>";
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Date"] . "</td>";
            echo "<td>" . $row["Notes"] . "</td>";
            echo "<td><a href='./PatientDetails.php?patientID=" . $row["ID"] . "'><button>View Patient</button></a></td>";
            echo '</tr>';
        }
        echo '</tr></table>';
    }
    
?>
