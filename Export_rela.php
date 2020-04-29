<?php

session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Export le resultat du cluster

$delimiter = "|";
$filename = "relation_" . date('Y-m-d') . ".csv";
$fpr = fopen('php://memory', 'wb');
$fields = array('concept_1','concept_2 ','rel ','rela');
 fputcsv_eol($fpr, $fields, $delimiter,$enclosure = '"', $eol = "\r\n" );
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '";');
foreach ($_SESSION["TableResultRela"] as $fields) {
    fputcsv_eol($fpr, $fields,$delimiter,$enclosure = '"', $eol = "\r\n" );
}
fpassthru($fpr);
rewind($fpr);
echo stream_get_contents($fpr);
fclose($fpr);



function fputcsv_eol($handle, $array, $delimiter = ',', $enclosure = '"', $eol = "\r\n" ) {
    $return = fputcsv($handle, $array, $delimiter, $enclosure);
    if($return !== FALSE && "\n" != $eol && 0 === fseek($handle, -1, SEEK_CUR)) {
        fwrite($handle, $eol);
    }
    return $return;
}