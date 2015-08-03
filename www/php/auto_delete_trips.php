<?php

    session_start();

    if (!isset($_SESSION['id']))
    {
        echo "Error: Not logged in!";
    }

    $id = $_SESSION["id"];

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    date_default_timezone_set("America/Tijuana");

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $curDate = date("Y-m-d");


    $sql = "UPDATE trip SET active = 0 WHERE endDate < curDate";
    if (mysqli_query($conn, $sql))
    {
        echo "Success";
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $conn->close();

?>