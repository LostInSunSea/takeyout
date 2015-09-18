<?php
    header('Access-Control-Allow-Origin: *');
	/*
    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }
	*/
    $id = $_GET["id"];

    //$id = 'A0BwIAdiU9';
    function httpGet($url)
	{
    	$ch = curl_init();  
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//  curl_setopt($ch,CURLOPT_HEADER, false); 
		$output=curl_exec($ch); 
		curl_close($ch);
		return $output;
	}

    //TODO: call auto_delete_trips.php here

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
                    'id' => $row['id'],
                    'city' => $row['city'],
                    'country' => $row['country'],
                    'startDate' => null,
                    'endDate' => null,
                    'backgroundImage' => null
                );
                
                $url='http://kawaiikrew.net/www/php/get_trip_picture.php?city=' . $row['city'] . "&country=" . $row['country'];
                $resp = httpGet($url);
                echo($url);
                echo("\n");
                echo($resp);
                echo("\n");
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

    $sql = "SELECT * FROM trip WHERE owner = '$id' AND active = 1 ORDER BY startDate ASC";
    if ($tripResult=mysqli_query($conn,$sql))
    {
        while($row = mysqli_fetch_array ($tripResult))
        {
            $bus = array(
                'id' => $row['id'],
                'city' => $row['city'],
                'country' => $row['country'],
                'startDate' => $row['startDate'],
                'endDate' => $row['endDate'],
                'backgroundImage' => null
            );
            $url='http://kawaiikrew.net/www/php/get_trip_picture.php?city=' . $row['city'] . "&country=" . $row['country'];
            $resp = httpGet($url);
            echo($url);
            echo("\n");
			echo($resp);
			echo("\n");
            $bus['backgroundImage'] = $resp;
            array_push($json, $bus);
        }
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }
    $jsonstring = json_encode($json);
    echo("\n");
    echo $jsonstring;

?>