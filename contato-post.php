<?php

 $escola = (string) $_POST['escola'];
 $nome = (string) $_POST['nome'];
 $email = (string) $_POST['email'];
 $telefone = (string) $_POST['telefone'];
 $assunto = (string) $_POST['assunto'];
 $mensagem = (string) $_POST['mensagem'];


  if (empty($escola) || empty($mensagem) || empty($nome) || empty($email) || empty($assunto)) {
    echo 'Preencha todos os campos obrigatórios antes de enviar!<br/><br/>';


  } else {

    if($escola<>'geral') {

         /*
          *cabeçalho para funcoes,variaveis e conexao com a base
          */
         $rp = './admin/';
         include_once $rp.'_inc/global.php';
         require_once $rp.'_inc/db.php';
         include_once $rp.'_inc/global_function.php';


        /*
         *query das escolas
         */
        $sql_esc = "SELECT esc_titulo, esc_email, esc_responsavel, esc_telefone, esc_endereco, esc_url
                      FROM ".TABLE_PREFIX."_escola

                          WHERE esc_titulo IS NOT NULL
                                AND esc_status=1
                                AND esc_id=?";

        if(!$qry_esc= $conn->prepare($sql_esc)) {
          echo $conn->error;

        } else {

          $qry_esc->bind_param('i', $escola);
          $qry_esc->execute();
          $qry_esc->bind_result($titulo_escola, $email_escola, $responsavel, $telefone, $endereco, $url);
          $qry_esc->fetch();
          $qry_esc->close();

        }

    }



      $msg= "Dados enviados através do formulário de contato\n\n<p>";

      if($escola<>'geral')
      $msg.= "Escola: {$titulo_escola}\n<br>";
      $msg.= "Nome: {$nome}\n<br>";
      $msg.= "Email: {$email}\n<br>";
      $msg.= "Telefone: {$telefone}\n<br>";
      $msg.= "Mensagem: " . nl2br(stripslashes($mensagem))."\n\n<p>"; 
      $msg.= "IP no momento do envio: " . $_SERVER['REMOTE_ADDR'] . "\n\n<br>";
      $msg.= "</body></html>";


      $headers = "MIME-Version: 1.1\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\n";
      $headers .= "From: {$nome} <{$email}>\n"; // remetente

      if($escola<>'geral')
      $headers .= "Bcc: $titulo_escola <$email_escola>\n"; // copia oculta
      $headers .= "Reply-To: ".$email."\n";
      $headers .= "Return-Path: Secretaria de Educação <lslucas@gmail.com>\n"; // return-path


      $envio = mail("lslucas@gmail.com", $assunto, $msg, $headers);


      if($envio)
        echo 'Formulário enviado com sucesso!<br/><br/>';

      else echo 'Erro na tentativa de envio.<br/><br/>';

 }
