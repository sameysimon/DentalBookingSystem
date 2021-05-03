<?php 
    include 'FunctionLibrary/QueryDatabase.php';//Import Database interaction methods
    function getAppointments($dentistID) {
        //Query database for all appointments for this dentist:
        $stmt = queryDatabase("SELECT DISTINCT Appointment.appointmentID AS ID, Patient.name AS PatientName, cast(Appointment.startTime as Date) AS Date, cast(Appointment.startTime as time) AS StartTime, cast(Appointment.endTime as time) AS EndTime, Appointment.status AS Status
        FROM Appointment, Patient
        WHERE Patient.patientID = Appointment.patientID AND Appointment.dentistID = '$dentistID'
        ORDER BY Date DESC");
        echo "<table class='table'>
            <tr>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th></th>";
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["PatientName"] . "</td>";
            echo "<td>" . $row["Date"] . "</td>";
            echo "<td>" . $row["StartTime"] . "</td>";
            echo "<td>" . $row["EndTime"] . "</td>";
            echo "<td>" . $row["Status"] . "</td>";
            echo "<td><a href='../EditAppointment.php?appointmentID=" . $row["ID"] . "'><button>Edit Appointment</button></a></td>";
            echo '</tr>';
        }
        echo '</tr></table>';
    }
    
?>
