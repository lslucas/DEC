<?php

   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';



    /*
     *query das escícias
     */
    $sql_esc = "SELECT esc_id, esc_titulo, esc_email, esc_responsavel, esc_telefone, esc_endereco, esc_url
                  FROM ".TABLE_PREFIX."_escola

                      WHERE esc_titulo IS NOT NULL
                            AND esc_status=1

                            ORDER BY esc_titulo ASC";

    if(!$qry_esc= $conn->prepare($sql_esc)) {
      echo $conn->error;

    } else {

      $qry_esc->execute();
      $qry_esc->bind_result($id, $titulo, $email, $responsavel, $telefone, $endereco, $url);



      include_once '_inc.header.php';


?>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.min.js"></script>
<script>
 $(function() {


       $('#telefone').mask('(99) 9999-9999');
       /*
        *ação ao submeter form de cadastro na newsletter
        */
       $("#submit-contato").click(function(e) {
         e.preventDefault();
          $('#msg').html('<b>Espere...</b>');

          $.ajax({
            type: "POST",
            url: $("form[name='contato']").attr('action'),
            data: $("form[name='contato']").serialize(),
            success: function(da){
              $('#msg').html(da);
            }
          });

       });


 });

</script>
<h1>CONTATO</h1></td>
          </tr>
          <tr>
            <td><h4>Entre em contato com a gente e tire suas dúvidas e ajude a melhorar a educação em nosso município</h4></td>
          </tr>
          <tr>
            <td><table style="background:url(images/banner.png) no-repeat" width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="184" align="center" valign="middle"><img src="images/banner_contato.png" width="691" height="174" /></td>
              </tr>
              <tr>
                <td height="28" style="height:28;" align="right" valign="middle" ><h5>Censo Escolares</h5></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="205" valign="top"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h2>PREENCHA O FORMULÁRIO E AGUARDE NOSSO CONTATO</h2></td>
          </tr>
          <tr>
            <td><table width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="519" height="186">

              <p align=left>Campos marcados com - <b>*</b> - são obrigatórios
              <hr noshade size=1 width=500px/></p>
              <form name='contato' method='post' action='contato-post.php'>

                <div id='msg'></div>
                <table border=0>
                  <tr>
                    <td width=70><label for='escola'>* Escola</label></td>
                    <td>
                        <select name='escola' id='escola' style='max-width:480px'>
                          <option>Selecione</option>
                          <option value='geral'>Geral</option>
                          <?php
                            while($qry_esc->fetch()) {

                              echo "\n\t\t<option value=$id>$titulo</option>";

                            }

                            $qry_esc->close();
                          ?>
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for='nome'>* Nome</label></td>
                    <td><input type='text' name='nome' id='nome'/></td>
                 </tr>
                 <tr>
                    <td><label for='email'>* E-mail</label></td>
                    <td><input type='text' name='email' id='email'/></td>
                 </tr>
                 <tr>
                    <td><label for='telefone'>Telefone</label></td>
                    <td><input type='text' name='telefone' id='telefone'/></td>
                 </tr>
                 <tr>
                    <td><label for='assunto'>* Assunto</label></td>
                    <td><input type='text' name='assunto' id='assunto'/></td>
                 </tr>
                 <tr>
                    <td><label for='mensagem'>* Mensagem</label></td>
                    <td><textarea name='mensagem' id='mensagem' cols=38 rows=6/></textarea></td>
                 </tr>
                </table>

                 <p><input type='button' id='submit-contato' value='Enviar'/></p>
              </form>

                </td>
                <td width="181" style="background:url(images/fundocontato.png) no-repeat" valign=top><table width="181" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="55" style="padding-left:17px;padding-right:17px;"><h2><span style="font-size:14px;">TELEFONES ÚTEIS</span></h2></td>
                  </tr>
                  <tr>
                    <td valign="top" style="padding-left:17px;padding-right:17px"><h4><spam id="nav">"Secretária da Educação</spam>  <br />
                      0800 000 00 00
                      <spam id="nav">"Prefeitura</spam><br />
                      (12) 0000-0000<br />
                      <spam id="nav">"DEC</spam>
                      <br />
                      0800 000 00 00                    </h4>                      <h4>&nbsp;</h4></td>
                  </tr>
                  </table></td>
              </tr>
            </table>

<?php
    }

    include_once '_inc.footer.php';

?>
