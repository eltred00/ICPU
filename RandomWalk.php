<?php
// define variables and set to empty values
session_start();
ini_set('max_execution_time', 2000);
//$label1="";
//$Output=[];
//$cui1=$cui2="";
//$cui[]="";
//$n=0;


# First function : Connect to Database
######################################################################
function db() {
static $conn;
    if ($conn===NULL){ 
                $servername = "localhost";
                $username = "umls";
                $password = "umls";
                $dbname = "umls";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
}
return $conn;
}
    # RandomWalk Function
    ########################################################################
function  random_walk($cui_in,$n, $param,$sab,$force_occurenace, $freq, $force_initial){
        $conn = db();
        $path = [];
        $InList =[];
        $path[0][0]=$cui_in[0][0];   
        $path[0][1]=$cui_in[0][1]; 
      //  $path[0][2]=0;
        $InList= get_related_concepts($cui_in[0][0],$param, $sab);
        $InList_coocur=[];
       // $List_temoin=[];
        // if inlist est vide alors sortir de la boucle 
        // $n-1 pour representer n-1 sommets incluant le point de depart
     for ($x = 0; $x <$n ; $x++) {
          if (empty($InList)) // si pas de concepts qui provient de la requete alors on quitte la boucle 
        {
            break;
        }  
        //	L'algorithme interne de génération aléatoire a été modifié pour utiliser le générateur aleatoire de nombre »  Mersenne Twister au lieu de la fonction aléatoire libc
         //    $sql = "select CUI,STR  from umls.mrconso  where   TS='P' AND ISPREF='Y' and stt='PF'and (sab='MSH' or SAB='MTH') AND CUI = '".$NextCui."' LIMIT 1 ";
         if($force_occurenace== 0) {
         $NextCui=$InList[array_rand($InList)]; // C'EST ICI QUE LE CUI EST CHOISI ALEATOIREMENT  //and (sab='MSH' or SAB='MTH')
         }else{
             unset($InList_coocur);
             $InList_coocur=[];
             //utiliser uniquement une liste de cui qui on au moin une coocurance
             foreach ($InList as $value) {
                 //$local=find_occurence ($cui_in[0][0], $value);
                 // 
                 if ($force_initial==0){
                     $local=find_occurence ($cui_in[0][0], $value, $freq);
                     
                 }else{
                 $h_local = count($path)-1;
                 $local=find_occurence ($path[$h_local][0], $value, $freq);
                 
                 }
                 if ( $local >= $freq){
                   $InList_coocur[]=  $value;
                 //  $List_temoin[]=[$value,$local];
                 }
             }  
             if (!empty($InList_coocur)){
                 
                 $InList=$InList_coocur;
                 $NextCui=$InList[array_rand($InList)];
             }else{$NextCui=$InList[array_rand($InList)];}                             
         }
        
        
        $sql = "select CUI,STR  from umls.mrconso  where  (ts='P' and stt='PF' and ISPREF='Y') and ".$sab." AND CUI = '".$NextCui."' LIMIT 1 ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { // if there is cui then we countinue to walk 
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $i=+ count($path);
                        $path[$i][0]= $row["CUI"];
                        $path [$i][1]= $row["STR"];
                        //$path [$i][2]=find_occurence ($cui_in[0][0], $NextCui);;
                        }
                         $InList= get_related_concepts ($NextCui , $param, $sab);

                        }     
            
          }  

         return $path;
}             
            
    # fond all related concepts 
    ########################################################################            
function get_related_concepts ($cuix, $param,$sab){
                 $conn = db();
                 $thislist =[];
                 //TextToAdded= get_relation(self);
                 //$sql = "SELECT CUI1,CUI2,RELA,REL FROM MRREL WHERE   (".$param.") AND  (rela is not null) (sab='MSH' or SAB='MTH')and (CUI1 <> CUI2) AND CUI1='".$cuix."' AND  (rela is not null)";
                 //AND   (rela is not null)
                 // je ne priorise pas les relation sématique  AND  (rela is not null)
                 // ne pas ajouter stype2='cui' dans la requete cela reduit les resultats
                 $sql = "SELECT CUI1,CUI2,RELA,REL FROM MRREL force index(X_MRREL_CUI1,X_MRREL_CUI2) WHERE (".$param.")  and (".$sab.") and (CUI1 <> CUI2) AND CUI1='".$cuix."' ";
                 $result = $conn->query($sql);
                 if ($result->num_rows > 0) {
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $thislist[] = $row["CUI2"];
                        }
                        }                              
        return $thislist;        
}            
            
    # co-occurences
    ########################################################################
