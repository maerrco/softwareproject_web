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
    if(!$result){
        echo $result;
        die("Connection Failure");
    }
    curl_close($curl);
    return $result;
 }


//  $data_array = array(
//     'name' => 'whitestarproducts employees', 
//     'userData' => 'Employees involved in WhitestarProducts', 
//     'recognitionModel' => 'recognition_02'
//  );

   $data_array = array(
       "name" => "Marco",
       "userData" => "User-provided data attached to the person."
    );


 //$update_plan = callAPI('DELETE', 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/group2', "");
 $make_call = callAPI('POST', 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/employees/persons', json_encode($data_array));

 echo $update_plan;


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

debug_to_console("form was submitted!");


?>
