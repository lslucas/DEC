  <div class='error container-error'><div class='error-icon'>
	Antes de prosseguir preencha corretamente o formulário e revise os campos abaixo:</div>
	<ol>
		<li><label for="imagem" class="error-validate">Envie alguma imagem</label></li>
		<li><label for="titulo" class="error-validate">Informe o título</label></li>
		<li><label for="telefone" class="error-validate">Informe o telefone</label></li>
		<li><label for="email" class="error-validate">Entre com um email válido</label></li>
		<li><label for="url" class="error-validate">Entre com uma url válida</label></li>
		<li><label for="responsavel" class="error-validate">Entre com um nome de responsável</label></li>
		<li><label for="endereco" class="error-validate">Informe  o endereço da escola</label></li>
		<li><label for="texto" class="error-validate">Necessário informar algum texto</label></li>
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
	  <label>Área *<span class='small'>Áreas de ensino</span></label>
	  <?php


		if($act=='insert') 
		  $sql_categoria = "SELECT cat_id,
								   cat_titulo
			  						FROM ".TABLE_PREFIX."_categoria 
        						WHERE cat_status=1 AND cat_area='escola'";

		  else
			$sql_categoria = "SELECT cat_id, cat_titulo,
                        (SELECT COUNT(rec_id) FROM ".TABLE_PREFIX."_r_esc_categoria 
                        WHERE rec_cat_id=cat_id AND rec_esc_id='".$val['id']."') checked
									  FROM ".TABLE_PREFIX."_categoria 
						        WHERE cat_status=1 AND cat_area='escola'";

      if(!$qry_categoria = $conn->prepare($sql_categoria)) {
        echo $conn->error;

      } else {

          $qry_categoria->execute();

           if($act=='insert') $qry_categoria->bind_result($id, $nome);
           else $qry_categoria->bind_result($id, $nome, $checked);




            $i=0;
            while ($qry_categoria->fetch()) {

             if ($act=='update') {
              $check[$id] = ($checked>0)?' checked':''; 

              } else $check[$id] = '';


        ?>
        <input type='checkbox' class='required' name='cat_id[]' id='cat_id' value='<?=$id?>'<?=$check[$id]?>> <?=$nome?><br/>
        <?php

          $i++;
          }
         $qry_categoria->close();
      }
	  ?>
	
	</li>



	<li>	
	  <label>Imagem<!--<span class='small'><a href='javascript:void(0);' class='addImagem' id='min'>adicionar + imagens</a></span>--></label>
	  <?php
		  
	    if ($act=='update') {
				  
		    $sql_gal = "SELECT rei_id,rei_imagem,rei_pos FROM ".TABLE_PREFIX."_r_${var['pre']}_imagem WHERE rei_${var['pre']}_id=? AND rei_imagem IS NOT NULL ORDER BY rei_pos ASC;"; 
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
		    [<a href='?p=<?=$p?>&delete_imagem&item=<?=$r_id?>&prefix=r_<?=$var['pre']?>_imagem&pre=rei&col=imagem&folder=<?=$var['imagem_folderlist']?>&noVisual' title="Clique para remover o ítem selecionado" class='tip trash-imagem' style="cursor:pointer;" id="<?=$r_id?>">remover</a>]
		  </td>

		  <td>

		    <a href='$imagThumb<?=$i?>?width=100%' id='imag<?=$i?>' class='betterTip'>
		     <img src='images/lupa.gif' border='0' style='background-color:none;padding-left:10px;cursor:pointer'></a>

			 <div id='imagThumb<?=$i?>' style='float:left;display:none;'>
			 <?php 
			
			    if (file_exists(substr($var['path_thumb'],0)."/".$r_imagem))
			     echo "<img src='".substr($var['path_thumb'],0)."/".$r_imagem."'>";

			       else echo "<center>imagem não existe.</center>";
			  ?>
			 </div>

		  </td>
		</tr>

	      <?php
		      $i++;	

          }
         echo '</table><br>';

           }
	      ?>


		 <div class='divImagem'>
		   <input class="imagem" type='file' name='imagem0' id='imagem' alt='0' style="height:18px;font-size:7pt;margin-bottom:8px;">
		   <br><span class='small'>- JPEG, PNG ou GIF;<?=$var['imagemWidth_texto'].$var['imagemHeight_texto']?></span>
		 </div>
		 </p>
        </li>


	<li>	
	  <label>Título *<span class='small'>Digite o título</span></label>
	  <input type='text' name='titulo' id='titulo' class='required' value='<?=$val['titulo']?>'>
	</li>


	<li>	
	  <label>Responsável *<span class='small'>Responsável pela escola</span></label>
	  <input type='text' name='responsavel' id='responsavel' class='required' value='<?=$val['responsavel']?>'>
	</li>


	<li>	
	  <label>Email<span class='small'>Email da escola</span></label>
	  <input type='text' name='email' id='email' class='email' value='<?=$val['email']?>'>
	</li>


	<li>	
	  <label>Site<span class='small'>Site da escola</span></label>
	  <input type='text' name='url' id='url' class='url' value='<?=$val['url']?>'>
	</li>


	<li>
	  <label>Telefones *<span class='small'>Entre com os telefones</span></label>
	  <textarea name='telefone' id='telefone' class='required' cols='80' rows='3'><?=$val['telefone']?></textarea>
	</li>


	<li>
	  <label>Endereço *<span class='small'>Entre com o endereço</span></label>
	  <textarea name='endereco' id='endereco' class='required' cols='80' rows='3'><?=$val['endereco']?></textarea>
	</li>


	<li>
	  <label>Texto *<span class='small'>Digite um texto</span></label>
	  <textarea name='texto' id='texto' class='required tinymce' cols='80' rows='15'><?=$val['texto']?></textarea>
	</li>


 </ol>



    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>
