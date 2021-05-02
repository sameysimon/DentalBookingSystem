<?php
if (isset($_SESSION["username"]) == false) {
            //Hasn't logged in yet, send to login page.
            header("Location: Login.php");
            session_abort();
            exit();
}
?>