/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

$('#submit').click(function(event ) {
      event.preventDefault();
    // Collect informations from random walk parameters
            $('#ShowResultMetaMap').val('');  
               $.post("Process.php", $("#form1").serialize()  , function(data){ 
                   var trans = data.substring(data.indexOf("["));
                   var dob =JSON.parse(trans);
                   var nodes = [];
                   var list_nodes = [];
                   var edges =[];
                  
                if (dob[0]) {      
                   // this to remouve unwanted text comminig from Php
                   //var dob = JSON.parse(trans[0].substring(data[0].indexOf("[")));
                  // var dob = JSON.parse(trans[0]);
                  $('#cluster').prop('disabled', false);
                  $.each(dob[0], function (i, value) {                      
                    $.each(value, function (j, value) {
                       
                       $('#ShowResultMetaMap').val($('#ShowResultMetaMap').val() + " " + value  );
                       $( '#ShowResultMetaMap' ).append( "</br>" ); 
                     });
                    $('#ShowResultMetaMap').val($('#ShowResultMetaMap').val() + "\n" );
                    nodes.push({id: i, label: value['code']+" "+ value['desc'] });
                    list_nodes.push(value['code']);
                 });
                 // display graph 
 var nodes1 = new vis.DataSet(nodes);  
var label ="";
                     //create an array with edges 
                    $.each(dob[1], function (i, value) {
                        
                                if(value['rela']!== null) {
                                label = value['rel']+"("+value['rela']+")";
                                 edges.push({from: list_nodes.indexOf(value['concept_1']), to: list_nodes.indexOf(value['concept_2']), label:label, color:'red' ,arrows:'to', dashes:false});
                            } else {
                            /*label=label + " ,color:{color:'red'}:"*/
                      edges.push({from: list_nodes.indexOf(value['concept_1']), to: list_nodes.indexOf(value['concept_2']), label:value['rel'] ,arrows:'to', dashes:false});}
                 });


  // create an array with edges
  var edges1 = new vis.DataSet(edges);

  // create a network
  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes1,
    edges: edges1
  };
  var options = {};
  var network = new vis.Network(container, data, options);



    network.on("click", function (params) {
        params.event = "[original event]";
       // document.getElementById('eventSpan').innerHTML = '<h2>Click event:</h2>' + JSON.stringify(params, null, 4);
    });              
                 
                 
                  }else{alert ("Nothing was found for you entred text!");} 
                     }).fail(function() {        
           // just in case posting your form failed
                    alert( "Posting failed." );
            
       }); 
			return false; //don't let the page refresh on submit.
		});
                
   // If button cluster had been hitten              
$('#cluster').click(function(event ) {
  
     $('#pleaseWaitDialog').modal('show'); // show modal dailog until processing task will finish
           event.preventDefault();
             var CheckSqlCondition="";
             var CheckSabselection="(";
             
             //var coocure=0;
             var found =0;
             var pram_coocurence=0;
             var initial_coocurence=0;
                $( ".check" ).each(function( index ) {
                    // user SAB collection
                 if ((($(this).attr('id')=== 'MSH') || ($(this).attr('id')=== 'MTH') || ($(this).attr('id')=== 'SNOMEDCT_US') || ($(this).attr('id')=== 'HL7V3') || ($(this).attr('id')=== 'NCBI')) && $(this).prop('checked')){
                     if (found === 0) {
                         CheckSabselection = CheckSabselection +" sab ='"+  $(this).prop('name') +"'";
                     }else
                     {
                         CheckSabselection = CheckSabselection +  " or " +" sab ='"+ $(this).prop('name')+"'";
                     }
                    found ++;
               }  else
               {
                if (($(this).attr('id')=== 'ucri') && $(this).prop('checked')) {
                initial_coocurence=1;
                
                }else {
                if (($(this).attr('id')=== 'ucrw') && $(this).prop('checked')) {
                pram_coocurence=1;
                
                } else {
                    // user relation collection     
                   if (($(this).attr('id')!== 'checkAll') && ($(this).attr('id')!== 'co') && $(this).prop('checked')){
                    if (CheckSqlCondition === "" ){
                    CheckSqlCondition = CheckSqlCondition + " REL = '" + $(this).prop('name')+ "'  ";
                    }else
                    {
                    CheckSqlCondition = CheckSqlCondition + " or  REL = '" + $(this).prop('name')+ "'  ";    
                    }
                    } 
                   }
                    } 
                        }   
                          }  
                 ); 
                 if (found !== 0) {
                        CheckSabselection = CheckSabselection + " )";
                   }else
                   { //aucun choix n'a été fait.
                       CheckSabselection="";
                   }
                  //$('input[name=cooccure]:checked').val();
               
            // take data from ShowResultMetaMap textarea
            //use array to append data
            
            var jsonObj = [];
            
            var lines= $('#ShowResultMetaMap').val().split('\n');
            for(var i = 0;i < lines.length;i++){
                //code here using lines[i] which will give you each line
                //codes  = codes + " { 'CODE' : '"+ lines[i].substring(0,10) +"'}";
                var item = {};
                var item2 = {};
                var k=0;
                if (lines[i] != ""){
                item2["all"]=lines[i].toString().trim();
                k=item2["all"].indexOf(" ");
                item["code"] = item2["all"].substring(0,k); 
                item["desc"] = item2["all"].substring(k+1);
                jsonObj.push(item);}
                 }
               var res1=JSON.stringify(jsonObj);
               var str_json = "json_string=" + res1;
//              $.post( "Process.php", str_json  );
               $('#ShowResultCluster').val('');  
               $.post("Process.php", str_json + "&par1=" + CheckSqlCondition + "&par2=" + $('input[name=cooccure]:checked').val() +"&NW=" + $('#NW').val() + "&FR=" + $('#FR').val() + "&LW=" + $('#LW').val()
               + "&DW=" + $('#DW').val()+ "&ST=" + $('#ST').val() +"&par3=" + CheckSabselection + "&par4=" + pram_coocurence + "&par5=" + initial_coocurence , function(data){ 
                   // this to remouve unwanted text comminig from Php
                
//                  $('#firstwait2').css('display','none');
                   var dob = JSON.parse(data.substring(data.indexOf("[")));
                   var nodes = [];
                   var list_nodes = [];
                   var edges =[];
              
                if (dob[0]) {     
                
                  $.each(dob[0], function (i, value) {
                   $.each(value, function (j, value) {
                       $('#ShowResultCluster').val($('#ShowResultCluster').val() + " " + value  );
                       $( '#ShowResultCluster' ).append( "</br>" );

                    });
                    $('#ShowResultCluster').val($('#ShowResultCluster').val() + "\n" ); 
                     nodes.push({id: i, label: value['code']+" "+ value['desc'] });
                    list_nodes.push(value['code']);
                 });
                 // display cluster founding button 
                   $('#pleaseWaitDialog').modal('hide');
                   $('#exportResult').prop('disabled', false);
                    $('#gotoroot').prop('disabled', false);
  var nodes1 = new vis.DataSet(nodes);  
var label ="";
                     //create an array with edges 
                    $.each(dob[1], function (i, value) {
                            if(value['rela']!== null) {
                                label = value['rel']+"("+value['rela']+")";
                                 edges.push({from: list_nodes.indexOf(value['concept_1']), to: list_nodes.indexOf(value['concept_2']), label:label, color:{color:'red'} ,arrows:'to', dashes:false});
                            } else {
                            /*label=label + " ,color:{color:'red'}:"*/
                      edges.push({from: list_nodes.indexOf(value['concept_1']), to: list_nodes.indexOf(value['concept_2']), label:value['rel'] ,arrows:'to', dashes:false});}
                 });


  // create an array with edges
  var edges1 = new vis.DataSet(edges);

  // create a network
  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes1,
    edges: edges1
  };
  var options = {};
  var network = new vis.Network(container, data, options);



    network.on("click", function (params) {
        params.event = "[original event]";
       // document.getElementById('eventSpan').innerHTML = '<h2>Click event:</h2>' + JSON.stringify(params, null, 4);
    });             
                 
                 
                 
                 
                 
                  }else{alert ("Nothing was found for you entred text!");} 
                     }).fail(function() {        
           // just in case posting your form failed
                    alert( "Posting failed." );
            
       }); 
			return false; //don't let the page refresh on submit.
		});
                
       
