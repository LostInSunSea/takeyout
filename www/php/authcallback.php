<?php

parse_str($_SERVER['QUERY_STRING']);

$fields = array(
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

echo $response;
echo "this is a test";
?>