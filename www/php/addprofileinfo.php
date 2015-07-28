<?php

    session_start();

    if (!isset($_SESSION['ID']))
    {
        echo "Error: Not logged in!";
    }

    $tagLine = $_POST['Tagline'];
    $bio = $_POST['Bio'];

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