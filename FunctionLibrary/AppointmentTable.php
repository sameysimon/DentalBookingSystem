<?php 
    include 'FunctionLibrary/QueryDatabase.php';//Import Database interaction methods
    function getAppointments($dentistID) {
        //Query database for all appointments for this dentist:
        $stmt = queryDatabase("SELECT DISTINCT Appointment.appointmentID AS ID, Patient.name AS PatientName ,Appointment.appointmentTime AS Time FROM Appointment, Patient WHERE Patient.patientID = Appointment.patientID AND Appointment.dentistID = '$dentistID'");
        echo "<table class='table'>
            <tr>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Date and Time</th>
                <th></th>";
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["PatientName"] . "</td>";
            echo "<td>" . $row["Time"] . "</td>";
            echo "<td><a href='../EditAppointment.php'><button>Edit Appointment</button></a></td>";
            echo '</tr>';
        }
        echo '</tr></table>';
    }
    
?>