$('#exportResult').click(function(event) {
    event.preventDefault();
 
       var download = function() {
       for(var i=0; i<arguments.length; i++) {
         var iframe = $('<iframe style="visibility: collapse;"></iframe>');
         $('body').append(iframe);
         var content = iframe[0].contentDocument;
         var form = '<form action="' + arguments[i] + '" method="GET"></form>';
         content.write(form);
         $('form', content).submit();
         setTimeout((function(iframe) {
           return function() { 
             iframe.remove(); 
           }
         })(iframe), 100);
       }
     }   
     
                download('Export_cui.php', 'Export_rela.php'); 
       }); 
//		
//$('#exportResult').click(function(event) {
//    event.preventDefault();
//              //window.location = 'Export_cui.php'; 
//              window.location = 'Export_rela.php'; 
//       }); 	
     

 $('#gotoroot').click(function(event) {
    event.preventDefault();
  $.post("root.php",  function(data){ 
                   var dob = JSON.parse(data.substring(data.indexOf("[")));
                   var nodes = [];
                   var list_nodes = [];
                   var edges =[];
              
                if (dob[0]) {     
                 
                  $.each(dob[0], function (i, value) {
                   $.each(value, function (j, value) {
                       $('#ShowResultCluster').val($('#ShowResultCluster').val() + " " + value  );
                       $( '#ShowResultCluster' ).append( "</br>" );

                    });
                    $('#ShowResultCluster').val($('#ShowResultCluster').val() + "\n" ); 
                     nodes.push({id: i, label: value['code']+" "+ value['desc'] });
                    list_nodes.push(value['code']);
                 });
                 // display cluster founding button 
                   $('#pleaseWaitDialog').modal('hide');
                   $('#exportResult').prop('disabled', false);
                    $('#gotoroot').prop('disabled', false);
  var nodes1 = new vis.DataSet(nodes);  
var label ="";
                     //create an array with edges 
                    $.each(dob[1], function (i, value) {
                            if(value['rela']!== null) {
                                label = value['rel']+"("+value['rela']+")";
                                 edges.push({from: list_nodes.indexOf(value['concept_1']), to: list_nodes.indexOf(value['concept_2']), label:label, color:{color:'red'} ,arrows:'to', dashes:false});
                            } else {
                            /*label=label + " ,color:{color:'red'}:"*/
                      edges.push({from: list_nodes.indexOf(value['concept_1']), to: list_nodes.indexOf(value['concept_2']), label:value['rel'] ,arrows:'to', dashes:false});}
                 });


  // create an array with edges
  var edges1 = new vis.DataSet(edges);

  // create a network
  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes1,
    edges: edges1
  };
  var options = {};
  var network = new vis.Network(container, data, options);
    network.on("click", function (params) {
        params.event = "[original event]";
       // document.getElementById('eventSpan').innerHTML = '<h2>Click event:</h2>' + JSON.stringify(params, null, 4);
    });                    
                  }else{alert ("Nothing was found for you entred text!");}           
       }); 
    }); 
    
    
                
});


                
                

