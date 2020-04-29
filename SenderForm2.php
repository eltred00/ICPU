<?php
// define variables and set to empty values
  session_start();
ini_set('max_execution_time', 2000);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/css/bootstrap-grid.css" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="ProcessForm.js"></script>
    <link href="styles/css/vis.min.css" rel="stylesheet" type="text/css"/>
      <script src="styles/js/vis.js" type="text/javascript"></script>
 
</head>
<body>
<style type="text/css"> 
.error { 
    display: block; 
    color: red; 
    font-style: italic; 
} 
#message { 
    display:none; 
    font-size:15px; 
    font-weight:bold; 
    color:#333333; 
} 
 
/* The radio */
.radio {
 
     display: block;
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 20px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

/* Hide the browser's default radio button */
.radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkround {

    position: absolute;
    top: 6px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #fff ;
    border-color:#f8204f;
    border-style:solid;
    border-width:2px;
     border-radius: 50%;
}


/* When the radio button is checked, add a blue background */
.radio input:checked ~ .checkround {
    background-color: #fff;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkround:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.radio input:checked ~ .checkround:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.radio .checkround:after {
     left: 2px;
    top: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background:#f8204f;
    
 
}

 

</style> 
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
#message { 
    display:none; 
    font-size:15px; 
    font-weight:bold; 
    color:#333333; 
} 

body {
  color: #6a6c6f;
  background-color: #f1f3f6;
  margin-top: 30px;
}

.container {
  max-width: 960px;
}

.panel-default>.panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #e4e5e7;
  padding: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.panel-default>.panel-heading a {
  display: block;
  padding: 10px 15px;
}

.panel-default>.panel-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
  background-color: #eee;
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.accordion-option {
  width: 100%;
  float: left;
  clear: both;
  margin: 15px 0;
}

.accordion-option .title {
  font-size: 20px;
  font-weight: bold;
  float: left;
  padding: 0;
  margin: 0;
}

