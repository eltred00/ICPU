<?php
session_start();
ini_set( 'display_errors', 0 );
include 'RandomWalk.php';
include 'functions.php';
$Input = $nameErr = $label1= $label2="";
$Output=[];

       
if (isset($_POST["Input"])) {
         $conn = db();
         $Input = $_POST["Input"];
         $Output = MetaMapLite_input($Input);
         $arrlength = count($Output);
         // find relation between difirents element if exist
        for($x = 0; $x < $arrlength; $x++) {
            $jsonList[] =  array (
            "code"     => $Output[$x][4],
            "desc"    => $Output[$x][3]       
            );
            for ($m=$x; $m < $arrlength; $m++ ){
             if ($Output[$x][4]<> $Output[$m][4])
                 {
                     // this part we retrieve relation information from database
                 // ici forcer en premier le reseau semantique en premier sion recuperer la relation methasurus
                 // ancienne requete  $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   CUI1 = '".$Output[$x][4]."' and CUI2 = '".$Output[$m][4]."'  AND  (rela is not null) LIMIT 1 ";
                
                   $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   CUI1 = '".$Output[$x][4]."' and CUI2 = '".$Output[$m][4]."'  AND  (rela is not null) group by  cui1,cui2,rel,rela ";
                   $result = $conn->query($sql);
                   if ($result->num_rows > 0) { // if there is cui then we countinue to walk 
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $jason_rela[]=array (
                        "concept_1" => $row['cui1'],
                        "concept_2" => $row['cui2'],
                        "rel" => $row['rel'],  
                        "rela" => $row['rela'], 
                         );
                        }
                 }else {
                     // ici on cherche la rellationdans le metashurus sans limit
                     // ancienne requete   $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   CUI1 = '".$Output[$x][4]."' and CUI2 = '".$Output[$m][4]."'   LIMIT 1 ";
                 
                   $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   CUI1 = '".$Output[$x][4]."' and CUI2 = '".$Output[$m][4]."' group by cui1,cui2,rel,rela ";
                   $result = $conn->query($sql);
                     if ($result->num_rows > 0) { // if there is cui then we countinue to walk 
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $jason_rela[]=array (
                        "concept_1" => $row['cui1'],
                        "concept_2" => $row['cui2'],
                        "rel" => $row['rel'],  
                        "rela" => $row['rela'], 
                         );
                        }
                 }
                  
                 }
                 }
             }
         }
    
        // find diffirents possible couple
        // ici faire la diffirence entre les types semantyc et les type
        
        
        // using a lopp and sql bing diffirents relations 
        // 
        // this part will help to setup the temporary table mrconson_bis and mrrel_bis
        
        echo json_encode(array($jsonList,$jason_rela));
        }

