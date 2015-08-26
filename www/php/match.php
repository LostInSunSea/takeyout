<?php
    header('Access-Control-Allow-Origin: *');

    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }
    $id = $_SESSION["id"];

    //$id = 'A0BwIAdiU9';

    //$city = htmlspecialchars($_GET['city']);
    //$country = htmlspecialchars($_GET['country']);
    $type = htmlspecialchars($_GET['type']);
    $key = htmlspecialchars($_GET['key']);
    $city;
    $country;

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
        $sql = "SELECT * FROM trip WHERE id = '$key'";
        if ($tripResult=mysqli_query($conn,$sql))
        {
            while($row = mysqli_fetch_array($tripResult))
            {
                $city = $row['city'];
                $country = $row['country'];
                $finalSQL = "SELECT * FROM user WHERE id <> '$id' AND city = '$city' AND country = '$country' LIMIT 10";
            }
        }
    }
    else if ($type == "Hometown")
    {
        $getCurHometown = "SELECT * FROM user WHERE id = '$id'";
        if ($curUserResult = mysqli_query($conn,$getCurHometown))
        {
            while ($row = mysqli_fetch_array($curUserResult))
            {
                $city = $row['city'];
                $country = $row['country'];
                date_default_timezone_set("America/Tijuana");
                $curDate = date("Y-m-d");
                $finalSQL = "SELECT user.id, user.name, user.headline, user.industry, user.city, user.country, user.picFull, user.bio, user.languages, user.favoriteFoods
                                     FROM trip INNER JOIN user ON trip.owner = user.id WHERE $curDate > trip.startDate AND $curDate < trip.endDate LIMIT 10;";
            }
        }
        exit ('[]');
    }

    if($result=mysqli_query($conn,$finalSQL))
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