.bd-example-modal-lg .modal-dialog{
    display: table;
    position: relative;
    margin: 0 auto;
    top: calc(50% - 24px);
}
  .bd-example-modal-lg .modal-dialog .modal-content{
    background-color: transparent;
    border: none;
}
</style>
<script>
$(document).ready(function() {
$("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});
$(".check").prop('checked', "");
// choix des relations
//$("#CHD").prop('checked', 'checked');
//$("#PAR").prop('checked', 'checked');
//$("#QB").prop('checked', 'checked');
//$("#RL").prop('checked', 'checked');
//$("#RN").prop('checked', 'checked');
//$("#RB").prop('checked', 'checked');
$("#RO").prop('checked', 'checked');
//$("#SIB").prop('checked', 'checked');
// choix des Sab
$("#MTH").prop('checked', 'checked');
$("#MSH").prop('checked', 'checked');
//$("#NCBI").prop('checked', 'checked');
$("#NCI").prop('checked', 'checked');
//$("#SNOMEDCT_US").prop('checked', 'checked');
//$("#HL7V3").prop('checked', 'checked');

$("#NW").val('30');
$("#LW").val('5');
$("#DW").val('1');
$("#ST").val('4');
$("#FR").val('6');
$("#NWT").val('10');
$("#LWT").val('5');
$("#DWT").val('1');

$("#cooccure").prop('checked', 'checked');
$("#ucrw").prop('checked', 'checked');
$("#ucrI").prop('checked', 'checked');
});
</script>

<div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" id="pleaseWaitDialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 240px">
          <div class="modal-body">
          <div class="text-center">
              <span class="fa fa-spinner fa-spin fa-3x" style="color:blanchedalmond"></span><span style="color:blanchedalmond;font-weight: bold" >&nbsp;&nbsp;&nbsp;Processing...</span>
        </div>
        </div>
        </div>
    </div>
</div>

<!--<div class="container-fluid">
<a href="#myModal" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-info-sign"></span></a>
    Modal 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
       Modal content
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <img class="img-responsive" style="margin:0 auto;" src="img/NewProjectSchema.jpg" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>-->

<div class="col-sm-8" >
    <div class="row">
    <h4>Explore concepts from UMLS with initial terms </h4>  
<br>
    </div>
<div class="row">
    <div class="col-sm-6 ">
            
        
               <form name="form1" method="post" id="form1" > 
                    <div class="form-group" >
                        <label for="comment">Enter Initial Seeds Terms or <a href="#myModal" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-download-alt"> Importing Rules </span></a> :</label>
                        <textarea class="form-control" rows="2" id="comment" name="Input" ></textarea>
                        </div>
                        <div class="align-text-bottom">
                            <button type="submit" class="btn btn-primary" id="submit">Find related concepts</button>  
                        </div>
                        <br>
                 </form>
            <textarea class="form-control rounded-0" id="ShowResultMetaMap" rows="4"></textarea>
            <br>

    </div>
    <div class="col-sm-6">
        <br>
        <div class="align-text-bottom">


        <button type="submit" class="btn btn-primary" id="cluster" disabled >Find clusters</button>&nbsp;<button type="submit" class="btn btn-primary" id="gotoroot" disabled>Get back to the roots</button>&nbsp;
<!--<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
      <li><a href="#">JavaScript</a></li>
    </ul>
  </div>-->
        
        
        
        
        
        <button type="submit" class="btn btn-primary" id="exportResult" >Export results</button></div>
        <br>
        <textarea class="form-control rounded-0" id="ShowResultCluster" rows="8"  ></textarea> 
    </div>
</div>
<div class="row">
                <div class="col-sm-12" >
                   
    
                <div id="mynetwork" class="vis-network" tabindex="900" style="position: fixed; background-color:rgba(255, 255, 255, 255) ;overflow: hidden; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;"><canvas  style="width: 100%; height: 100%;position: fixed; touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;"></canvas></div>
          
            </div>
</div>
</div>
<div class="col-sm-4" >
<div class="container">
  <div class="accordion-option">
    <h3 class="title">Criterion for Relevant Terms Exploration. </h3>
    <!--<a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#accordion"></a>-->
  </div>
  <div class="clearfix"></div>
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            Random Walk Parameters:
        </a>
      </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
           
           <div class="col-sm-12" style="background-color: #b8daff;"> 
               
                <div class="col-sm-10" style="background-color: #b8daff;">
                    <br>
                    <form name="form1" method="post" id="form1" >
                        <div class="form-group" >
                        <div class="input-group">
                         <span class="input-group-addon"   >Number of walk :</span>
                         <input id="NW" type="text" class="form-control" name="msg" >
                        </div>
                        <div class="input-group">
                         <span class="input-group-addon">Lenght of walk &nbsp;&nbsp;:</span>
                         <input id="LW" type="text" class="form-control" name="msg" >
                        </div>
                       <div class="input-group">
                         <span class="input-group-addon">Deep of walk &nbsp;&nbsp;&nbsp;&nbsp;:</span>
                         <input id="DW" type="text" class="form-control" name="msg" >
                        </div>
                         <div class="input-group">
                         <span class="input-group-addon">nodes visit. freq. thresh. :</span>
                         <input id="ST" type="text" class="form-control" name="msg" >
                        </div>
                        <input type="checkbox" class="check" id="ucrw" name="ucrw" checked> Use co-occurrences to biases the Random Walk.
                        <input type="checkbox" class="check" id="ucri" name="ucri" checked> Explore co-occurrences within the previous  terms.
                          <div class="input-group">
                          <span class="input-group-addon">Co-Occu. Freq. thresh. :</span>
                          <input id="FR" type="text" class="form-control" name="msg" >
                         </div>
                        </div>
                     
                        
                    </form>
                </div>
              
            </div>
       
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Relationship parameters
        </a>
      </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
        
       <div class="col-sm-12" style="background-color: #b8daff;">
        <div class="checkbox">
        <h4>REL (Relationship):</h4>
        <div class="row">
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="CHD" name="CHD" checked> <p class="thick">CHD Has child relationship in a Metathesaurus source vocabulary.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="chd" type="text" class="form-control" name="chd" >
               </div>
            </div>            -->
        </div>
        <div class="row">
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="PAR"  name="PAR" checked> <p class="thick">PAR Has parent relationship in a Metathesaurus source vocabulary.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="par" type="text" class="form-control" name="par" >
               </div>
            </div>            -->
        </div>        
        <div class="row">
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="QB" name="QB" checked> <p class="thick">QB :Can be qualified by.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="qb" type="text" class="form-control" name="qb" >
               </div>
            </div>            -->
        </div>  
        <div class="row">
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="RB" name="RB" checked> <p class="thick">RB :Has a broader relationship.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="rb" type="text" class="form-control" name="rb" >
               </div>
            </div>            -->
        </div>
        <div class="row">
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="RN" name="RN" checked> <p class="thick">RN :Has a narrower relationship.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="rb" type="text" class="form-control" name="rb" >
               </div>
            </div>            -->
        </div>
        <div class="row">
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="RL" name="RL" checked> <p class="thick">RL :The two concepts are similar or 'alike'.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="rl" type="text" class="form-control" name="rl" >
               </div>
            </div>            -->
        </div>
         <div class="row">
        <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="RO" name="RO" checked> <p class="thick">RO :Has relationship other than synonymous, narrower, or broader.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="ro" type="text" class="form-control" name="ro" >
               </div>
            </div>            -->
        </div>
         <div class="row">
        <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="RQ"  name="RQ" checked> <p class="thick">RQ :Related and possibly synonymous.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="rq" type="text" class="form-control" name="rq" >
               </div>
            </div>            -->
        </div>
        <div class="row">
        <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="RU"  name="RU" checked> <p class="thick">RU :Related, unspecified.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="ru" type="text" class="form-control" name="ru" >
               </div>
            </div>            -->
        </div>
        <div class="row">
        <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="SIB"  name="SIB" checked> <p class="thick">SIB :Has sibling relationship in a Metathesaurus source vocabulary.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="sib" type="text" class="form-control" name="sib" >
               </div>
            </div>            -->
        </div>
        <div class="row">
        <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="SY"  name="SY" checked> <p class="thick">SY  :Source asserted synonymy.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="sy" type="text" class="form-control" name="sy" >
               </div>
            </div>            -->
        </div>
        <div class="row">
        <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="SEM"  name="SEM" checked> <p class="thick">SEM  :Semantic relations.</p></label></div>
<!--            <div class="col-sm-4" style="background-color: #b8daff;">
            <div class="input-group">
             <span class="input-group-addon">wgt.</span>
               <input id="sy" type="text" class="form-control" name="sy" >
               </div>
            </div>            -->
        </div>
        <div class="checkbox">
         <label>
         <input type="checkbox" class="check" id="checkAll" checked> Uncheck All
         </label>
         </div>
<!--        <button id="SelectRelation" class="btn btn-primary" value="1">Unselect all</button>-->
        </div>
        </div>   
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingThree">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="false" aria-controls="collapsethree">
          Source abbreviation (SAB) :
        </a>
      </h4>
      </div>
      <div id="collapsethree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingthree">
        <div class="panel-body">
        <div class="col-sm-12" style="background-color: #b8daff;">
        <div class="checkbox">
        <div class="row">
           <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="MTH" name="MTH" checked> <p class="thick">MTH:</p> (UMLS) Unified Medical Language System Metathesaurus</label></div>
           <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="MSH" name="MSH" checked> <p class="thick">MSH: Medical Subject Headings</p></label></div>
           <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="NCBI" name="NCBI" checked> <p class="thick">NCBI:National Center for Biotechnology Information Taxonomy (Pubmed)</p></label></div>
           <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="NCI" name="NCI" checked> <p class="thick">NCI:The National Cancer Institute Thesaurus</p></label></div>
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="SNOMEDCT_US" name="SNOMEDCT_US" checked> <p class="thick">SNOMEDCT:SNOMED International Clinical Terms</p></label></div>
            <div class="col-sm-12" style="background-color: #b8daff;"><label><input type="checkbox" class="check" id="HL7V3" name="HL7V3.0" checked> <p class="thick">HL7 :Health Level Seven International Vocabulary </p></label></div>
           </div>
          </div>
        </div>
       </div>
      </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingfive">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
          Semantic relationships :
        </a>
      </h4>
      </div>
      <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
        <div class="panel-body">
        <div class="col-sm-12" style="background-color: #b8daff;">
        <div class="checkbox">
        <div class="row">
<!--            <label><input type=checkbox class=check id="isa" name= "isa" checked>isa</label>&nbsp;-->
<label><input type=checkbox class=check id="semantics" name= "semantics" checked>Only with semantic relation </label>&nbsp;
<!--<label><input type=checkbox class=check id="mapped_from" name= "mapped_from" checked>mapped_from</label>&nbsp;
<label><input type=checkbox class=check id="mapped_to" name= "mapped_to" checked>mapped_to</label>&nbsp;
<label><input type=checkbox class=check id="has_finding_site" name= "has_finding_site" checked>has_finding_site</label>&nbsp;
<label><input type=checkbox class=check id="finding_site_of" name= "finding_site_of" checked>finding_site_of</label>&nbsp;
<label><input type=checkbox class=check id="method_of" name= "method_of" checked>method_of</label>&nbsp;
<label><input type=checkbox class=check id="has_method" name= "has_method" checked>has_method</label>&nbsp;
<label><input type=checkbox class=check id="associated_morphology_of" name= "associated_morphology_of" checked>associated_morphology_of</label>&nbsp;
<label><input type=checkbox class=check id="has_associated_morphology" name= "has_associated_morphology" checked>has_associated_morphology</label>&nbsp;
<label><input type=checkbox class=check id="has_procedure_site" name= "has_procedure_site" checked>has_procedure_site</label>&nbsp;
<label><input type=checkbox class=check id="procedure_site_of" name= "procedure_site_of" checked>procedure_site_of</label>&nbsp;
<label><input type=checkbox class=check id="permuted_term_of" name= "permuted_term_of" checked>permuted_term_of</label>&nbsp;
<label><input type=checkbox class=check id="has_permuted_term" name= "has_permuted_term" checked>has_permuted_term</label>&nbsp;
<label><input type=checkbox class=check id="same_as" name= "same_as" checked>same_as</label>&nbsp;
<label><input type=checkbox class=check id="has_causative_agent" name= "has_causative_agent" checked>has_causative_agent</label>&nbsp;
<label><input type=checkbox class=check id="causative_agent_of" name= "causative_agent_of" checked>causative_agent_of</label>&nbsp;
<label><input type=checkbox class=check id="possibly_equivalent_to" name= "possibly_equivalent_to" checked>possibly_equivalent_to</label>&nbsp;
<label><input type=checkbox class=check id="has_direct_procedure_site" name= "has_direct_procedure_site" checked>has_direct_procedure_site</label>&nbsp;
<label><input type=checkbox class=check id="direct_procedure_site_of" name= "direct_procedure_site_of" checked>direct_procedure_site_of</label>&nbsp;
<label><input type=checkbox class=check id="is_interpreted_by" name= "is_interpreted_by" checked>is_interpreted_by</label>&nbsp;
<label><input type=checkbox class=check id="interprets" name= "interprets" checked>interprets</label>&nbsp;
<label><input type=checkbox class=check id="has_part" name= "has_part" checked>has_part</label>&nbsp;
<label><input type=checkbox class=check id="part_of" name= "part_of" checked>part_of</label>&nbsp;
<label><input type=checkbox class=check id="has_active_ingredient" name= "has_active_ingredient" checked>has_active_ingredient</label>&nbsp;
<label><input type=checkbox class=check id="active_ingredient_of" name= "active_ingredient_of" checked>active_ingredient_of</label>&nbsp;
<label><input type=checkbox class=check id="has_pathological_process" name= "has_pathological_process" checked>has_pathological_process</label>&nbsp;
<label><input type=checkbox class=check id="pathological_process_of" name= "pathological_process_of" checked>pathological_process_of</label>&nbsp;
<label><input type=checkbox class=check id="has_mapping_qualifier" name= "has_mapping_qualifier" checked>has_mapping_qualifier</label>&nbsp;
<label><input type=checkbox class=check id="mapping_qualifier_of" name= "mapping_qualifier_of" checked>mapping_qualifier_of</label>&nbsp;
<label><input type=checkbox class=check id="has_occurrence" name= "has_occurrence" checked>has_occurrence</label>&nbsp;
<label><input type=checkbox class=check id="occurs_in" name= "occurs_in" checked>occurs_in</label>&nbsp;
<label><input type=checkbox class=check id="has_direct_morphology" name= "has_direct_morphology" checked>has_direct_morphology</label>&nbsp;
<label><input type=checkbox class=check id="direct_morphology_of" name= "direct_morphology_of" checked>direct_morphology_of</label>&nbsp;
<label><input type=checkbox class=check id="indirect_procedure_site_of" name= "indirect_procedure_site_of" checked>indirect_procedure_site_of</label>&nbsp;
<label><input type=checkbox class=check id="has_indirect_procedure_site" name= "has_indirect_procedure_site" checked>has_indirect_procedure_site</label>&nbsp;
<label><input type=checkbox class=check id="intent_of" name= "intent_of" checked>intent_of</label>&nbsp;
<label><input type=checkbox class=check id="has_intent" name= "has_intent" checked>has_intent</label>&nbsp;
<label><input type=checkbox class=check id="dose_form_of" name= "dose_form_of" checked>dose_form_of</label>&nbsp;
<label><input type=checkbox class=check id="has_dose_form" name= "has_dose_form" checked>has_dose_form</label>&nbsp;
<label><input type=checkbox class=check id="direct_substance_of" name= "direct_substance_of" checked>direct_substance_of</label>&nbsp;
<label><input type=checkbox class=check id="has_direct_substance" name= "has_direct_substance" checked>has_direct_substance</label>&nbsp;
<label><input type=checkbox class=check id="was_a" name= "was_a" checked>was_a</label>&nbsp;
<label><input type=checkbox class=check id="inverse_was_a" name= "inverse_was_a" checked>inverse_was_a</label>&nbsp;
<label><input type=checkbox class=check id="interpretation_of" name= "interpretation_of" checked>interpretation_of</label>&nbsp;
<label><input type=checkbox class=check id="has_interpretation" name= "has_interpretation" checked>has_interpretation</label>&nbsp;
<label><input type=checkbox class=check id="direct_device_of" name= "direct_device_of" checked>direct_device_of</label>&nbsp;
<label><input type=checkbox class=check id="has_direct_device" name= "has_direct_device" checked>has_direct_device</label>&nbsp;
<label><input type=checkbox class=check id="moved_to" name= "moved_to" checked>moved_to</label>&nbsp;
<label><input type=checkbox class=check id="moved_from" name= "moved_from" checked>moved_from</label>&nbsp;
<label><input type=checkbox class=check id="has_component" name= "has_component" checked>has_component</label>&nbsp;
<label><input type=checkbox class=check id="component_of" name= "component_of" checked>component_of</label>&nbsp;
<label><input type=checkbox class=check id="has_temporal_context" name= "has_temporal_context" checked>has_temporal_context</label>&nbsp;
<label><input type=checkbox class=check id="temporal_context_of" name= "temporal_context_of" checked>temporal_context_of</label>&nbsp;
<label><input type=checkbox class=check id="subject_relationship_context_of" name= "subject_relationship_context_of" checked>subject_relationship_context_of</label>&nbsp;
<label><input type=checkbox class=check id="has_subject_relationship_context" name= "has_subject_relationship_context" checked>has_subject_relationship_context</label>&nbsp;
<label><input type=checkbox class=check id="entry_version_of" name= "entry_version_of" checked>entry_version_of</label>&nbsp;
<label><input type=checkbox class=check id="has_entry_version" name= "has_entry_version" checked>has_entry_version</label>&nbsp;
<label><input type=checkbox class=check id="entire_anatomy_structure_of" name= "entire_anatomy_structure_of" checked>entire_anatomy_structure_of</label>&nbsp;
<label><input type=checkbox class=check id="has_entire_anatomy_structure" name= "has_entire_anatomy_structure" checked>has_entire_anatomy_structure</label>&nbsp;
<label><input type=checkbox class=check id="associated_finding_of" name= "associated_finding_of" checked>associated_finding_of</label>&nbsp;
<label><input type=checkbox class=check id="has_associated_finding" name= "has_associated_finding" checked>has_associated_finding</label>&nbsp;
<label><input type=checkbox class=check id="definitional_manifestation_of" name= "definitional_manifestation_of" checked>definitional_manifestation_of</label>&nbsp;
<label><input type=checkbox class=check id="has_definitional_manifestation" name= "has_definitional_manifestation" checked>has_definitional_manifestation</label>&nbsp;
<label><input type=checkbox class=check id="finding_context_of" name= "finding_context_of" checked>finding_context_of</label>&nbsp;
<label><input type=checkbox class=check id="has_finding_context" name= "has_finding_context" checked>has_finding_context</label>&nbsp;
<label><input type=checkbox class=check id="device_used_by" name= "device_used_by" checked>device_used_by</label>&nbsp;
<label><input type=checkbox class=check id="uses_device" name= "uses_device" checked>uses_device</label>&nbsp;
<label><input type=checkbox class=check id="access_of" name= "access_of" checked>access_of</label>&nbsp;
<label><input type=checkbox class=check id="has_access" name= "has_access" checked>has_access</label>&nbsp;
<label><input type=checkbox class=check id="associated_with" name= "associated_with" checked>associated_with</label>&nbsp;
<label><input type=checkbox class=check id="finding_method_of" name= "finding_method_of" checked>finding_method_of</label>&nbsp;
<label><input type=checkbox class=check id="has_finding_method" name= "has_finding_method" checked>has_finding_method</label>&nbsp;
<label><input type=checkbox class=check id="disposition_of" name= "disposition_of" checked>disposition_of</label>&nbsp;
<label><input type=checkbox class=check id="has_disposition" name= "has_disposition" checked>has_disposition</label>&nbsp;
<label><input type=checkbox class=check id="due_to" name= "due_to" checked>due_to</label>&nbsp;
<label><input type=checkbox class=check id="cause_of" name= "cause_of" checked>cause_of</label>&nbsp;
<label><input type=checkbox class=check id="used_by" name= "used_by" checked>used_by</label>&nbsp;
<label><input type=checkbox class=check id="uses" name= "uses" checked>uses</label>&nbsp;
<label><input type=checkbox class=check id="occurs_after" name= "occurs_after" checked>occurs_after</label>&nbsp;
<label><input type=checkbox class=check id="occurs_before" name= "occurs_before" checked>occurs_before</label>&nbsp;-->
           
             </div>
          </div>
        </div>
       </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingfour">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
           Co-occurences Parameters
        </a>
      </h4>
      </div>
      <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
        <div class="panel-body">
            <div class="col-sm-12" style="background-color: #b8daff;">
               <label>Using co-occurrences </label>
               <br>
               <input type="radio" id="radio3" name="cooccure" value="3" checked> Without using co-occurrences.<br>   
               <input type="radio" id="radio3" name="cooccure" value="4" > Without using the co-occurrences or the significant threshold.<br>
               <input type="radio" id="radio1" name="cooccure" value="1" >Use co-occurrences within cluster concepts.<br>
               <input type="radio" id="radio2" name="cooccure" value="2">Use co-occurrences between clusters concepts.<br>
        </div>
        </div>
      </div>
    </div>
  
    </div>
</div>  
</div>        
<!--     <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingfive">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
          Formulation Parameters
        </a>
      </h4>
      </div>
      <div id="collapsefive" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingfive">
        <div class="panel-body">
            <div id="tableResult"></div>
            Something to do
        </div>
      </div>
    </div>-->
      
          

     
      
        
        
  

</body>
</html>
