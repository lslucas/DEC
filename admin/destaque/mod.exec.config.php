<?php

 if(isset($_POST['config']) && $_POST['config']==true) {

  foreach($_POST as $chave=>$valor) {
   $res[$chave] = $valor;
  }


     $res['random']     = isset($res['random']) && $res['random']=='true'?'true':'false';
     $res['showheader'] = isset($res['showheader']) && $res['showheader']=='true'?'true':'false';
     $res['showheader'] = 'true';

     $sql= "UPDATE ".TABLE_PREFIX."_${var['path']} SET

  		  ${var['pre']}_time=?,
  		  ${var['pre']}_random=?,
  		  ${var['pre']}_showheader=?
	";
     $qry=$conn->prepare($sql);
     $qry->bind_param('iss', $res['time'], $res['random'], $res['showheader']);
     $qry->execute();


   if ($qry==false) echo "<p class='error'><span class='error-icon'>Erro inesperado!</span></p><br/><br/>";
    else {

     $qry->close();

     echo "<p class='success'><span class='success-icon'>Configurações aplicadas!</span></p><br/><br/>";

     #insere o video caso exista 
     include_once 'mod.exec.xml.php';

    }


 } #config==true
