<?php

    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $dbHost = 'localhost';
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $id = $_SESSION['id'];

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT( * ) AS num FROM meetingRequest WHERE receiveId = '$id'";

    if ($result=mysqli_query($conn,$sql)) {
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['num'];
        }
    }

    $conn -> close();

?>