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
<p>Campos marcados com - <b>*</b> - são obrigatórios</p>
<hr noshade size=1/>
<form name='contato' method='post' action='contato-post.php'>

  <div id='msg'></div>
  <table border=0>
    <tr>
      <td width=70><label for='escola'>* Escola</label></td>
      <td>
          <select name='escola' id='escola'>
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
<?php
    }

    include_once '_inc.footer.php';

?>
