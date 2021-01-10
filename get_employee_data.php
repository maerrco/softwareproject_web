<?php
include("face_api_functions.php");

$get_data = callAPI('GET', 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/employees/persons?top=1000', "");
// echo $get_data;
$response = json_decode($get_data, true);
$errors = $response['response']['errors'];
$data = $response['response']['data'][0];

 ?>