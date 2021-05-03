<?php 
    session_start();
    include 'FunctionLibrary/QueryDatabase.php';
    include 'FunctionLibrary/CheckLogin.php';
    if (isset($_SESSION["branchID"]) == false) {
        //Don't have branch ID yet as Session variable, so grab it.
        $username = $_SESSION["username"];
        $stmt = queryDatabase("SELECT branchID FROM Dentist WHERE dentistID = '" . $_SESSION["username"] . "'");//Get branch ID for this dentist.
        $info = $stmt->fetch();
        $_SESSION["branchID"] = $info["branchID"];
    }
    //Grab equipment for this branch.
    $stmt = queryDatabase("SELECT equipmentName, equipmentID FROM Equipment WHERE branchID = '" . $_SESSION["branchID"] . "'");
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
        <h1>View Equipment</h1>
        <div class="equipmentTable">
            <p>Below is the equipment accessable at the branch.</p>
            <table class="table">
            <tr>
                <th>Equipment Name</th>
                <th>Equipment ID</th>
                <th></th>
                <?php
                echo "<form method='GET' id='equipmentForm' action='./BookEquipment.php'></form>";
                    while ($row = $stmt->fetch()) {
                        echo '<tr>';
                        echo "<td>" . $row["equipmentName"] . "</td>";
                        echo "<td>" . $row["equipmentID"] . "</td>";
                        echo "<td><a href='./BookEquipment.php?equipmentID=" . $row["equipmentID"] . "'><button>Book " . $row["equipmentName"] . "</button></a></td>";
                        echo '</tr>';
                      }
                ?>
            </tr>
            
            </table>
            
        </div>
    </div>
</body>
</html>