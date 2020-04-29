<?php
ini_set('max_execution_time', 0);
function db() {
static $conn;
    if ($conn===NULL){ 
                $servername = "localhost";
                $username = "umls";
                $password = "umls";
                $dbname = "umls";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
}
return $conn;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn = db();
$get_data = callAPI('GET', 'http://data.bioontology.org/ontologies/MEDDRA', false);
$response = json_decode($get_data, true);
//$errors = $response['response']['errors'];
$data = $response ['links']['roots'];
print_r($data);
$get_data = callAPI('GET', $data, false);
$response = json_decode($get_data, true);
//$errors = $response['response']['errors'];
$arrlenght=count($response);
for ($i=0;$i <$arrlenght; $i++){
$data = $response [$i]['prefLabel'];
if ($data=='Blood and lymphatic system disorders'){
    print_r($data);
    /*inset the cui*/
    $sql="INSERT INTO `umls`.`blood_meddra`(`CUI`,`STR`)VALUES ('".$response[$i]['cui'][0]."' , '".$data."' );";
    $result1 = $conn->query($sql);
    $result1->null;
    /* loop on childs*/
  
    if (! is_null($response[$i]['links']['children'])){
    call_recursive($response[$i]['links']['children'],$conn);
    
    /* start reccurssive */
    }
    
    
    
    
    
}
}

function call_recursive($response_child, $conn){
$get_data = callAPI('GET',$response_child, false);
$response = json_decode($get_data, true);
$array_collection=$response ['collection'];
if (!empty ($array_collection)){
$arrlencol=count($array_collection);
for ($i=0;$i <$arrlencol; $i++){
$data = $array_collection[$i]['prefLabel'];
$cui = $array_collection[$i]['cui'];
    $sql="INSERT INTO `umls`.`blood_meddra`(`CUI`,`STR`)VALUES ('".$array_collection[$i]['cui'][0]."' , '".$data."' );";
    $result1 = $conn->query($sql);
    $result1->null;
$next= $array_collection[$i]['links']['children'];
call_recursive($next, $conn);
}
}
}
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
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: apikey token=db819f15-8676-41f2-8611-6f16f7a76874',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}

 


