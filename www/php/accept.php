<?php

    /*session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }*/

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

    $otherUser = $_GET["otherUser"];

    //$sql = "SELECT * FROM accept WHERE receiveId = '$id' AND sentId = '$otherUser'";
    $sql = "SELECT * FROM accept";

    if ($result=mysqli_query($conn,$sql))
    {
        if ($result->num_rows)
        {
            echo "Found";
        }
        else
        {
            echo "Not found";
        }
    }

?>