<?php

  foreach($_POST as $chave=>$valor) {
   $res[$chave] = $valor;
  }


# include de mensagens do arquivo atual
 include_once 'inc.exec.msg.php';


 ## verifica se existe um titulo/nome/email com o mesmo nome do que esta sendo inserido
 $sql_valida = "SELECT ${var['pre']}_ano FROM ".TABLE_PREFIX."_${var['path']} WHERE ${var['pre']}_ano=?";
 $qry_valida = $conn->prepare($sql_valida);
 $qry_valida->bind_param('s', $res['ano']); 
 $qry_valida->execute();
 $qry_valida->store_result();

  #se existe um titulo/nome/email assim nao passa
  if ($qry_valida->num_rows<>0 && $act=='insert') {
   echo $msgDuplicado;
   $qry_valida->close();


  #se nao existe faz a inserção
  } else {

     #autoinsert
     include_once $rp.'inc.autoinsert.php';


    $arrTipo = array('estadual', 'municipal', 'particular');
    $arrGuarda = array();

    foreach($arrTipo as $tipo) {

      $string = null;
      $string .= "${var['pre']}_{$tipo}_creche=?,";
      $string .= "${var['pre']}_{$tipo}_preescolar=?,";
      $string .= "${var['pre']}_{$tipo}_fundamental=?,";
      $string .= "${var['pre']}_{$tipo}_especial=?,";
      $string .= "${var['pre']}_{$tipo}_eja=?,";
      $string .= "${var['pre']}_{$tipo}_medio=?,";

      $string = substr($string, 0, -1);


     $sql= "UPDATE ".TABLE_PREFIX."_${var['path']} SET $string";
     $sql.=" WHERE ${var['pre']}_id=?";

     if($qry=$conn->prepare($sql)) {

       $qry->bind_param('iiiiiii', $res[$tipo.'_creche'], $res[$tipo.'_preescolar'], $res[$tipo.'_fundamental'], $res[$tipo.'_especial'], $res[$tipo.'_eja'], $res[$tipo.'_medio'], $res['item']);
       $qry->execute();
       $qry->close();

     }

     $sql = null;

    }

     $sql= "UPDATE ".TABLE_PREFIX."_${var['path']} SET ${var['pre']}_ano=?";
     $sql.=" WHERE ${var['pre']}_id=?";

     if($qry=$conn->prepare($sql)) {

      $qry->bind_param('ii', $res['ano'], $res['item']);
      $qry->execute();
      $qry->close();

       echo $msgSucesso;


     } else echo $conn->error;

 }
