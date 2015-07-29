<?php

parse_str($_SERVER['QUERY_STRING']);
echo $code;
echo $state;

/*$fields = array(
  'Host' => 'www.linkedin.com',
  'Content-Type' => 'application/x-www-form-urlencoded'
);
$files = array();
$response = http_post_fields("https://www.linkedin.com/uas/oauth2/accessToken?" +
                             "grant_type=authorization_code&" +
                             "code=987654321&" +
                             "redirect_uri=https%3A%2F%2Fwww.myapp.com%2Fauth%2Flinkedin&" +
                             "client_id=123456789" +
                             "&client_secret=shhdonottell", $fields, $files);*/

?>