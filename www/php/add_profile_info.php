<?php

    header('Access-Control-Allow-Origin: *');
    session_start();

    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $bio = $_POST['bio'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $preferences = $_POST['preferences'];
    $languages = $_POST['languages'];
    $interests = $_POST['interests'];

    $id = $_SESSION["id"];

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET bio = '$bio', city = '$city', country = '$country', preferences = '$preferences', languages = '$languages', interests = '$interests' WHERE id = '$id'";

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