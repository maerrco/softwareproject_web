<?php

function callAPI($method, $url, $data){
    $curl = curl_init();
 
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       case "DELETE":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
 
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Host: westus2.api.cognitive.microsoft.com',
        'Content-Type: application/json',
        'Ocp-Apim-Subscription-Key: d508f60d5c5a48b296e4e35e6e0f6402',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
    // EXECUTE:
    $result = curl_exec($curl);
   //  if(!$result){
   //    //   echo $result;
   //    //   die("Connection Failure");
   //  }
    curl_close($curl);
    return $result;
 }

 ?>