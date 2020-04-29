<?php
ini_set('max_execution_time', 0);
$dirroot="C:\medline_xml";
$subdir=scandir($dirroot);

$dirlength = count($subdir);

for($j = 0 ; $j <= $dirlength-1 ; $j++) {

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
$my_file = 'C:\TrectResult\\'.$files1[$x].'.trec';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file    
  if( file_exists($file) )
  {

$reader = new XMLReader();

if (!$reader->open($file)) {
    die("Failed to open 'user-data.xml'");
}
$doc = new DOMDocument;

// reading xml data...
while($reader->read()) {
  if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'MedlineCitation') {
  
    $node = simplexml_import_dom($doc->importNode($reader->expand(), true));
   
//          echo "<pre>";
if ($node->Article->Abstract->AbstractText <> '' and !empty($node->Article->Abstract->AbstractText )){ 
fwrite($handle, '<DOC><DOCNO>'.$node->PMID.'</DOCNO>'.$node->Article->Abstract->AbstractText.'</DOC>');
}
 // get username

    
   }
}
 $reader->close();
fclose($handle);
  }
  else
    exit("Failed to open $file.");
}
}
}
}
}