if (isset($_POST["json_string"])) {
    $conn = db();
    $JsonObj=json_decode($_POST["json_string"]);
    $jsonList_cluster_glob=[];
    $jsonList_cluster_rela=[];
    $len= count($JsonObj);
    for ($i=0;$i < $len ;$i++ ){
    // retrive all what was retrived by the rule
            $cui_in[0][0]=trim($JsonObj[$i]->code);
            $cui_in[0][1]=trim($JsonObj[$i]->desc);
        if ($cui_in[0][0] <>"") {
            //$n=50;
            $result =found_cluster($cui_in,$_POST["NW"],$_POST["par1"],$_POST["LW"],$_POST["DW"],$_POST["ST"],$_POST["par2"] ,$_POST["par3"],$_POST["par4"] ,$_POST["FR"],$_POST["par5"] );
        $arrlength = count($result);

        for($x = 0; $x < $arrlength; $x++) {
             $jsonList_cluster[] =  array (
            "code"     => $result[$x][0],
            "desc"    => $result[$x][1],
            "degree"    => $result[$x][2],
            "co-occur" => $result[$x][3]              
            );
        }
        // unifier les clusters trouvé dans une même liste
        $jsonList_cluster_glob = array_merge($jsonList_cluster_glob,$jsonList_cluster);
        $jsonList_cluster=[];
         }
         }
           // enelver  les doublons des clusters ; il faudrait revoir la selection et le choix 
           $details = unique_multidim_array($jsonList_cluster_glob,"code"); 
          if ($_POST["par2"]=="2" )  // ceci est pour le traitement des occurences avec les concepts initiaux 
              {
              /*
               * Si le concepts retrouvé a une frequece inferieur a celle du seuil alors nous allons voir s'il co-occure avec 
                 un des concepts initiaux, si au moins on retrouve une occurence, cela est bon.               */
              $len2= count($details);
              $New_details=[];
              $recherche_occur=0;
              for ($p = 0; $p <$len2 ; $p++) {
                  if ($details[$p]['degree']>= $_POST["ST"]){
                      /** Si le concepts est plus frequent que le seuil alors en le prend sans cherche a trouvé sa co-occurence**/
                  $i=+ count($New_details);
                 $New_details[$i]['code']= $details[$p]['code'];
                 $New_details[$i]['desc']= $details[$p]['desc'];
                 $New_details[$i]['degree']= $details[$p]['degree'];
                 $New_details[$i]['co-occur']= $details[$p]['co-occur']; 
                 }else 
                     {
                     /** s'il n'est pas tres important alors en regarde sa co-occurence par rapport au concepts de depart*/ 
                      $len= count($JsonObj);
                      $recherche_occur=0;
                       for ($k=0;$k < $len ;$k++ ){
                           $recherche_occur= $recherche_occur+ find_occurence(trim($JsonObj[$k]->code),$details[$p]['code']);
                      }
                      if ($recherche_occur>=1){
                          /*s'il ya au moins une co-occurence a lors en le prendrera'*/
                          $i=+ count($New_details);
                          $New_details[$i]['code']= $details[$p]['code'];
                          $New_details[$i]['desc']= $details[$p]['desc'];
                          $New_details[$i]['degree']= $details[$p]['degree'];
                          $New_details[$i]['co-occur']= $recherche_occur; 
                      }
                      }
                }
                $details=$New_details;
               }
       $details_rela=[];
            $arrlength = count($details);
            /*** createion d'une table temporaire pour mettre les données et exporter plus tard */
                $conn = db();
//                $sql ="DROP TABLE IF EXISTS MRCOOCUR_EXTRACT";
//                $result = $conn->query($sql);
//                $sql ="CREATE TABLE IF NOT EXISTS  MRCOOCUR_EXTRACT (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,CUI1 VARCHAR(10) NOT NULL,STR VARCHAR(100) NOT NULL,DEGREE SMALLINT,OCUR SMALLINT)";
//                $result = $conn->query($sql);

            for($x = 0; $x < $arrlength; $x++) {
                /* IF FAUDRAIT METTRE DES TRY -EXCEPTION **/
//                $sqlINE="INSERT INTO MRCOOCUR_EXTRACT ( CUI1, STR,DEGREE,OCUR )VALUES( '".$details[$x]["code"] ."', '".$details[$x]["desc"] ."','".$details[$x]["degree"] ."','".$details[$x]["co-occur"] ."' )";
//                $result = $conn->query($sqlINE);
            for ($m=$x; $m < $arrlength; $m++ ){
             if ($details[$x]["code"]<> $details[$m]['code'])
                 {
//                     // this part we retrieve relation information from database AND  (rela is not null)
//                   $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where  (".$_POST["par1"]." ) and (".$_POST["par3"]." ) and CUI1 = '".$details[$x]['code']."' and CUI2 = '".$details[$m]['code']."'  LIMIT 1 ";
//                   $result = $conn->query($sql);
//                   if ($result->num_rows > 0) { // if there is cui then we countinue to walk 
//                        // output data of each row
//                    while($row = $result->fetch_assoc()) {
//                        $details_rela[]=array (
//                        "concept_1" => $row['cui1'],
//                        "concept_2" => $row['cui2'],
//                        "rel" => $row['rel'],  
//                        "rela" => $row['rela'], 
//                         );
//                        }
//                 }
                                      // this part we retrieve relation information from database
                 // ici forcer en premier le reseau semantique en premier sion recuperer la relation methasurus
                 // ancienne requete  $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   CUI1 = '".$Output[$x][4]."' and CUI2 = '".$Output[$m][4]."'  AND  (rela is not null) LIMIT 1 ";
                
                   $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   (".$_POST["par1"]." ) and (".$_POST["par3"]." )and  CUI1 = '".$details[$x]['code']."' and CUI2 = '".$details[$m]['code']."'  AND  (rela is not null) group by  cui1,cui2,rel,rela ";
                   $result = $conn->query($sql);
                   if ($result->num_rows > 0) { // if there is cui then we countinue to walk 
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $details_rela[]=array (
                        "concept_1" => $row['cui1'],
                        "concept_2" => $row['cui2'],
                        "rel" => $row['rel'],  
                        "rela" => $row['rela'], 
                         );
                        }
                 }else {
                     // ici on cherche la rellationdans le metashurus sans limit
                     // ancienne requete   $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   CUI1 = '".$Output[$x][4]."' and CUI2 = '".$Output[$m][4]."'   LIMIT 1 ";
                 
                   $sql = "select cui1,cui2,rel,rela  from umls.mrrel force index(X_MRREL_CUI1,X_MRREL_CUI2) where   (".$_POST["par1"]." ) and (".$_POST["par3"]." ) and CUI1 = '".$details[$x]['code']."' and CUI2 = '".$details[$m]['code']."' group by cui1,cui2,rel,rela ";
                   $result = $conn->query($sql);
                     if ($result->num_rows > 0) { // if there is cui then we countinue to walk 
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $details_rela[]=array (
                        "concept_1" => $row['cui1'],
                        "concept_2" => $row['cui2'],
                        "rel" => $row['rel'],  
                        "rela" => $row['rela'], 
                         );
                        }
                 }
                  
                 }
                 }
             }  // end
             }
