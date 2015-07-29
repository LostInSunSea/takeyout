<?php

    $response = http_get("https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=75d2ob10meoc3a&redirect_uri=http://kawaiikrew.net/www/php/authcallback.php&state=987654321&scope=r_basicprofile", array("timeout"=>1), $info);

    echo $info;
?>