  <div class='error container-error'><div class='error-icon'>
	Antes de prosseguir preencha corretamente o formulário e revise os campos abaixo:</div>
	<ol> 
		<li><label for="imagem" class="error-validate">Envie algum arquivo</label></li> 
		<li><label for="titulo" class="error-validate">Informe o título</label></li> 
		<li><label for="data" class="error-validate">Entre com uma data válida</label></li> 
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
	  <label>Arquivos<span class='small'><a href='javascript:void(0);' class='addImagem' id='min'>adicionar + arquivos</a></span></label>
	  <?php
		  
	    if ($act=='update') {
				  
		    $sql_gal = "SELECT raa_id, raa_arquivo, raa_pos FROM ".TABLE_PREFIX."_r_${var['pre']}_arquivo WHERE raa_${var['pre']}_id=? AND raa_arquivo IS NOT NULL ORDER BY raa_pos ASC;"; 
		    $qr_gal = $conn->prepare($sql_gal);
		    $qr_gal->bind_param('s',$_GET['item']);
		    $qr_gal->execute();
		    $qr_gal->bind_result($r_id,$r_imagem,$r_pos);
		    $i=0;

		      echo '<table id="posImagem" cellspacing="0" cellpadding="2">';
		      while ($qr_gal->fetch()) {
	  ?>
		<tr id="<?=$r_id?>">
		  <td width='20px' title='Clique e arraste para mudar a posição da foto' class='tip'></td>

		  <td class='small'>
		    [<a href='?p=<?=$p?>&delete_imagem&item=<?=$r_id?>&prefix=r_<?=$var['pre']?>_arquivo&pre=raa&col=arquivo&folder=<?=$var['arquivo_folderlist']?>&noVisual' title="Clique para remover o ítem selecionado" class='tip trash-imagem' style="cursor:pointer;" id="<?=$r_id?>">remover</a>]
		  </td>

		  <td>
			 <?php
			
			    if (file_exists(substr($var['path_arquivo'],0)."/".$r_imagem))
			     echo "<a href='".substr($var['path_arquivo'],0)."/".$r_imagem."' target='_blank' title='Abrir arquivo em nova janela'>";

			       else echo "<a href='javascript:aler(\"arquivo não existe!\");return false;'>";
			  ?>
		     <img src='images/lupa.gif' border='0' style='background-color:none;padding-left:10px;cursor:pointer'></a>

		  </td>
		</tr>

	      <?php
		      $i++;	

          }
         echo '</table><br>';

           }
	      ?>


		 <div class='divImagem'>
		   <input class="imagem" type='file' name='arquivo0' id='arquivo' alt='0' style="height:18px;font-size:7pt;margin-bottom:8px;">
		   <br><span class='small'>- JPEG, PNG, XLS, DOC, PDF</span>
		 </div>
		 </p>
        </li>


	<li>	
	  <label>Título *<span class='small'>Digite o título</span></label>
	  <input type='text' name='titulo' id='titulo' class='required' value='<?=$val['titulo']?>'>
	</li>


	<li>
	  <label>Data *<span class='small'>Entre com a data</span></label>
	  <input type='text' id='data' name='data' class='data required  highlight-days-67 range-low-<?=date('Y-m-d',strtotime('-2 year'))?> range-high-<?=date('Y-m-d',strtotime('+24 month'))?> split-date' size='10' value='<?=dateen2pt('-',$val['data'],'/')?>'>
	</li>


 </ol>



    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>
