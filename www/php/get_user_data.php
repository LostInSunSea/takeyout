<?php

    session_start();
    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $user = array(
        'ID' => $_SESSION['id'],
        'Name' => $_SESSION['name'],
        'PicURL' => $_SESSION['picUrl'],
    );

    $jsonstring = json_encode($user);
    echo $jsonstring;

?>