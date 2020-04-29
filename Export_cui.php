<?php

session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Export le resultat du cluster
$delimiter = "|";
$filename = "clusters_" . date('Y-m-d') . ".csv";
$fp = fopen('php://memory', 'wb');
$fields = array('CUI','Description ','frequence ','co-ocurance frequence');
 fputcsv_eol($fp, $fields, $delimiter,$enclosure = '"', $eol = "\r\n" );
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '";');

// Verifier si l'exportation concerne l'extraction sans l'extention vers la racine


foreach ($_SESSION["TableResultaCui"] as $fields) {
    fputcsv_eol($fp, $fields,$delimiter,$enclosure = '"', $eol = "\r\n" );
}
fpassthru($fp);
rewind($fp);
echo stream_get_contents($fp);
// export les resultat des relations
fclose($fp);

function fputcsv_eol($handle, $array, $delimiter = ',', $enclosure = '"', $eol = "\r\n" ) {
    $return = fputcsv($handle, $array, $delimiter, $enclosure);
    if($return !== FALSE && "\n" != $eol && 0 === fseek($handle, -1, SEEK_CUR)) {
        fwrite($handle, $eol);
    }
    return $return;
}