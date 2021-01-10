<?php
    $url = 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/employees/train';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
 
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Host: westus2.api.cognitive.microsoft.com',
        'Content-Type: application/json',
        'Content-Length: 0',
        'Ocp-Apim-Subscription-Key: d508f60d5c5a48b296e4e35e6e0f6402',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
    // EXECUTE:
    $result = curl_exec($curl);
    curl_close($curl);
    echo $result;

?>