<?php

   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';


   foreach($_POST as $key=>$value) {
     $res[$key] = trim($value);
   }

   if(empty($res['news-nome']) || empty($res['news-email']))
     die("\n<div class='error'>Preencha seu nome e email!</div>\n");

    /*
     *query das busca se email já existe
     */
    $sql_eml = "SELECT NULL FROM ".TABLE_PREFIX."_email WHERE eml_email=?";
    if(!$qry_eml= $conn->prepare($sql_eml)) {
      echo $conn->error;

    } else {

        $qry_eml->bind_param('s', $res['news-email']);
        $qry_eml->execute();
        $qry_eml->store_result();
        $num = $qry_eml->num_rows;
        $qry_eml->close();


        /*
         *msg que email já existe
         */
       if($num>0)
         echo "\n<div class='alert'>E-mail <b>".$res['news-email']."</b> já existe!</div>\n";


       else {


         /*
          *insere email na base
          */
          $sql= "INSERT INTO ".TABLE_PREFIX."_email (eml_nome, eml_email) VALUES (?, ?)";
          if(!$qry= $conn->prepare($sql)) {
            echo $conn->error;

          } else {

              $qry->bind_param('ss', $res['news-nome'], $res['news-email']);
              $qry->execute();
              $qry->close();

              /*
               *msg que email foi cadastrado
               */
              echo "\n<div class='success'>E-mail cadastrado!</div>\n";
          }



       }

   }
