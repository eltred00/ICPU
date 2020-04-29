/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function addContent( myDiv,content) {
//     document.getElementById(divName).innerHTML += content  ;
     $("#"+ myDiv ).append(content);
}  

function myFunction() {
  document.getElementById("demo").innerHTML = "Paragraph changed!";
}
