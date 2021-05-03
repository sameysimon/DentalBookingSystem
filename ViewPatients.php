<?php 
    session_start();
    include 'FunctionLibrary/CheckLogin.php';//Check if user is logged in. If not, kick.
    include 'FunctionLibrary/PatientTable.php';//Import appointment Table generator.
    
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
    <a href="./StaffHome.php"><button class="BackButton">Home</button></a>
        <h1>View Patients</h1>
        <div class="equipmentTable">
            <p>Below are your patients: </p>
            <?php getPatients($_SESSION["username"]); ?>
            
        </div>
    </div>
</body>

</html>