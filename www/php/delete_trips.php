<?php

session_start();
if (!isset($_SESSION['id']))
{
    exit ("Error: Not logged in!");
}

$dbHost = 'localhost';
$dbUser = "root";
$dbPass = "J^mpStrt";
$dbDatabase = "takeyout";

$tripId = $_POST['tripId'];
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
//gets the conversations id for future queries
$query  = "SELECT @cid := GROUP_CONCAT(id) FROM conversation WHERE tripId=$tripId"; 
$query .= "DELETE from trip where id=$tripId";
$query .= "DELETE from accept where tripId=$tripId";
$query .= "DELETE from reject where tripId=$tripId";
$query .= "DELETE from conversation where tripId=$tripId";
$query .= "delete from meeting where find_in_set(conversationId, @cid);";
$query .= "delete from meetingRequest where find_in_set(conversationId, @cid);";
$query .= "delete from reply where find_in_set(conversationId, @cid);";


if ($mysqli->multi_query($query)) {
    do {
        /* store first result set */
        if ($result = $mysqli->store_result()) {
            while ($row = $result->fetch_row()) {
                printf("%s\n", $row[0]);
            }
            $result->free();
        }
        /* print divider */
        if ($mysqli->more_results()) {
            printf("-----------------\n");
        }
    } while ($mysqli->next_result());
}
/* close connection */
$mysqli->close();

?>