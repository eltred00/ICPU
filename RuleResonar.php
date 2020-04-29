<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/css/bootstrap-grid.css" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="ProcessForm.js"></script>
</head>
<body>
<div class="container-fluid">
    <h3> TAXI Based Decision system for pediatric transfusion</h3>  
    <div class="col-sm-4" >
     <h4> Context </h4> 
     <div class="form-group" >
                        <div class="input-group">
                         <span class="input-group-addon"   >Age :</span>
                         <input id="NW" type="text" class="form-control" name="msg" >
                        </div>
                        <div class="input-group">
                         <span class="input-group-addon">Reason of admition:</span>
                         <input id="LW" type="text" class="form-control" name="msg" >
                        </div>
                       <div class="input-group">
                         <span class="input-group-addon">General conditions:</span>
                         <input id="DW" type="text" class="form-control" name="msg" >
                        </div>
                         <div class="input-group">
                         <span class="input-group-addon">Daitls:</span>
                         <input id="DW" type="text" class="form-control" name="msg" >
                        </div>
                            
                        </div>
    </div>

    <div class="col-sm-4" >
      <h4> Rules execution Output </h4>  
    </div>

    <div class="col-sm-4" >
      <h4> Proposed related abstracts </h4>   
    </div>
</div>
</body>
</html>