  <div class='error container-error'><div class='error-icon'>
	Antes de prosseguir preencha corretamente o formulário e revise os campos abaixo:</div>
	<ol> 
		<li><label for="titulo" class="error-validate">Coloque o título</label></li> 
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
	  <label>Imagem </label>
	      <?php

	       if($act=='update' && !empty($val['imagem'])) { 

	      ?>

	   [<a href='?p=<?=$p?>&delete_galeria&item=<?=$_GET['item']?>&prefix=destaque&pre=dest&col=imagem&folder=<?=$var['imagem_folderlist']?>&noVisual' title="Clique para remover o ítem selecionado" class='tip trash-galeria' style="cursor:pointer;" id="<?=$_GET['item']?>">remover</a>]

	   <a href='$imagThumb<?=$i?>?width=100%' id='imag<?=$i?>' class='betterTip'>
		     <img src='images/lupa.gif' border='0' style='background-color:none;padding-left:10px;cursor:pointer'></a>


		    <div id='imagThumb<?=$i?>' style='float:left;display:none;'>
		    <?php 
		    
		       $img = $val['imagem'];
		       if (file_exists(substr($var['path_thumb'],0)."/".$img))
			echo "<img src='".substr($var['path_thumb'],0)."/".$img."'>";

			  else echo "<center>imagem não existe.</center>";
		     ?>
		    </div>

	      <?php

	       } else {

	      ?>

		 <div class='divImagem'>
		   <input type='file' name='imagem' id='imagem' style="height:18px;font-size:7pt;margin-bottom:8px;">
       <br><span class='small'>- JPEG, PNG. Máximo <?=ini_get('post_max_size')?></span>
		 </div>

	      <?php

	       }

	      ?>


		 </p>
        </li>


	<li>	
	  <label>Vídeo ou SWF</label>
	      <?php
	       if($act=='update' && !empty($val['video'])) { 

	      ?>

	   [<a href='?p=<?=$p?>&delete_video&item=<?=$_GET['item']?>&prefix=destaque&pre=dest&col=video&folder=<?=$var['path_video']?>&noVisual' title="Clique para remover o ítem selecionado" class='tip trash-galeria' style="cursor:pointer;" id="<?=$_GET['item']?>">remover</a>]

		    <?php 
		    
		       $vid = substr($var['path_video'],0).'/'.$val['video'];
		     ?>

	   <a href='<?=$vid?>' target='_blank'>
	     <img src='images/lupa.gif' border='0' style='background-color:none;padding-left:10px;cursor:pointer'></a>
       <br><span class='small'>- Path: <?php echo substr($var['path_video'],3); ?></span>


	      <?php

	       } else {

	      ?>

		   <input type='file' name='video' id='video' style="height:18px;font-size:7pt;margin-bottom:8px;">
		   <br><span class='small'>- FLV ou SWF. Máximo <?=ini_get('post_max_size')?></span>
		   <br><span class='small'>- Path: <?php echo substr($var['path_video'],3); ?></span>

	      <?php

	       }

	      ?>


		 </p>
        </li>



	<li>	
	  <label>Título *<span class='small'>Digite o título</span></label>
	  <input type='text' name='titulo' id='titulo' class='required' value='<?=$val['titulo']?>'>
	</li>


	<li>
	  <label>Data *<span class='small'>Entre com uma data para ordenação dos destaques.</span></label>
	  <input type='text' id='data' name='data' class='required  highlight-days-67 range-low-<?=date('Y-m-d',strtotime('-2 year'))?> range-high-<?=date('Y-m-d',strtotime('+5 month'))?> split-date' size='10' value='<?=dateen2pt('-',$val['data'],'/')?>'>
	</li>


	<li>	
	  <label>Link <span class='small'>Informe o link do destaque</span></label>
	  <input type='text' name='link' id='link' value='<?=$val['link']?>'>
	</li>


	<li>	
	  <label>Texto <span class='small'>Descrição do destaque</span></label>
	  <input type='text' name='texto' id='texto' value='<?=$val['texto']?>'>
	</li>

 </ol>





    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>
