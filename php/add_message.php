<?php
    session_start();

    $message = htmlspecialchars($_POST['message']);
    $from = htmlspecialchars($_POST['from']);
    $to = htmlspecialchars($_POST['to']);
    $convoID = htmlspecialchars($_POST['convoID']);

    if ($message = "")
    {
        die("Empty Message");
    }

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "yourpasswordhere";
    $dbDatabase = "test";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO reply (id, message, from_user, to_user, ip, time, conversation_id)
            VALUES (NULL, '$message', '$from', '$to', NULL, NULL, '$convoID')";

    if ($conn->query($sql) === TRUE)
    {
        echo $conn->insert_id;
    } else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>