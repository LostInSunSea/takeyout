<?php

    session_start();

    if (!isset($_SESSION['id']))
    {
        echo "Error: Not logged in!";
    }

    $tagLine = $_POST['Tagline'];
    $bio = $_POST['Bio'];

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

    $sql = "UPDATE User SET bio = '$bio', tagline = '$tagLine' WHERE id = '$id'";

    if (mysqli_query($conn, $sql))
    {
        header( 'Location: ../chatwindow.html' );
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $conn->close();

?>