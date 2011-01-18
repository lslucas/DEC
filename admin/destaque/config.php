<?php

  /*
   *ao submeter form
   */
  include_once 'mod.exec.config.php';

?>
  <div class='error container-error'><div class='error-icon'>
	Antes de prosseguir preencha corretamente o formulário e revise os campos abaixo:</div>
	<ol> 
          <li><label for="time" class="error-validate">Informe o tempo em segundos, exe: 5</label></li> 
          <li><label for="random" class="error-validate">Randômico?</label></li> 
          <li><label for="showheader" class="error-validate">Mostrar cabeçalho?</label></li> 
	</ol> 
  </div>



<form method='post' action='?<?=$_SERVER['QUERY_STRING']?>' id='form_<?=$p?>' class='form cmxform' enctype="multipart/form-data">
 <input type='hidden' name='config' value='true'>


 <h1>Configurações do <?=$var['mono_singular']?></h1>
<p class='header'>Todos os campos com <b>- * -</b> são obrigatórios.</p>

    <?php

      $val['time'] = isset($res['time'])?$res['time']:$val['time'];
      $val['random'] = isset($res['random'])?$res['random']:$val['random'];
      $val['showheader'] = isset($res['showheader'])?$res['showheader']:$val['showheader'];

    ?>
    <ol>


	<li>	
	  <label>Tempo *<span class='small'>Informe a duração das transições</span></label>
	  <input type='text' name='time' id='time' class='required' value='<?=$val['time']?>'>
	</li>

	<li>	
	  <label>Ordenação *<span class='small'>Como será ordenado os destaques</span></label>
	  <input type='radio' class='required' name='random' id='random' value='false'<?=$val['random']=='false'?' checked':''?>> Por data (decrescente)
          <br/><input type='radio' class='required' name='random' id='random' value='true'<?=$val['random']=='true'?' checked':''?>> Randômico (aleatório)
	</li>


<!--
	<li>	
	  <label>Mostrar cabeçalho *<span class='small'>Exibir cabeçalhos?</span></label>
	  <input type='radio' class='required' name='showheader' id='showheader' value='false'<?=$val['showheader']===false?' checked':''?>> Não exibir
	  <input type='radio' class='required' name='showheader' id='showheader' value='true'<?=$val['showheader']===true?' checked':''?>> Exibir
	</li>
-->


 </ol>





    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>
