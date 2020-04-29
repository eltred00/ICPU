<?php

session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// recuperer les variables de sessions et les exporter en csv 

// output headers so that the file is downloaded rather than displayed
$delimiter = ",";
$list = array (
   array('aaa', 'bbb', 'ccc', 'dddd'),
   array('aaaa', 'bbbb', 'cccc', 'ddddd'), 
);
$filename = "members_" . date('Y-m-d') . ".csv";
$fp = fopen('php://memory', 'w');
$fields = array('cui', 'desc', 'degree', 'coocur');
fputcsv($fp, $fields, $delimiter);
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '";');
//
//// create a file pointer connected to the output stream
//
//// output the column headings
//
////foreach ($_SESSION["TableResultaCui"] as $fields) {
////    fputcsv($fp, $fields);
////}
//fpassthru($f);
////fclose($f);
// fetch the data
//mysql_connect('localhost', 'username', 'password');
//mysql_select_db('database');
//$rows = mysql_query('SELECT field1,field2,field3 FROM table');
//
//// loop over the rows, outputting them
////while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);



foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fpassthru($fp);
fclose($fp);
//readfile($fp);