$a=senarios($details, $_POST['NW'],$_POST['LW'],$_POST["DW"],$_POST["ST"],$_POST["par2"], $_POST["par2"], $conn)  ;
$a=stability ($details, $_POST['NW'],$_POST['LW'],$_POST["DW"],$_POST["ST"],$_POST["par2"], $_POST["par2"], $conn);     
$a=global_stability ($conn);

             /* il faut netoyer les doubles concepts*/

           echo json_encode(array($details,$details_rela));
               
                          /* ici il faut inserer les données concernant les parametre et les resultat*/
               /* on besoin des varibale suivantes : $_POST["NW"],$_POST["par1"],$_POST["LW"],$_POST["DW"],$_POST["ST"],$_POST["par2"]
               /*il faut créer une table avec les éléments suivants numbre of walk; lengeur */
               /* Il faut calculer la correspondance entre la table source et  */
               /* create a temporay table 
                insert data from $detail into
                use select inner to retriev concetps numbre : select count(*) from temp_details inner join meddra on temp_details.cui=meddra.CUI 
                */

            $_SESSION["TableResultaCui"] = $details;
            $_SESSION["TableResultRela"] = $details_rela;   
            $_SESSION["sab"]=$_POST["par3"];
            $_SESSION["parametre"]=$_POST["par1"];
       }


       
       
       
function MetaMapLite_input($data) {


    
$PathToFile= getcwd()."\public_mm_lite";
$my_file_in = '\sample2.txt';
$handle = fopen($PathToFile.$my_file_in, 'w') or die('Cannot open file:  '.$my_file_in);
fwrite($handle, $data);
fclose($handle);


if (file_exists(getcwd()."\public_mm_lite\toto.txt")) unlik(getcwd()."\public_mm_lite\toto.txt");
$last_line=system('cmd /k  "cd '.getcwd()."\public_mm_lite   && metamaplite.bat sample2.txt 1>toto.txt exit " ,$retval) ;



$my_file_out = '\sample2.mmi';
$info = [];
$line="";
    if (!file_exists($PathToFile.$my_file_out)) {
      print 'File not found';
    }
    else if(!$file_handle = fopen($PathToFile.$my_file_out, 'r')) {
      print 'Can\'t open file';
    }
    else {
        $file_handle = fopen($PathToFile.$my_file_out, "r");
        while (!feof($file_handle)) {
            $line=fgets($file_handle);
            if ($line ) {
           $info[] =explode("|",$line);
           }       
         }  
       fclose($file_handle);
   }
    if (empty($info)) {
        $nameErr = "No data";
         return $nameErr;
      }
      else {
          return $info;
      }
}


function senarios ($details , $NW, $LW, $DW,$ST, $par1,$par2, $conn){
    
                   
                          /* ici il faut inserer les données concernant les parametre et les resultat*/
               /* on besoin des varibale suivantes : $_POST["NW"],$_POST["par1"],$_POST["LW"],$_POST["DW"],$_POST["ST"],$_POST["par2"]
               /*il faut créer une table avec les éléments suivants numbre of walk; lengeur */
               /* Il faut calculer la correspondance entre la table source et  */
               /* create a temporay table 
                insert data from $detail into
                use select inner to retriev concetps numbre : select count(*) from temp_details inner join meddra on temp_details.cui=meddra.CUI 
                */
               $sql = "CREATE TABLE IF NOT EXISTS umls.temp_details (
			   `code` char(8) ,
			   `desc` text ,
			   `degree` int(10) unsigned ,
			   `co-occur` int(10) unsigned 
			   )ENGINE=InnoDB 
			   " ;			
                 $result = $conn->query($sql);
               $sql = "truncate table umls.temp_details" ;			
               $result = $conn->query($sql);
				 $stmt = "";
