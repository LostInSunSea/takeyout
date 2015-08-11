<?php

    session_start();

    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $start = $_POST['Start'];
    $end = $_POST['End'];
    $country = $_POST['Country'];
    $city = $_POST['City'];

    $id = $_SESSION["id"];

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    date_default_timezone_set("America/Tijuana");

    if ($end < $start)
    {
        die ("Error: ending has to be after the start of the trip");
    }
    if ($end == $start)
    {
        die ("Error: cannot have a trip start and end on the same day");
    }

    if ($end < date("Y-m-d"))
    {
        die ("Error: Cannot have a end date before current date");
    }

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM trip WHERE owner = '$id'";
    if ($result = mysqli_query($conn, $sql))
    {
        if (mysqli_num_rows($result))
        {
            while($row = mysqli_fetch_array ($result))
            {
                // Make sure that the planned trip does not overlap with anything currently planned trip
                if (!(($start < $row['start'] && $end < $row['start']) || ($start > $row['end'] && $end > $row['end'])))
                {
                    die("Error: cannot schedule trip due to overlap");
                }
            }
        }
    }

$sql = "INSERT INTO trip (id, startDate, endDate, city, country, owner)
                VALUES (NULL, '$start', '$end', '$city', '$country', '$id')";

    if (mysqli_query($conn, $sql))
    {
        echo "Successfully inserted";
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $conn->close();

?>