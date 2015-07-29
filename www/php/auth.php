<?php
header("Access-Control-Allow-Origin: https://static.licdn.com");
$curl = curl_init('https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=75d2ob10meoc3a&redirect_uri=http%3A%2F%2Fkawaiikrew.net%2Fwww%2Fphp%2Fauthcallback.php&state=987654321&scope=r_basicprofile');

$resp = curl_exec($curl);
echo $resp;

?>