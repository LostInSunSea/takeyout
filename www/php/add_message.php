<?php
	/*
    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }
	*/
	
    $message = htmlspecialchars($_POST['message']);
    $from = htmlspecialchars($_POST['from']);
    $to = htmlspecialchars($_POST['to']);
    $convoID = htmlspecialchars($_POST['convoID']);

    if ($message = "")
    {
        die("Empty Message");
    }

    $dbHost = "http://kawaiikrew.net";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

//TODO: Add time

    $sql = "INSERT INTO reply (id, message, fromUser, toUser, time, conversation_id)
            VALUES (null, '$message', '$from', '$to', NULL, '$convoID')";

    if ($conn->query($sql) === TRUE)
    {
        echo $conn->insert_id;
    } else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>