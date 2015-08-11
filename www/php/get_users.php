<?php

    //TODO: Implement matching algorithm
    //TODO: Implement rejected database to not show people the user has already rejected

    session_start();

    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $myId = $_SESSION['id'];

    $dbHost = 'localhost';
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user WHERE id <> '$myId'";

    if ($result = mysqli_query($conn, $sql))
    {
        if (mysqli_num_rows($result))
        {
            $json = array();
            while($row = mysqli_fetch_array ($result))
            {
                $bus = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'headline' => $row['headline'],
                    'city' => $row['city'],
                    'country' => $row['country'],
                    'numPosReview' => $row['numPosReview'],
                    'tagline' => $row['tagline'],
                    'pic' => $row['picFull'],
                );
                array_push($json, $bus);
            }

            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
        else
        {
            echo '{}';
        }
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $conn->close();

?>