<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function unique_multidim_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } else {
           $keyFind = array_search($val[$key], $key_array);
           $temp_array[$keyFind]["degree"]= $temp_array[$keyFind]["degree"] + $val["degree"];
        }
            
        $i++; 
    } 
    return $temp_array; 
} 




$details = unique_multidim_array($details,'code'); 
