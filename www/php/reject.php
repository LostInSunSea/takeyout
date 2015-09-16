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

    $tripId = $_POST['trip'];

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $otherUser = $_POST["otherUser"];

    $sql = "INSERT INTO rejection (id, sentId, receiveId, tripId) VALUES (NULL, '$id', '$otherUser', $tripId)";

    if (mysqli_query($conn, $sql))
    {
        echo "Success";
    }

?>