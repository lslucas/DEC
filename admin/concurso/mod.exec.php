<?php

  foreach($_POST as $chave=>$valor) {
   $res[$chave] = $valor;
  }


  $res['data'] = datept2en('/',$res['data']);
  $res['data_prova'] = datept2en('/',$res['data_prova']);
  $res['data_resultado'] = datept2en('/',$res['data_resultado']);
  $res['data_validade'] = datept2en('/',$res['data_validade']);
# include de mensagens do arquivo atual
 include_once 'inc.exec.msg.php';


 ## verifica se existe um titulo/nome/email com o mesmo nome do que esta sendo inserido
 $sql_valida = "SELECT ${var['pre']}_titulo FROM ".TABLE_PREFIX."_${var['path']} WHERE ${var['pre']}_titulo=?";
 $qry_valida = $conn->prepare($sql_valida);
 $qry_valida->bind_param('s', $res['titulo']); 
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

     $sql= "UPDATE ".TABLE_PREFIX."_${var['path']} SET

              ${var['pre']}_titulo=?,
              ${var['pre']}_data=?,
              ${var['pre']}_data_prova=?,
              ${var['pre']}_data_resultado=?,
              ${var['pre']}_data_validade=?,
              ${var['pre']}_texto=?,
              ${var['pre']}_inscricao=?
        	";
     $sql.=" WHERE ${var['pre']}_id=?";

     if($qry=$conn->prepare($sql)) {

      $qry->bind_param('sssssssi', $res['titulo'], $res['data'], $res['data_prova'], $res['data_resultado'], $res['data_validade'], txt_bbcode($res['texto']), txt_bbcode($res['inscricao']), $res['item']);
      $qry->execute();


         $qry->close();
         #insere as fotos/galeria do artigo
         include_once 'mod.exec.arquivo.php';

         echo $msgSucesso;


     } else echo $conn->error;

 }