<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> IDE </title>
<script src="ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container-fluid">
  <div class="container">
  <div class="panal">
  <div class="btn-group b ">
    <select id="theme" onchange="changetheme(value)" class="btn btn-default s">
       <option value="chrome" selected>chrome</option> 
       <option value="monokai" >monkai</option>
       <option value="chaos">chaos</option> 
       <option value="ambiance">ambiance</option> 
       <option value="clouds">clouds</option> 
       <option value="clouds_midnight">clouds midnight</option>
       <option value="cobalt">cobalt</option>  
       <option value="crimson_editor">crimson</option>
       <option value="dawn">dawn</option>
       <option value="dracula">dracula</option>
       <option value="dreamweaver">dreamweaver</option>
       <option value="eclipse">eclipse</option>
       <option value="github">github</option>
       <option value="gob">gob</option>
       <option value="gruvbox">gruvbox</option>
       <option value="idle_fingers">idle fingers</option>
       <option value="iplastic">iplastic</option>
       <option value="katzenmilch">katzenmilch</option>
       <option value="kr_theme">kr theme</option>
       <option value="kuroir">kuroir</option>
       <option value="merbivore">merbivore</option>
       <option value="merbivore_soft">merbivore soft</option> 
       <option value="mono_industrial">mono industrial</option>
       <option value="pastel_on_dark">pastel on dark</option>
       <option value="solarized_dark">solarized dark</option>
       <option value="solarized_light">solarized light</option>
       <option value="sqlserver">sqlserver</option>
       <option value="terminal">terminal</option>
       <option value="textmate">textmate</option>
       <option value="tomorrow">tomorrow</option>
       <option value="tomorrow_night">tomorrow night</option>
       <option value="tomorrow_night_blue">tomorrow night blue</option>
       <option value="tomorrow_night_bright">tomorrow night bright</option>
       <option value="tomorrow_night_eighties">tomorrow night eighties</option>
       <option value="twilight">twilight</option>
       <option value="vibrant_ink">vibrant ink</option>
       <option value="xcode">xcode</option>   
   </select>
  
    <select o class="btn btn-default s" onchange="changemode(value)" id="mode">
       <option value="javascript" selected >js</option>
       <option value="c" >c</option> 
       <option value="cpp">c++</option> 
       <option value="python2">python2.7</option>
       <option value="python3">python3</option>
   </select>
 
    <select id="font" onchange="changefont(value)" class="btn btn-default s">
       <option value="10px">10px</option>
       <option value="11px">11px</option> 
       <option value="12px">12px</option> 
       <option value="13px">13px</option> 
       <option value="14px">14px</option> 
       <option value="15px">15px</option> 
       <option value="16px" selected>16px</option> 
       <option value="17px">17px</option> 
       <option value="18px">18px</option> 
       <option value="19px">19px</option> 
       <option value="20px">20px</option> 
       <option value="21px">21px</option> 
       <option value="22px">22px</option> 
       <option value="23px">23px</option> 
       <option value="24px">24px</option> 
       <option value="25px">25px</option> 
       <option value="26px">26px</option> 
       <option value="27px">27px</option> 
       <option value="28px">28px</option> 
       <option value="29px">29px</option> 
       <option value="30px">30px</option> 
   </select>
 </div>
</div>
<div id="editor" >
   
         
</div>


    <form  id="form1" >
          <button  id ="run" class="btn btn-success"  style="float: right;margin-top: 5px;">Run code</button>
          <label class="c">Custom Input
          <input type="checkbox" id="c_input" name="checkbox" onchange="onchecked()">
          <span class="checkmark"></span>
          </label><br><br>
          <textarea name="in" cols="30" rows="5" id="in"><?php if(isset($_POST['in'])){ echo $_POST['in'];  } ?></textarea><br>
    </form>  
<div style="margin-top: 40px;margin-bottom: 40px; width: 100%;height:100%;display: none;" id="output" class="btn-default">
  
</div>
</div>
</div>
<script>
    var editor = ace.edit("editor");
     editor.setValue(
  ` function foo(items) {
        let x = "Write Your Code here ";
              return x;
    }`);
    editor.session.setMode("ace/mode/javascript");
    changefont("16px");
    editor.setShowPrintMargin(false);
    document.getElementById('form1').addEventListener('submit',on_click);
    function changetheme(e){
         // console.log(e);
          editor.setTheme("ace/theme/"+e);
    }
    function changemode(e){
    //   console.log(e);
    var tm = document.getElementById('tm');
    if(tm){
      tm.style.display="none";
      document.getElementById('output').style.display = "none";
    }
    
    switch(e){
    case 'javascript':
    editor.setValue(
  ` function foo(items) {
        let x = "Write Your Code here ";
              return x;
    }
      `)
      editor.session.setMode("ace/mode/"+e);
      break;
    case 'cpp':
        editor.setValue(
    `#include <bits/stdc++.h>
     using namespace std;
     int main(void)
     { 
      // write your code here


        return 0;
     } `
        )
        editor.session.setMode("ace/mode/c_cpp");
        break;

   case 'c':
        editor.setValue(
    `#include <stdio.h>
     int main(void)
     {
      // write your code here

        return 0;
     } `
        )
        editor.session.setMode("ace/mode/c_cpp");
        break;
    case 'python2':
          editor.setValue("# write your code here");
          editor.session.setMode("ace/mode/python");
          break;
    case 'python3':
          editor.setValue("# write your code here");
          editor.session.setMode("ace/mode/python");
          break;

    default:
          editor.setValue("# write your code here");
          }
    }
    function log(){
          console.log(editor.getValue());
    }
    

    function on_click(e){
      e.preventDefault();
      const c = editor.getValue();
      let i = null;
      const l = document.getElementById('mode').value;
      if(document.getElementById('c_input').checked){
         i = document.getElementById('in').value;
         // console.log(i);
         // console.log(typeof i);

      }
      let data = 'code='+encodeURIComponent(c)+'&'+'lang='+l;
      if(i){
        data = data + '&' +'in='+ i;
      }
     // console.log(data);
      let xhr = new XMLHttpRequest();
      xhr.open('POST',l+'.php',true);
      xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded;charset=UTF-8');
      xhr.onload = function(){
      // console.log(this.responseText);
      //console.log(data);
      //console.log(xhr);
      parent = document.getElementById('output');
      parent.removeChild(document.getElementById('loader'))
      document.getElementById('output').style.display="block";
      document.getElementById('output').innerHTML=this.responseText;
    }
    xhr.onprogress = function(){
      var l = document.createElement('div');
      l.id="loader";
      parent = document.getElementById('output');
      parent.appendChild(l);
    }

    xhr.send(data);
 
             
    }
      function myFunction() {
     // console.log('myFunction called !')
      var elmnt = document.getElementById("out");
      var y = elmnt.scrollTop;
      if(y!=0){
      elmnt.style.height=elmnt.scrollHeight + "px";
     }
    }
    function changefont(f){
          //  console.log(f);

          document.getElementById('editor').style.fontSize=f;
    }
    function onchecked(){
      
           const a = document.getElementById('c_input').checked;
           if(a===true){
                        document.getElementById('in').style.display="block";
           }
           else{
                  document.getElementById('in').style.display="none";
           }
    }
</script>
</body>
</html>

<?php

?>