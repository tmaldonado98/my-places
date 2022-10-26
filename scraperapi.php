<?php
//move this to another php file and include it here.
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);


$data = [
   "q" => $country, $city, $landmark,  
   "tbm" => "isch",
   "num" => "5",
];

curl_setopt($ch, CURLOPT_URL,   'https://customsearch.googleapis.com/customsearch/v1?key=AIzaSyAHakO0K7mac852qUCsJxSq0sozCCvy-xA&cx=22bdf86666de74d21%20&filter=1&q=?randomsearch&searchType=image');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    // "apikey: 1a3be160-2e79-11ed-85ee-2bfcdd59e9c8",  
));

$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);

var_dump($json);



/*
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://duckduckgo-duckduckgo-zero-click-info.p.rapidapi.com/?q=?$country,$city,$landmark&format=json&skip_disambig=1&no_redirect=1&no_html=1&callback=process_duckduckgo",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: duckduckgo-duckduckgo-zero-click-info.p.rapidapi.com",
		"X-RapidAPI-Key: 39895f3948mshc954d1855356b54p15bcacjsn1c6cdc2ab2cd"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

$json = json_decode($response);

var_dump($json);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
*/


/*
$image_results = $json['image_results'];

    echo '<div id=container-figure>'; 
foreach($image_results as $result) {
    $source = $result['sourceUrl'];
 

    echo '<figure class=figure-img>
    <img class=img src="'.$source.'">
    </figure>';
    '</div>';
}

// curl \;
//   'https://customsearch.googleapis.com/customsearch/v1?cx=22bdf86666de74d21%20&filter=1&q=enterqueryhere&searchType=image&key=[AIzaSyAHakO0K7mac852qUCsJxSq0sozCCvy-xA ]' \;
//   --header 'Accept: application/json' \;
//   --compressed;
*/
?>
