<?php

    session_start();

    if (!isset($_SESSION['ID']))
    {
        echo "Error: Not logged in!";
    }

    $start = $_POST['Start'];
    $end = $_POST['End'];
    $country = $_POST['Country'];
    $city = $_POST['City'];

    $id = $_SESSION["ID"];

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "yourpasswordhere";
    $dbDatabase = "test";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Trip (id, country, city, owner, start, end)
            VALUES (NULL, '$country', '$city', '$id', '$start', '$end')";

    if (mysqli_query($conn, $sql))
    {
        echo "Successfully inserted";
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $conn->close();

?>