<?php
include 'Process.php';
ini_set('max_execution_time', 0);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* find all xml files in directory */
$xpath_cri = "//clinical_study/eligibility/criteria/textblock";
$xpath_pcl = "//clinical_study/condition_browse/mesh_term";
$xpath_pcn = "//clinical_study/condition";
$xpath_pgen = "//clinical_study/eligibility/gender";
$xpath_pagmi = "//clinical_study/eligibility/minimum_age";
$xpath_pagmx= "//clinical_study/eligibility/maximum_age";
$xpath_enrol="//clinical_study/enrollment_type";
$xpath_in = "//clinical_study/intervention/intervention_name";
$xpath_it = "//clinical_study/intervention/intervention_type";
$xpath_il = "//clinical_study/intervention_browse/mesh_term";
$xpath_op = "//clinical_study/primary_outcome/measure";
$xpath_os = "//clinical_study/secondary_outcome/measure"; 

$conn = db();
$dirroot="C:\Users\Home\Downloads\AllPublicXML";
$subdir=scandir($dirroot);
$dirlength = count($subdir);



for($j = $dirlength-201 ; $j >= $dirlength-380 ; $j--) {
/* define the xpath rules*/
/*<study_design_info>
<allocation>Non-Randomized</allocation>
<intervention_model>Sequential Assignment</intervention_model>
<primary_purpose>Treatment</primary_purpose>
<masking>None (Open Label)</masking>
</study_design_info>*/
if($subdir[$j]<>"." and $subdir[$j]<>"..") {
//$dir    = "C:\Users\Home\Downloads\AllPublicXML\NCT0000xxxx";
$dir =$dirroot. "\\".$subdir[$j];
$files1 = scandir($dir);
$arrlength = count($files1);

for($x = 0; $x < $arrlength ; $x++) {
  $file  =  $files1[$x];
if($file<>"." and $file <>"..") {
if (pathinfo($file, PATHINFO_EXTENSION)=='xml'){
  $file = $dir. "\\". $files1[$x];
  
  if( file_exists($file) )
  {
    $xml =null;
    $xml = simplexml_load_file($file);
    $a =get_xmlpath_result($xml,$xpath_cri,"Pcrit",$conn,substr($files1[$x],0, -4));    
    $a =get_xmlpath_result($xml,$xpath_pcl,"Pcond",$conn,substr($files1[$x],0, -4)); 
    $a =get_xmlpath_result($xml,$xpath_pcn,"Pconb",$conn,substr($files1[$x],0, -4)); 
     $a =get_xmlpath_result($xml,$xpath_pgen,"Pgend",$conn,substr($files1[$x],0, -4)); 
     $a =get_xmlpath_result($xml,$xpath_pagmi,"Pagmi",$conn,substr($files1[$x],0, -4)); 
      $a =get_xmlpath_result($xml,$xpath_pagmx,"Pagmx",$conn,substr($files1[$x],0, -4)); 
       $a =get_xmlpath_result($xml,$xpath_enrol,"Enrol",$conn,substr($files1[$x],0, -4));
    $a =get_xmlpath_result($xml,$xpath_in,"Intrn",$conn,substr($files1[$x],0, -4));  
    $a =get_xmlpath_result($xml,$xpath_it,"Intrt",$conn,substr($files1[$x],0, -4)); 
    $a =get_xmlpath_result($xml,$xpath_il,"Intrb",$conn,substr($files1[$x],0, -4));  
    $a =get_xmlpath_result($xml,$xpath_op,"Oprim",$conn,substr($files1[$x],0, -4)); 
    $a =get_xmlpath_result($xml,$xpath_op,"Oseco",$conn,substr($files1[$x],0, -4));
  $xml =null;
  }
  else
    exit("Failed to open $file.");
}
}
}
}
}
 // print_r($jsonList);

function get_xmlpath_result( $xml , $xpathRule, $type,$conn , $files){
    $Output=null;
      switch ($xpathRule){
            case '//clinical_study/eligibility/criteria/textblock':
               $find = $xml->xpath($xpathRule);
                while(list( , $value) = each($find)) {
                /* traitement pour recuperer le critere inclusion et exclusion */

                   
                //$d=strpos($value, 'Inclusion Criteria: -');
                $start =strpos($value, "Inclusion Criteria") + strlen ("Inclusion Criteria: -");
                $end =strpos($value, "Exclusion Criteria") - $start;
                $Inclusion= substr($value, $start, $end);
                if (! is_null($Inclusion) and $Inclusion<> ""){
                $sql ="INSERT INTO `trailpico`( `study_id`,  `pico`, `desc`) VALUES ('".$files."','inclu' ,'".$Inclusion."')";
                $result1 = $conn->query($sql);
                $result1->null;
                }
                /* exclusion part */
                
                 $start =strpos($value, "Exclusion Criteria") + strlen ("Exclusion Criteria: -");
                $end =strlen($value) - $start;
                $Exclusion= substr($value, $start);
               if (! is_null($Exclusion) and $Exclusion<> ""){
                $sql ="INSERT INTO `trailpico`( `study_id`,  `pico`, `desc`) VALUES ('".$files."','exclu' ,'".$Exclusion."')";
                $result1 = $conn->query($sql);
                $result1->null;
                }
              
                   }      
                
            break;
      default:
         $result = $xml->xpath($xpathRule);
          while(list( , $node) = each($result)) {
     $sql ="INSERT INTO `trailpico`( `study_id`,  `pico`, `desc`) VALUES ('".$files."','".$type."' ,'".$node."')";
    $result1 = $conn->query($sql);
    $result1->null;
        // $tmp =  MetaMapLite_input($node);
        // if ($tmp <> "No data") $Output[] = $tmp;
          }    
            
        }
   // if($result_i = $xml->xpath($xpathRule)){
    /* if text coming from cretaria then :    */
      
                
                
                
   // $Output = MetaMapLite_input($result_i[0]);
//    if (!empty($Output)){
//    $ln = count($Output);
//    for($i = 0; $i < $ln; $i++){
//    $SubOutput=$Output[$i];
//   
//    $sql ="INSERT INTO `trailpico`( `study_id`, `cui`, `pico`, `desc`) VALUES ('".$files."','".$SubOutput[0][4]."' ,'".$type."' ,'".$SubOutput[0][3]."')";
//    $result = $conn->query($sql);
//    $result->null;
//    }
//    }
  $xml=null;
    
      return true;
}


?>