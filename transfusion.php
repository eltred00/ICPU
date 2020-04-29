<?php

include 'MetaMapLite.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 $conn = db();
 $a=MetaMapTable($conn);
function MetaMapTable ($conn)
{
/* create a temporary table to handel all 
/* read data from tables and loop over */ 
    $sql = "truncate table  umls.cnrc_terms_map" ;			
                                $result = $conn->query($sql);
$concepts="";                                
 $sql = "SELECT `desc` FROM `umls`.`cnrc_terms_final` " ;			
 $result = $conn->query($sql);
     foreach ($result as $row){
  $concepts = $concepts." ".$row[desc];
}

       $Output = MetaMapLite_input($concepts);
         $arrlength = count($Output);
         // find relation between difirents element if exist
       for($x = 0; $x < $arrlength; $x++) {
            $sql = "insert into umls.`cnrc_terms_map` values ('".$Output[$x][4]."' ,'".$Output[$x][3]."')";
             $result = $conn->query($sql);   
            
                           
       }  
}
