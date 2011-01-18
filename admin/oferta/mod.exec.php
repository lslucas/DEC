<?php

  foreach($_POST as $chave=>$valor) {
   $res[$chave] = $valor;
  }


 /*
  *converte data do portugues para o ingles
  */
 $res['data_cadastro'] = isset($res['data_cadastro']) && !empty($res['data_cadastro']) 
                         ?datept2en('/',$res['data_inicio'])
                         :date('Y-m-d');

 $res['data_exibicao'] = datept2en('/',$res['data_exibicao']);




# include de mensagens do arquivo atual
 include_once 'inc.exec.msg.php';


 ## verifica se existe um titulo/nome/email com o mesmo nome do que esta sendo inserido
 $sql_valida = "SELECT ${var['pre']}_titulo FROM ".TABLE_PREFIX."_${var['path']} WHERE ${var['pre']}_titulo=? AND ${var['pre']}_data_exibicao=?";
 $qry_valida = $conn->prepare($sql_valida);
 $qry_valida->bind_param('ss', $res['titulo'], $res['data_exibicao']);
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


     $res['valor_normal'] = monetary($res['valor_normal'], 1);
     $sql= "UPDATE ".TABLE_PREFIX."_${var['path']} SET

                ${var['pre']}_titulo=?,
                ${var['pre']}_valor_normal=?,
                ${var['pre']}_data_exibicao=?,
                ${var['pre']}_desconto=?,
                ${var['pre']}_estado=?,
                ${var['pre']}_cidade=?,
                ${var['pre']}_cep=?,
                ${var['pre']}_destaque=?,
                ${var['pre']}_descricao=?,
                ${var['pre']}_regulamento=?,
                ${var['pre']}_infocontato=?,
                ${var['pre']}_endereco=?,
                ${var['pre']}_minimo_venda=?,
                ${var['pre']}_status=?
      	";
     $sql.=" WHERE ${var['pre']}_id=?";



     if($qry=$conn->prepare($sql)) {

       $qry->bind_param('sssssissssssiii', $res['titulo'], $res['valor_normal'], $res['data_exibicao'], $res['desconto'], $res['estado'], $res['cidade'], $res['cep'], txt_bbcode($res['destaque']), txt_bbcode($res['descricao']), txt_bbcode($res['regulamento']), txt_bbcode($res['infocontato']), txt_bbcode($res['endereco']), $res['minimo_venda'], $res['status'], $res['item']);
       $qry->execute();
       $qry->close();



       //atualiza data de exibição e cadastro caso seja um insert
       if($act=='insert') {

           $sql_date= "UPDATE ".TABLE_PREFIX."_${var['path']} SET
                    ${var['pre']}_data_cadastro=?";
           $sql_date.=" WHERE ${var['pre']}_id=?";
           if($qry_date = $conn->prepare($sql_date)) {

             $qry_date->bind_param('si', $res['data_cadastro'], $res['item']);
             $qry_date->execute();
             $qry_date->close();

           } else echo $conn->error;


      }




       echo $msgSucesso;


       //cadastro de imagem
       include_once 'mod.exec.imagem.php';


    } else echo $conn->error;



  }
