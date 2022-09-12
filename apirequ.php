<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

$data = [
   "q" => "Venice",
   "tbm" => "isch",
   "num" => "2",
];

curl_setopt($ch, CURLOPT_URL, "https://app.zenserp.com/api/v2/search?" . http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "apikey: 1a3be160-2e79-11ed-85ee-2bfcdd59e9c8",  
));

$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);

// print_r($json);
var_dump($json);

header('location: places.php');

/*
require 'path/to/google-search-results.php';
require 'path/to/restclient.php';

$query = [
 "engine" => "google",
 "q" => "Venice",
 "google_domain" => "google.com",
 "gl" => "us",
 "hl" => "en",
 "tbm" => "isch",
];

$search = new GoogleSearch('secret_api_key');
$result = $search->get_json($query);
*/

?>

