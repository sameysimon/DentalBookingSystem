<?php 
    session_start();
    include 'FunctionLibrary/CheckLogin.php';//Check if user is logged in. If not, kick.
    
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="./Style/Style.css">

    <title>Patient Details</title>

</head>

<body>
<div class="Content">
    <p>Patient Details:</p>
    <?php
    $stmt = queryDatabase("SELECT Patient.patientID AS ID, Patient.name AS Name

    ?>
</div>

</body>

</html>