<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style>
.line{
width: 112px;
height: 47px;
border-bottom: 1px solid black;
position: absolute;
}
.row:not(:last-child) {
    border-bottom: 1px solid #ccc;
}
#grad1 {
  height: 200px;
  background-color: red; /* For browsers that do not support gradients */
  background-image: linear-gradient(red, yellow); /* Standard syntax (must be last) */
}
p.a {
  font-style: italic;
}
p.thick  {
  font-weight: bold;
}
p.small  {
  font-size:  small;
}
.wrapper {
  width: 300px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 20vh;
  text-align:center;
  font-size: 1.5rem;
}

textarea::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

textarea::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #4285F4; }
/*.col-xs-3:not(:last-child) {
    border-right: 1px solid #ccc;
}*/

</style>

<?php
// define variables and set to empty values

include 'RandomWalk.php';
$Input = $nameErr = $label1= $label2="";
$Output=[];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

         if (empty($_POST["Input"])) {
          $nameErr = "At least one term is required";
        }else {


         $label1="<h4>Concept code CUI    Prefered term   </h4>";
         $Input = $_POST["Input"];
         $Output = MetaMapLite_input($_POST["Input"]);
        }

}


function MetaMapLite_input($data) {

// create  sample.txt

$PathToFile= getcwd()."\public_mm_lite";
$my_file_in = '\sample2.txt';
$handle = fopen($PathToFile.$my_file_in, 'w') or die('Cannot open file:  '.$my_file_in);
fwrite($handle, $data);
fclose($handle);

//call system console in order to execute metamaplite batch file
if (file_exists(getcwd()."\public_mm_lite\toto.txt")) unlik(getcwd()."\public_mm_lite\toto.txt");
$last_line=system('cmd /k  "cd '.getcwd()."\public_mm_lite   && metamaplite.bat sample2.txt 1>toto.txt exit " ,$retval) ;
exec('%windir%\system32\rundll32.exe advapi32.dll,ProcessIdleTasks');
// just for waiting
foreach($retval as $key => $value)

{

   $i++;

}





// read the resulting file

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


?>
<div class="container-fluid">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="row">
    <div class="col-sm-4 bg-gradient-light" >
    <h3>Expand Concetps from UMLS ontology</h3>
        <form name="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group" >
        <label for="comment">Enter Initial Seeds Terms :</label>
        <textarea class="form-control rounded-0" rows="5" id="comment" name="Input" ></textarea>
        </div>
         <!--<button type="submit" class="btn btn-default" onClick="addContent('myDiv','<input type=\'submit\' name=\'cluster\'  class=\'btn btn-default\' value=\'Extend random Walk and co-occurence\'>');">Submit</button>-->
         <div class="text-right"><button type="submit"  class="btn btn-primary">Process</button></div>

         <textarea class="form-control rounded-0" id="ShowResultMetaMap" rows="20"></textarea>
    </div>

    <div class="col-sm-4" id="grad1">
        <div class="row">
            <div class="col-sm-12" style="background-color: #b8daff;">
                <h4>Random Walk Parameters:</h4>
                <div class="col-sm-6" style="background-color: #b8daff;">
                     <div class="input-group">
                      <span class="input-group-addon">Number of walk :</span>
                      <input id="msg" type="text" class="form-control" name="msg" placeholder="Additional Info">
                     </div>
                     <div class="input-group">
                      <span class="input-group-addon">Lenght of walk  :</span>
                      <input id="msg" type="text" class="form-control" name="msg" placeholder="Additional Info">
                     </div>
                    <br>

                </div>


                <div class="col-sm-6" style="background-color: #b8daff;">
                                        <div class="input-group">
                      <span class="input-group-addon">Deep of walk :</span>
                      <input id="msg" type="text" class="form-control" name="msg" placeholder="Additional Info">
                     </div>
                    <br>
                </div>
            </div>
            </div>

        <div class="row">
        <div class="col-sm-12" style="background-color: #b8daff;">
        <div class="checkbox">
        <h4>REL (Relationship):</h4>
        <div class="row">
            <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="CHD"> <p class="thick">CHD Has child relationship in a Metathesaurus source vocabulary.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="chd" type="text" class="form-control" name="chd" >
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="PAR"> <p class="thick">PAR Has parent relationship in a Metathesaurus source vocabulary.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="par" type="text" class="form-control" name="par" >
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="QB"> <p class="thick">QB :Can be qualified by.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="qb" type="text" class="form-control" name="qb" >
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="RB"> <p class="thick">RB :Has a broader relationship.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="rb" type="text" class="form-control" name="rb" >
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="RL"> <p class="thick">RL :The two concepts are similar or 'alike'.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="rl" type="text" class="form-control" name="rl" >
               </div>
            </div>
        </div>
         <div class="row">
        <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="RO"> <p class="thick">RO :Has relationship other than synonymous, narrower, or broader.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="ro" type="text" class="form-control" name="ro" >
               </div>
            </div>
        </div>
         <div class="row">
        <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="RQ"> <p class="thick">RQ :Related and possibly synonymous.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="rq" type="text" class="form-control" name="rq" >
               </div>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="RU"> <p class="thick">RU :Related, unspecified.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="ru" type="text" class="form-control" name="ru" >
               </div>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="SIB"> <p class="thick">SIB :Has sibling relationship in a Metathesaurus source vocabulary.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="sib" type="text" class="form-control" name="sib" >
               </div>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-9" style="background-color: #b8daff;"><label><input type="checkbox" name="SY"> <p class="thick">SY  :Source asserted synonymy.</p></label></div>
            <div class="col-sm-3" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">Weight</span>
               <input id="sy" type="text" class="form-control" name="sy" >
               </div>
            </div>
        </div>
        </div>
        </div>

        </div>
    </div>
    <div class="col-sm-4" >
    <div class="checkbox">
        <h4>Proposed formulation:</h4>

    </div>

    </div>


  </div>


<?php

echo $label1;

$arrlength = count($Output);

for($x = 0; $x < $arrlength; $x++) {
    echo ($Output[$x][4]."  ".$Output[$x][3]);
    echo "<br>";
}

//if (!empty($Output))echo '<input type="submit" name="cluster"  class="btn btn-default" value="Extend random Walk and co-occurence">';
if (isset($_POST["cluster"])) {

    $cui_in[0][0]=$Output[0][4];
    $cui_in[0][1]=$Output[0][3];
    $n=20;
    $result =found_cluster($cui_in,$n);
$arrlength = count($result);

for($x = 0; $x < $arrlength; $x++) {
    echo ($result[$x][0]."  ".$result[$x][1]."  ".$result[$x][2]."  ".$result[$x][3]);
    echo "<br>";
}

}



?>
</div>
</body>
</html>
