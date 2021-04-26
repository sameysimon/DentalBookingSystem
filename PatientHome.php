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
            //Hasn't logged in yet, send back to login page.
            header("Location: Login.php");
            exit();
        }
        $username = ;
    ?>
    <div class="Content">
        <h1>Welcome, Simon</h1>
        <div class="options">
            <a href=""><button>Request an appointment</button></a>
            <a href=""><button>View next appointment</button></a>
            <a href=""><button>Quit</button></a>
        </div>
        <div class="info">
            <p>You last had an appointment with us on the June 23rd, 2020.</p>
            <p>Your dentist is Dr. Mainwaring.</p>
        </div>
    </div>
</body>
</html>