function find_occurence ($cept_x, $cept_y , $freq){  
           $conn = db();
           $thisfreq =0;
           //$sql ="select Freq  from mrcocur2 force INDEX (idx_MROCUR) where  (CUI1='".$cept_x."' AND CUI2='".$cept_y."') OR (CUI1='".$cept_y."' AND CUI2='".$cept_x."') ORDER BY Freq DESC LIMIT 1";
           //$sql ="SELECT * FROM umls.mrcocur2  force INDEX (id_index_cui2) where (CUI2='".$cept_x."' AND CUI1='".$cept_y."')ORDER BY Freq DESC LIMIT 1 ;";
           //$sql ="SELECT Freq FROM umls.mrcocur2 force INDEX (idx_mrcocur2_CUI1_CUI2) where (CUI2='".$cept_x."' AND CUI1='".$cept_y."')ORDER BY Freq DESC LIMIT 1";
           $sql ="SELECT freq FROM umls.mrcocur2 force INDEX (idx_mrcocur2_CUI1_CUI2) where ((CUI1='".$cept_x."' AND CUI2='".$cept_y."') or (CUI2='".$cept_x."' AND CUI1='".$cept_y."')) and Freq >='". $freq."' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $thisfreq = $row["freq"];
                        }
                        }
             return $thisfreq;
  
}

       
function  found_cluster ($cept,$number_of_walks , $param ,$LW,$DW,$ST,$ocure,$sab, $force_occurenace,  $freq, $force_initial ){
     $conn = db();
     // On prepar le cui de départ 
      $ListFrequence_initial_terms =[];
      $ListFrequence_initial_terms[0][0]=$cept[0][0];
      $ListFrequence_initial_terms[0][1]=$cept[0][1];
      $ListFrequence_initial_terms[0][2]=1;
      $ListFrequence_initial_terms[0][3]=0;
      $List_after_rank=[];
      # ListFrequence_initial_terms contient le concept, sa description , sa frequence et le nombre de co-occurance avec le concept de depart
      for ($x = 0; $x <$number_of_walks ; $x++) {
       
        $ResultPath=random_walk($cept, $LW , $param,$sab,$force_occurenace,$freq,$force_initial  ); // on explore un chemin a partir d'un concept de depart 

        $pathlength = count($ResultPath); // on calcul la taille du resultat
        for ($k = 0; $k <$pathlength ; $k++) {
           $found = False;
           $initialTermlength = count($ListFrequence_initial_terms);
           for ($m = 0; $m <$initialTermlength ; $m++) {
               if ($ResultPath[$k][0]== $ListFrequence_initial_terms [$m][0]){
                   $ListFrequence_initial_terms [$m][2] = $ListFrequence_initial_terms [$m][2]+ 1;
                   $found =True;
                }
           }
           if (!$found){
             $i= count($ListFrequence_initial_terms);
             $ListFrequence_initial_terms[$i][0]=$ResultPath[$k][0];
             $ListFrequence_initial_terms[$i][1]=$ResultPath[$k][1];
             $ListFrequence_initial_terms[$i][2]=1;
             $ListFrequence_initial_terms[$i][3]=0;
             }
        }
        # rechercher la frequence de co-occurance du concet sed et les concepts important retrouvés par le walk random"""
      }
 
      // eliminer les noed moins important 
      if ($ocure <> "2" and $ocure <> "4" ) { 
      $Freqlength = count($ListFrequence_initial_terms);
      for ($p = 0; $p <$Freqlength ; $p++) {
          // cette recherch ce fait dans un meme cluster  
          
              // chercher la frequence du concept avec le concept initial pout tou les cencepts retrouvés
    
           // if  "Use co-occurrences within cluster concepts" or "Without using co-occurrences"
        if ($ListFrequence_initial_terms[$p][2]>= $ST){
             $i=+ count($List_after_rank);
             $List_after_rank[$i][0]= $ListFrequence_initial_terms[$p][0];
             $List_after_rank[$i][1]= $ListFrequence_initial_terms[$p][1];
             $List_after_rank[$i][2]= $ListFrequence_initial_terms[$p][2];
             $List_after_rank[$i][3]= $ListFrequence_initial_terms[$p][3];
        } elseif($ocure=="1") { // on ne cherche la co-occurence que si le seuil de freqence est faible 
            $ListFrequence_initial_terms[$p][3]=find_occurence($ListFrequence_initial_terms[0][0],$ListFrequence_initial_terms[$p][0], $freq);
            if ($ListFrequence_initial_terms[$p][3]>=$freq) {
             $i=+ count($List_after_rank);
             $List_after_rank[$i][0]= $ListFrequence_initial_terms[$p][0];
             $List_after_rank[$i][1]= $ListFrequence_initial_terms[$p][1];
             $List_after_rank[$i][2]= $ListFrequence_initial_terms[$p][2];
             $List_after_rank[$i][3]= $ListFrequence_initial_terms[$p][3]; 
              } 
        }
       }   
       
     } else {
         
         $List_after_rank =$ListFrequence_initial_terms;
     
         
     }
     

 

   return ($List_after_rank);
} 




?>


