<?php

    session_start();

    $user = array(
        'ID' => $_SESSION['ID'],
        'Name' => $_SESSION['Name'],
        'PicURL' => $_SESSION['PicURL'],
    );

    $jsonstring = json_encode($user);
    echo $jsonstring;

?>