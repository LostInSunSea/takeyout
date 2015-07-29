<?php
/*$curl = curl_init('https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=75d2ob10meoc3a&redirect_uri=https%3A%2F%2Fwww.example.com%2Fauth%2Flinkedin&state=987654321&scope=r_basicprofile');

$resp = curl_exec($curl);
echo $resp;*/

require('lib/http.php');
require('lib/oauth_client.php');

$client->server = 'LinkedIn';
$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].
    dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/auth.php';
$client->client_id = '75d2ob10meoc3a';
$application_line = __LINE__;
$client->client_secret = 'zQ5SUiuhMRDG0tpk';
$client->scope = 'r_fullprofile r_emailaddress';

?>