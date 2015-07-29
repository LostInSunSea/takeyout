<?php

parse_str($_SERVER['QUERY_STRING']);

/*$fields = array(
  'Host' => 'www.linkedin.com',
  'Content-Type' => 'application/x-www-form-urlencoded'
);
$files = array();
$response = http_post_fields("https://www.linkedin.com/uas/oauth2/accessToken?" +
                             "grant_type=authorization_code&" +
                             "code=" + $code + "&" +
                             "redirect_uri="+ "http%3A%2F%2Fkawaiikrew.net%2Fwww%2Fphp%2Fauthcallback.php" + "&" +
                             "client_id=75d2ob10meoc3a" +
                             "&client_secret=zQ5SUiuhMRDG0tpk", $fields, $files);

echo $response;*/

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://www.linkedin.com/uas/oauth2/accessToken");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    "grant_type=authorization_code&" . "code=" . $code . "&" . "redirect_uri=http%3A%2F%2Fkawaiikrew.net%2Fwww%2Fphp%2Fauthcallback.php&" . "client_id=75d2ob10meoc3a&" . "client_secret=zQ5SUiuhMRDG0tpk");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

$result = json_decode($server_output, true);

echo $result['access_token'];
?>