<?php
	/*
    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }
	*/
	
    $text =  $_POST['text'];
    $from = htmlspecialchars($_POST['from']);
    $to = htmlspecialchars($_POST['to']);
    $convoID = htmlspecialchars($_POST['convoID']);
    $time=htmlspecialchars($_POST["time"]); 
    
    if ($message = "")
    {
        die("Empty Message");
    }

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

//TODO: Add time
	echo("world");
	echo($text);
    $sql = "INSERT INTO reply (id, message, fromUser, toUser, time, conversationId)
            VALUES (NULL, '$text', '$from', '$to', $time, '$convoID')";

    if ($conn->query($sql) === TRUE)
    {
        echo $conn->insert_id;
    } else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>