  <div class='error container-error'><div class='error-icon'>
	Antes de prosseguir preencha corretamente todos os campos do formulário:</div>
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
	  <label>Ano *<span class='small'>Digite o ano</span></label>
	  <input type='text' name='ano' id='ano' class='required' value='<?=$val['ano']?>'>
	</li>


  <?php

    $arrTipo = array('estadual', 'municipal', 'particular');
    $arrGuarda = array();
    foreach($arrTipo as $tipo) {

      if(!in_array($tipo, $arrGuarda)) {
        echo "<li><h5>".ucfirst($tipo)."</h5><p class='header'></p></li>";
        array_push($arrGuarda, $tipo);
      }

  ?>
	<li>	
	  <label>Creche *<span class='small'>Num. alunos para creche</span></label>
    <input type='text' name='<?=$tipo?>_creche' id='<?=$tipo?>_creche' class='required number' value='<?=$val[$tipo.'_creche']?>'>
	</li>

	<li>	
	  <label>Pré-escolar *<span class='small'>Num. alunos para pré-escolar</span></label>
    <input type='text' name='<?=$tipo?>_preescolar' id='<?=$tipo?>_preescolar' class='required number' value='<?=$val[$tipo.'_preescolar']?>'>
	</li>

	<li>	
	  <label>Fundamental *<span class='small'>Num. alunos para fundamental</span></label>
    <input type='text' name='<?=$tipo?>_fundamental' id='<?=$tipo?>_fundamental' class='required number' value='<?=$val[$tipo.'_fundamental']?>'>
	</li>

	<li>	
	  <label>Especial *<span class='small'>Num. alunos para especial</span></label>
    <input type='text' name='<?=$tipo?>_especial' id='<?=$tipo?>_especial' class='required number' value='<?=$val[$tipo.'_especial']?>'>
	</li>

	<li>	
	  <label>Eja *<span class='small'>Num. alunos para eja</span></label>
    <input type='text' name='<?=$tipo?>_eja' id='<?=$tipo?>_eja' class='required number' value='<?=$val[$tipo.'_eja']?>'>
	</li>

	<li>	
	  <label>Médio *<span class='small'>Num. alunos para médio</span></label>
    <input type='text' name='<?=$tipo?>_medio' id='<?=$tipo?>_medio' class='required number' value='<?=$val[$tipo.'_medio']?>'>
	</li>

  <?php } ?>



 </ol>



    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>
