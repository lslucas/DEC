  <div class='error container-error'><div class='error-icon'>
	Antes de prosseguir preencha corretamente o formulário e revise os campos abaixo:</div>
	<ol> 
		<!--<li><label for="imagem" class="error-validate">Envia a imagem da categoria</label></li> -->
		<li><label for="titulo" class="error-validate">Informe o título</label></li> 
		<li><label for="area" class="error-validate">Selecione a área da categoria</label></li>
	</ol> 
  </div>



<form method='post' action='?<?=$_SERVER['QUERY_STRING']?>' id='form_<?=$p?>' class='form cmxform' enctype="multipart/form-data">
 <input type='hidden' name='act' value='<?=$act?>'>
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



    <ol>


	<li>	
	  <label>Título *<span class='small'>Digite o título da categoria</span></label>
	  <input type='text' name='titulo' id='titulo' class='required' value='<?=$val['titulo']?>'>
	</li>



	<li>
	<label>Área *<span class='small'>Área da categoria</span></label>
     <select class='required' name='area' id='area'>
        <option value=''>Selecione</option>
        <option value='escola'<?php if($act=='update' && $val['area']=='escola') echo ' selected';?>>Escolas</option>
     </select>
	</li>


 </ol>



    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>


