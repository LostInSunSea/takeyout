<?php
    header('Access-Control-Allow-Origin: *');

    session_start();
    //TODO: uncomment the login check and also decide if I want to use session tokens or do SQL later on
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $id = $_SESSION['id'];

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id,name,picThumbnail FROM user WHERE id = '$id'";
    if ($result=mysqli_query($conn,$sql))
    {
        while ($row = mysqli_fetch_array($result))
        {
            $user = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'picThumbnail' => $row['picThumbnail']
            );
        }
    }
    $jsonstring = json_encode($user);
    echo $jsonstring;

?>