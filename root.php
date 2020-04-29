<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
ini_set( 'display_errors', 0 );
include 'RandomWalk.php';
include 'functions.php';

// recupere les cui de la  variable globale 
$cui_array = $_SESSION["TableResultaCui"] ;
$rela_array= $_SESSION["TableResultRela"] ;
foreach ($_SESSION["TableResultaCui"] as $fields) {
    $array_temp=to_root($fields['code'],$_SESSION["sab"],$_SESSION["parametre"] );
    if(!empty($array_temp[0]))
        {
    unset($array_temp1); unset($final_temp);
    $array_temp1=$array_temp[0];
    $final_temp= array_merge($cui_array,$array_temp1);
    $cui_array = unique_multidim_array($final_temp,"code"); 
    // contient l'extention vers la racine 
    }
     if(!empty($array_temp[1]))
        {
    unset($array_temp1); unset($final_temp);
    $array_temp1=$array_temp[1];
    $final_temp= array_merge($rela_array,$array_temp[1]);
    $rela_array = unique_multidim_rela_array($final_temp); 
    // il faut faire quelque chose pour que le tableau soit unique 
    }
}
 $_SESSION["TableResultaCui_r"] = $cui_array;
 $_SESSION["TableResultRela_r"]= $rela_array;
 // changer les tableau en jason avnt de les retourner a l'appel jquery du boutton 
 echo json_encode(array($cui_array,$rela_array));
 
 
 

// fonction qui permet de retrouver l'ensemble des cui jusqu'a la racine 
function to_root($cui, $sab, $pram){
    $conn = db();
    $root_array=[];
    $root_array_rela=[];
    $cui_prec=$cui;
    // retrouver la racine en utilisant la table mrhier
    $sql = "SELECT PTR FROM umls.mrhier where CUI like '".$cui."' and ".$sab." LIMIT 1 ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
               while($row = $result->fetch_assoc()) {
                    $auis = explode(".", $row['PTR']);
                    $auis=array_reverse($auis);
                    // il faudrait inversé l'exploide (le tableau)
               }
               // parcourir  la racine retrouvé pour extraire les cui un par un de chaque aui 
               // parcourir le nouveau table a l'enver pour rerouver les cui ainsi que la relation entre le cui precedent et suivant
               foreach ($auis as $value){
                      $sqlaui = "SELECT cui,str FROM umls.mrconso where (ts='P' and stt='PF') and (aui like '".$value."') and ".$sab." limit 1; ";
                       $resultaui = $conn->query($sqlaui);
                         if ($resultaui->num_rows > 0){
                             while($rowaui = $resultaui->fetch_assoc()) {
                                $root_array[]=array (
                                  "code"     => $rowaui['cui'],
                                  "desc"    => $rowaui['str'],
                                  "degree"    => 0,
                                  "co-occur" => 0    
                                   );                               //recherche la relation qui existe entre le cui retrouver et les precedant
                                    //$sqlrela = "SELECT rel,rela  FROM umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where  cui1 = '".$cui_prec."' and cui2 = '".$rowaui['cui']."' and ".$sab." and (cui1 <> cui2) limit 1";
                                    //  $sqlrela = "SELECT rel,rela  FROM umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where  cui1 = '".$cui_prec."' and cui2 = '".$rowaui['cui']."'";
                                        $sqlrela = "select rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   (".$pram." ) and (".sab." )and cui1 = '".$cui_prec."' and cui2 = '".$rowaui['cui']."'  AND  (rela is not null) group by  cui1,cui2,rel,rela ";
                                    $resultrela = $conn->query($sqlrela);
                                    if ($resultrela->num_rows > 0){
                                        while($rowrela = $resultrela->fetch_assoc()) {
                                        $root_array_rela[]=array (
                                         "concept_1" => $cui_prec,
                                         "concept_2" => $rowaui['cui'],
                                         "rel" => $rowrela['rel'],  
                                          "rela" => $rowrela['rela'] ); 
                                        //[$cui_prec,$rowaui['cui'],$rowrela['rel'],$rowrela['rela']];
                                        $cui_prec =$rowaui['cui'];
                                        
                                        }
                                    }else{
                                     $sqlrela = "select rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   (".$pram." ) and (".sab." )and cui1 = '".$cui_prec."' and cui2 = '".$rowaui['cui']."'  group by  cui1,cui2,rel,rela ";
                                    $resultrela = $conn->query($sqlrela);
                                    if ($resultrela->num_rows > 0){
                                        while($rowrela = $resultrela->fetch_assoc()) {
                                        $root_array_rela[]=array (
                                         "concept_1" => $cui_prec,
                                         "concept_2" => $rowaui['cui'],
                                         "rel" => $rowrela['rel'],  
                                          "rela" => $rowrela['rela'] ); 
                                        //[$cui_prec,$rowaui['cui'],$rowrela['rel'],$rowrela['rela']];
                                        $cui_prec =$rowaui['cui'];
                                        
                                        }
                                        
                                    }    
                                }
                             }
                         }
                         }
                  return array($root_array,$root_array_rela);
                  // to export after $root_array_rela,
            }            
 } 
               
    
