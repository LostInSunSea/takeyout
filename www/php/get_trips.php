<?php

    //TODO: Create background image database

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

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $json = array();

    //Get hometown, have startDate and endDate as null
    $sql = "SELECT * FROM user WHERE id = '$id'";
    if ($hometownResult=mysqli_query($conn,$sql))
    {
        if (mysqli_num_rows($result) == 1)
        {
            while($row = mysqli_fetch_array ($hometownResult))
            {
                $bus = array(
                    'city' => $row['city'],
                    'country' => $row['country'],
                    'startDate' => null,
                    'endDate' => null,
                    'backgroundImage' => null
                );
                array_push($json, $bus);
            }
        }
        else
        {
            echo "Error: More than 1 user retrieved";
        }
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    //Get the other trips belonging to the user

    $sql = "SELECT * FROM trips WHERE owner = '$id' AND active = 1";
    if ($tripResult=mysqli_query($conn,$sql))
    {
        while($row = mysqli_fetch_array ($tripResult))
        {
            $bus = array(
                'city' => $row['city'],
                'country' => $row['country'],
                'startDate' => $row['startDate'],
                'endDate' => $row['endDate'],
                'backgroundImage' => null
            );
            array_push($json, $bus);
        }
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>