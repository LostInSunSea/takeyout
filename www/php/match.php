<?php
    header('Access-Control-Allow-Origin: *');

    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }
    $id = $_SESSION["id"];

    //$id = 'A0BwIAdiU9';

    $city = htmlspecialchars($_GET['city']);
    $country = htmlspecialchars($_GET['country']);
    $type = htmlspecialchars($_GET['type']);

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

    if ($type == "Travel")
    {
        $sql = "SELECT * FROM user WHERE id <> '$id' AND city = '$city' AND country = '$country' LIMIT 10";
    }
    else
    {
        //TODO: Select users who have a trip here on overlapping days
        exit ('[]');
    }

    if($result=mysqli_query($conn,$sql))
    {
        while($row = mysqli_fetch_array ($result))
        {
            $bus = array(
                'name' => $row['name'],
                'headline' => $row['headline'],
                'city' => $row['city'],
                'country' => $row['country'],
                'picFull' => $row['picFull'],
                'bio' => $row['bio'],
                'languages' => $row['languages'],
                'favoriteFoods' => $row['favoriteFoods']
            );
            array_push($json, $bus);
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    $conn->close();

?>