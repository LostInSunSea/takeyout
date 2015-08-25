<?php

    session_start();
    /*if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }
    $id = $_SESSION["id"];*/

    $id = 'A0BwIAdiU9';

    $city = htmlspecialchars($_GET['city']);
    $country = htmlspecialchars($_GET['country']);

    echo $city;
    echo $country;

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

    $sql = "SELECT * FROM user WHERE id <> '$id' AND city = '$city' AND country = '$country'";

    if($result=mysqli_query($conn,$sql))
    {
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

    $conn->close();

?>