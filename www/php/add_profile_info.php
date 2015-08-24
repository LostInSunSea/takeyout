<?php

    header('Access-Control-Allow-Origin: *');
    session_start();

    //TODO: uncomment later
    /*if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }*/

    $bio = $_POST['bio'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $preferences = $_POST['preferences'];
    $languages = $_POST['languages'];
    $favoriteFoods = $_POST['favoriteFoods'];

    $id = 'A0BwIAdiU9';
    //$id = $_SESSION["id"];

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET bio = '$bio', city = '$city', country = '$country', preferences = '$preferences', languages = '$languages', favoriteFoods = '$favoriteFoods' WHERE id = '$id'";

    if (mysqli_query($conn, $sql))
    {
        echo $sql;
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $conn->close();

?>