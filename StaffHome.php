<?php 
    session_start();
    include 'FunctionLibrary/QueryDatabase.php';
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
        if (isset($_SESSION["username"]) == false) {
            //Hasn't logged in yet, send to login page.
            header("Location: Login.php");
            session_abort();
            exit();
        }
        $patientID = $_SESSION["username"];
        echo $patientID;
        $stmt = queryDatabase("SELECT Dentist.name AS 'Dentist_Name' FROM Dentist WHERE Dentist.dentistID = Patient.dentistID");
        $info = $stmt->fetch();
    ?>
    <div class="Content">
        <?php
            echo "<h1>Welcome, " . $info["Dentist_Name"] . ".</h1>";
        ?>
        <div class="options">
            <a href=""><button>Create an appointment</button></a>
            <a href=""><button>View appointments</button></a>
            <a href=""><button>Book Equipment</button></a>
            <a href=""><button>View patients</button></a>
            <a href=""><button>Quit</button></a>
        </div>
        <div class="info">
            <p>(Static) Your next appointment is with Mr Simon Kolker on June 23rd, 2020.</p>
        </div>
    </div>
</body>
</html>