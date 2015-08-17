<?php

    //TODO: Create background image database

    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $id = $_SESSION["id"];

    $ch = curl_init();

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
        //$countRow = $hometownResult->fetch_assoc();
        //$num = $countRow['COUNT(*)'];
        //if ($num == 1)
        //{
        //TODO: Uncomment this after more users in db
            while($row = mysqli_fetch_array ($hometownResult))
            {
                $bus = array(
                    'city' => $row['city'],
                    'country' => $row['country'],
                    'startDate' => null,
                    'endDate' => null,
                    'backgroundImage' => null
                );
                curl_setopt_array($ch, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'http://kawaiikrew.net/www/php/get_trip_picture.php?location=' . $row['city'] . ',%20' . $row['country'],
                    CURLOPT_USERAGENT => 'cURL Request'
                ));

                $resp = curl_exec($ch);
                $bus['backgroundImage'] = $resp;
                array_push($json, $bus);
            }
        //}
        //else
        //{
        //    echo "Error: More than 1 user retrieved";
        //}
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    //Get the other trips belonging to the user

    $sql = "SELECT * FROM trip WHERE owner = '$id' AND active = 1";
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

            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://kawaiikrew.net/www/php/get_trip_picture.php?location=' . $row['city'] . ',%20' . $row['country'],
                CURLOPT_USERAGENT => 'cURL Request'
            ));

            $resp = curl_exec($ch);
            $bus['backgroundImage'] = $resp;
            array_push($json, $bus);
        }
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }


    curl_close($ch);

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>