<?php 
    session_start();
    include 'FunctionLibrary/CheckLogin.php';//Check if user is logged in. If not, kick.
    include 'FunctionLibrary/AppointmentTable.php';//Import appointment Table generator.
    
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
        <h1>View Appointments</h1>
        <div class="equipmentTable">
            <p>Below are your appointments: </p>
            <?php getAppointments($_SESSION["username"]); ?>
            
        </div>
    </div>
</body>
</html>