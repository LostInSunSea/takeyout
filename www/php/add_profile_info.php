<?php

    header('Access-Control-Allow-Origin: *');
    session_start();

    //TODO: uncomment later
    /*if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }*/

    $bio = htmlspecialchars($_POST['bio']);
    $city = htmlspecialchars($_POST['city']);
    $country = htmlspecialchars($_POST['country']);
    $preferences = htmlspecialchars($_POST['preferences']);
    $languages = htmlspecialchars($_POST['languages']);
    $favoriteFoods = htmlspecialchars($_POST['favoriteFoods']);

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