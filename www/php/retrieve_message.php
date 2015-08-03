<?php

    session_start();
    $ID = htmlspecialchars($_GET['conversationID']);
    $limit = htmlspecialchars($_GET['limit']);

    $dbHost = 'localhost';
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    //If limit > # of rows to retrieve, retrieve the total # of rows
    $countQuery = "SELECT COUNT(*) FROM reply";
    $result1 = mysqli_query($conn, $countQuery);
    $countRow = $result1->fetch_assoc();
    $num = $countRow['COUNT(*)'];
    if ($num < $limit)
    {
        $sql = "SELECT * FROM (SELECT * FROM reply WHERE conversationId = '$ID' ORDER BY id DESC LIMIT $num) sub ORDER BY id ASC";
    }
    else
    {
        $sql = "SELECT * FROM (SELECT * FROM reply WHERE conversationId = '$ID' ORDER BY id DESC LIMIT $limit) sub ORDER BY id ASC";
    }
    if ($result2=mysqli_query($conn,$sql))
    {
        if (mysqli_num_rows($result2))
        {
            $json = array();
            while($row = mysqli_fetch_array ($result2))
            {
                $bus = array(
                    'id' => $row['id'],
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