<?php 
    session_start();
    include 'FunctionLibrary/QueryDatabase.php';
    include 'FunctionLibrary/CheckLogin.php';

?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="./Style/Style.css">
    <link rel="stylesheet" href="./Style/Home.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
</head>
<body>
    <?php
        $dentistID = $_SESSION["username"];
        
        $stmt = queryDatabase("SELECT name AS 'Dentist_Name' FROM Dentist WHERE dentistID = '" . $_SESSION["username"] . "'");
        $_SESSION["name"] = $info["Dentist_Name"];
        $info = $stmt->fetch();
    ?>
    <div class="Content">
        <?php
            echo "<h1>Welcome, " . $info["Dentist_Name"] . ".</h1>";
            session_abort();
        ?>
        <div class="options">
            <a href=""><button>Create an appointment</button></a>
            <a href="./ViewAppointments.php"><button>View appointments</button></a>
            <a href="./ViewEquipment.php"><button>Book/View Equipment</button></a>
            <a href=""><button>View patients</button></a>
            <a href=""><button>Change Password</button></a>
            <a href="FunctionLibrary/Logout.php"><button>Logout</button></a>
        </div>
        <div class="info">
            <p>(Static) Your next appointment is with Mr Simon Kolker on June 23rd, 2020.</p>
        </div>
    </div>
</body>
</html>