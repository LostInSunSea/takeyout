<?php

    session_start();
    $ID = htmlspecialchars($_GET['conversationID']);

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "yourpasswordhere";
    $dbDatabase = "test";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM reply WHERE conversation_id = '$ID'";
    if ($result=mysqli_query($conn,$sql))
    {
        if (mysqli_num_rows($result))
        {
            $json = array();
            while($row = mysqli_fetch_array ($result))
            {
                $bus = array(
                    'message' => $row['message'],
                    'from' => $row['from_user'],
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
$conn->close();

?>