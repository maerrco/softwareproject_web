<?php
 include("face_api_functions.php");

 $get_data = callAPI('GET', 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/employees/training', "");
 // echo $get_data;
 $response = json_decode($get_data, true);
 $errors = $response['response']['errors'];
 $data = $response['response']['data'][0];


// $date_object = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $response["lastActionDateTime"]);
// echo $date_object->format('Y-m-d H:i:s');

$date = new DateTime($response["lastActionDateTime"], new DateTimeZone('Pacific/Auckland')); // Z = UTC
$date->add(new DateInterval('P0Y0M0DT12H0M0S'));
echo "Last trained: ". $date->format('H:i, d-m-Y') . PHP_EOL;
// $date =  ( DateTime $date ,new DateInterval("PT{12}H") ) : DateTime
// echo "Last trained: ". $date->format('H:i:s, d-m-Y') . PHP_EOL;

?>