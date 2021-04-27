<?php
function queryDatabase($query) {
        $db_hostname = "studdb.csc.liv.ac.uk";
        $db_database = "sgskolke";
        $db_username = "sgskolke";
        $db_password = "psimon";
        $db_charset = "utf8mb4";
        $dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset";
        $opt = array(
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false);
        try {
            $pdo = new PDO($dsn,$db_username,$db_password,$opt);
            return $pdo->query($query); 
        } catch (\Throwable $th) {
            echo '<p>An error occurred.</p>';
            exit("PDO Error: ".$e->getMessage()."<br>");
        }
    }
?>