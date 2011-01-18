  <div class='error container-error'><div class='error-icon'>Antes de prosseguir preencha corretamente o formulário e revise os campos abaixo:</div>
	<ol> 
		<li><label for="nome" class="error-validate">Informe o nome</label></li> 
		<li><label for="email" class="error-validate">Entre com um e-mail válido</label></li> 
		<li><label for="mod_id" class="error-validate">Selecione ao menos um módulo</label></li> 
	</ol> 
  </div>



<form method='post' action='?<?=$_SERVER['QUERY_STRING']?>' class='form cmxform'>
 <input type='hidden' name='act' value='insert'>
 <!-- adiciona modulos -->
 <!--<input type='hidden' name='mod_id[]' value='16'> já mostra na home --><!-- noticias-->
 <input type='hidden' name='mod_id[]' value='21'><!-- noticias-->
 <input type='hidden' name='mod_id[]' value='20'><!-- documentos-->
 <input type='hidden' name='mod_id[]' value='18'><!-- tickets-->
 <!--// fim:adiciona modulos -->


<?php
  if ($act=='update')
    echo "<input type='hidden' name='item' value='${_GET['item']}'>";
?>

<h1>
<?php 
  if ($act=='insert') echo $var['insert'];
   else echo $var['update'];
?>
</h1>
<p class='header'>Todos os campos com <b>- * -</b> são obrigatórios.</p>

<?php
 if ($act=='update' &&  $_GET['item']==$_SESSION['user']['id']) {
?>

  <div class='notice'><div class='notice-icon'>Para alterar sua senha <a href='<?=$rp?>?p=<?=$p?>&alterasenha'>clique aqui</a>.</div></div>

<?php } ?>


    <ol>
	<li>	
	  <label>Nome *<span class='small'>Digite o nome</span></label>
	  <input type='text' placeholder='Preencha o nome' name='nome' id='nome' class='required' value='<?=$val['nome']?>'>
	</li>

	<li>
	  <label>E-mail *<span class='small'>Digite um e-mail válido</span></label>
	  <input type='text' placeholder='Entre com um e-mail válido' name='email' id='email' class='email required' value='<?=$val['email']?>'>
	</li>


	<?php
	  #só mostra se for um administrador
	  if(empty($_SESSION['user']['tipo'])) {
	?>
	<li>	
	  <label>Categoria *<span class='small'>Categoria do usuário</span></label>
	  <?php
	    $statusCat=1;


		if($act=='insert') 
		  $sql_categoria = "SELECT cat_id, 
					   cat_titulo
								   
						FROM ".TABLE_PREFIX."_categoria 
						WHERE cat_status=? ";

		  else
			$sql_categoria = "SELECT cat_id, 
						 cat_titulo,
						 (SELECT COUNT(rac_id) FROM ".TABLE_PREFIX."_r_adm_categoria WHERE rac_cat_id=cat_id AND rac_adm_id='".$val['id']."') checked
									 
						  FROM ".TABLE_PREFIX."_categoria 
						  WHERE cat_status=? ";

	    $qry_categoria = $conn->prepare($sql_categoria);
	    $qry_categoria->bind_param('i', $statusCat);
	    $qry_categoria->execute();

		 if($act=='insert')
	           $qry_categoria->bind_result($id, $nome);
		   else $qry_categoria->bind_result($id, $nome, $checked);



	      $i=0;
	      while ($qry_categoria->fetch()) {

	       if ($act=='update') {
	        $check[$id] = ($checked>0)?' checked':''; 

	        } else $check[$id] = '';


	       if ($i<>0) echo '<br>';
	  ?>

	        <input type='checkbox' class='required' name='cat_id[]' id='cat_id' value='<?=$id?>'<?=$check[$id]?>> <?=$nome?> 

	  <?php 

	    $i++;
	    } 
	   $qry_categoria->close();
	  ?>
	   
	</li>
	<?php

	  }

	?>



    </ol>


        <div class='spacer'></div>

	<?php
	 if ($act=='insert') {
	?>

	<div class='notice'><span class='notice-icon'><b>Atenção:</b> A senha será gerada automaticamente e enviada para o e-mail do novo usuário.</span></div>

	<?php 
	 }
	?>


    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>


