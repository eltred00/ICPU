<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function unique_multidim_array($array, $key) { 
   $temp_array = array(); 
    $i = 0; 
    $j = 0; 
    $key_array = array(); 
    // il faut  garder la frequence la plus elevé
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$j] = $val; 
            $j++; 
        } 
//        else {
////           $keyFind = array_search($val[$key], $key_array);
////           $temp_array[$keyFind][$column]= $temp_array[$keyFind][$column] + $val[$i][$column];
//            echo "red";
//      }
            
        $i++; 
    } 
    
    return $temp_array; 
} 

          
         
    
function unique_multidim_rela_array($array) { 
   $temp_array = array(); 
    $i = 0; 
    $j = 0; 
    $key_array = array(); 
    // il faut  garder la frequence la plus elevé
    foreach($array as $val) { 
        if (!in_array($val, $key_array)) { 
            $key_array[$i] = $val; 
            $temp_array[$j] = $val; 
            $j++; 
        } 
//        else {
//           $keyFind = array_search($val[$key], $key_array);
//           $temp_array[$keyFind][$column]= $temp_array[$keyFind][$column] + $val[$i][$column];
//        }
            
        $i++; 
    } 

    return $temp_array; 
} 




