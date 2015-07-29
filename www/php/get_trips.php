<?php

    //session_start();
    $json = array();
    $bus = array(
        'city' => 'Menlo Park',
        'country' => 'us',
        'startDate' => null,
        'endDate' => null,
        'backgroundImage' => 'http://sf.streetsblog.org/wp-content/uploads/sites/3/2014/11/San_Bruno_El_Camino_and_San_Mateo_Ave.png'
    );
    array_push($json, $bus);
    $bus = array(
        'city' => 'New York',
        'country' => 'us',
        'startDate' => '2015-8-3',
        'endDate' => '2015-8-12',
        'backgroundImage' => 'http://media.timeout.com/images/101705313/image.jpg'
    );
    array_push($json, $bus);
    $bus = array(
        'city' => 'Beijing',
        'country' => 'cn',
        'startDate' => '2015-8-17',
        'endDate' => '2015-9-3',
        'backgroundImage' => 'http://www.echinaexpat.com/Portals/0/eChinaExpat/China%20Travel/beijingcity.jpg'
    );
    array_push($json, $bus);
    $bus = array(
        'city' => 'Tokyo',
        'country' => 'jp',
        'startDate' => '2015-9-10',
        'endDate' => '2015-9-13',
        'backgroundImage' => 'http://www.telegraph.co.uk/incoming/article115762.ece/ALTERNATES/w460/tokyo.jpg'
    );
    array_push($json, $bus);
    $jsonstring = json_encode($json);
    echo $jsonstring;

?>