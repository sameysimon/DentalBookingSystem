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
        $stmt = queryDatabase("SELECT Patient.name AS 'Patient_Name', Dentist.name AS 'Dentist_Name' FROM Patient, Dentist WHERE Patient.PatientID = $patientID AND Dentist.dentistID = Patient.dentistID");
        $info = $stmt->fetch();
    ?>
    <div class="Content">
        <?php
            echo "<h1>Welcome, " . $info["Patient_Name"] . ".</h1>";
        ?>
        <div class="options">
            <a href=""><button>Request an appointment</button></a>
            <a href=""><button>View next appointment</button></a>
            <a href=""><button>Quit</button></a>
        </div>
        <div class="info">
            <?php
                echo "<p>Your next appointment with us is on the June 23rd, 2020.</p>";
                if (isset($info["Dentist_Name"])) {
                    echo "<p>Your current dentist is " . $info["Dentist_Name"] . ".</p>";
                }
                session_abort();
            ?>
        </div>
    </div>
</body>
</html>