if(!($stmt = $conn->prepare("INSERT INTO umls.temp_details VALUES (?,?,?,?)" ))){
    die( "Error preparing: (" .$conn->errno . ") " . $conn->error);
}
					
				foreach ($details as $row) {
   
				// Bind parameters. Types: s = string, i = integer, d = double,  b = blob
				$bind = $stmt->bind_param('ssii',$row['code'],$row['desc'],$row['degree'],$row['co-occur']);
                                $exec = $stmt->execute();
                                }
                                $stmt->close();
 			   /* calculate a percentage after inserting data in this table*/
			   
 //              $sql = "select count(*) from temp_details inner join meddra on temp_details.cui=meddra.CUI" ;
 //               $result = $conn->query($sql);
				
              // $sql = "INSERT INTO `senarios`( `NW`, `LW`, `DW`, `ST`, `par1`, `par2`, `nbconcepts`, `retrive_concept_TA`, `retrive_concept_TB`) VALUES ('".$_POST['NW']."','".$_POST['LW']."','".$_POST["DW"]."','".$_POST["ST"].'","'.$_POST["par1"].'","'.$_POST["par2"]."','". count($details)."', (select count(*) from temp_details inner join blood_meddra on temp_details.code = blood_meddra.CUI;) )";
                                $arrlen=count($details);
                                $sql = "INSERT INTO umls.senarios ( `NW`, `LW`, `DW`, `ST`,  `par2`, `nbconcepts`,`retrive_concept_TA`) VALUES ('".$_POST['NW']."','".$_POST['LW']."','".$_POST["DW"]."','".$_POST["ST"]."','".$_POST["par2"]."','".$arrlen."',(select count(*) from umls.temp_details inner join umls. cnrc_terms_map on trim(temp_details.code) = trim( cnrc_terms_map.code)));"  ;              
                                $result = $conn->query($sql);
                                return 1;
}  


function stability ($details , $NW, $LW, $DW,$ST, $par1,$par2, $conn){
/* create a stability table */
                                $sql = "CREATE TABLE IF NOT EXISTS umls.itiration_details (
                                              `code` char(8) ,
                                              `desc` text ,
                                              `itiration` int(10) unsigned 
                                              )ENGINE=InnoDB 
                                              " ;			
                                $result = $conn->query($sql);
                                $sql = "select max(itiration) as its from   umls.itiration_details;" ;			
                                $result = $conn->query($sql);
                                $last_iteration=0;
                                foreach ($result as $row){
                                    $last_iteration = $row['its'];
                                }

                                $stmt = "";
                                if(!($stmt = $conn->prepare("INSERT INTO umls.itiration_details VALUES (?,?,?)" ))){
                                    die( "Error preparing: (" .$conn->errno . ") " . $conn->error);
                                }
				    $last_iteration= $last_iteration+1;	
				foreach ($details as $row) {
   
				// Bind parameters. Types: s = string, i = integer, d = double,  b = blob
                                  
				$bind = $stmt->bind_param('ssi',$row['code'],$row['desc'],$last_iteration);
                                $exec = $stmt->execute();
                                }
                                $stmt->close();

}

function global_stability ($conn){
/* select last itiration */
                                $sql = "select max(itiration) as its from   umls.itiration_details;" ;			
                                $result = $conn->query($sql);
                                 foreach ($result as $row){
                                    $last_iteration = $row['its'];
                                }
                                if ($last_iteration > 1){
                                    /* compose the sql*/
                                      //$sql = "SELECT code , COUNT(*) FROM umls.itiration_details GROUP BY code HAVING COUNT(*) >= ".$last_iteration ;
                             $sql =" INSERT INTO `umls`.`itiration_stat`
(`nb_iteration`,
`nb_cp`,
`avrage_cp`)
VALUES
((select max(itiration) as its from   umls.itiration_details),
(
select count(*) from (SELECT COUNT(*) as somme FROM umls.itiration_details GROUP BY code HAVING COUNT(*) >= (select max(itiration) as its from   umls.itiration_details)) as test
),
(SELECT round(AVG(somme),0)
FROM ( SELECT count(*) AS somme
       FROM umls.itiration_details 
       GROUP BY itiration ) AS grp
));";
                               
                            /*    $sql = "SELECT code , COUNT(*) FROM umls.itiration_details GROUP BY code HAVING COUNT(*) >= ".$last_iteration ;*/
                                $result = $conn->query($sql);
                                 }
                                return count($result);      
                                        
                                        
                            

}






?>
