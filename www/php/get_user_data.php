<?php

    session_start();

    $user = array(
        'ID' => $_SESSION['id'],
        'Name' => $_SESSION['name'],
        'PicURL' => $_SESSION['picUrl'],
    );

    $jsonstring = json_encode($user);
    echo $jsonstring;

?>