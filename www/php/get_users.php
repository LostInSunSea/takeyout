<?php

    //TODO: Implement matching algorithm
    //TODO: Implement rejected database to not show people the user has already rejected

    session_start();
    $myId = $_SESSION['ID'];


    $dbHost = "http://kawaiikrew.net";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM User WHERE id <> '$myId'";

    if ($result = mysqli_query($conn, $sql))
    {
        if (mysqli_num_rows($result))
        {
            $json = array();
            while($row = mysqli_fetch_array ($result))
            {
                $bus = array(
                    'id' => $row['id'],
                    'job' => $row['job'],
                    'name' => $row['name'],
                    'location' => $row['location'],
                    'pictureurl' => $row['pictureurl'],
                    'industry' => $row['industry'],
                    'tagline' => $row['tagline'],
                    'bio' => $row['bio']
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