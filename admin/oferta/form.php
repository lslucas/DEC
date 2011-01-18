  <div class='error container-error'><div class='error-icon'>
	Antes de prosseguir preencha corretamente o formulário e revise os campos abaixo:</div>
	<ol> 
		<li><label for="titulo" class="error-validate">Informe o título da oferta</label></li>
		<li><label for="data_cadastro" class="error-validate">Data do cadastro da oferta</label></li>
		<li><label for="data_exibicao" class="error-validate">Entre com uma data de exibição</label></li>
		<li><label for="valor_normal" class="error-validate">Valor original do produto/serviço</label></li>
		<li><label for="desconto" class="error-validate">Porcentagem de desconto para o produto/serviço</label></li>
		<li><label for="estado" class="error-validate">Estado da oferta</label></li>
		<li><label for="cidade" class="error-validate">Cidade da oferta</label></li>
		<li><label for="cep" class="error-validate">CEP da oferta</label></li>
		<li><label for="destaque" class="error-validate">Texto de destaque</label></li>
		<li><label for="descricao" class="error-validate">Informe a descrição da oferta</label></li>
		<li><label for="regulamento" class="error-validate">Regras ou informações sobre o desconto</label></li>
		<li><label for="infocontato" class="error-validate">Informações de contato</label></li>
		<li><label for="endereco" class="error-validate">Endereço, número e bairro</label></li>
		<li><label for="minimo_venda" class="error-validate">Número mínimo para vendas</label></li>
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
	  <label>Imagem *<span class='small'>Imagem da oferta</span></label>
	  <?php
	    $numImg = 0;	
	    if ($act=='update') {
				  
		    $sql_gal = "SELECT roi_id,roi_imagem,roi_pos FROM ".TABLE_PREFIX."_r_${var['pre']}_imagem WHERE roi_${var['pre']}_id=? AND roi_imagem IS NOT NULL ORDER BY roi_pos ASC;"; 
		    $qr_gal = $conn->prepare($sql_gal);
		    $qr_gal->bind_param('s',$_GET['item']);
		    $qr_gal->execute();
        $qr_gal->store_result();
        $numImg = $qr_gal->num_rows;
		    $qr_gal->bind_result($r_id,$r_imagem,$r_pos);
		    $i=0;

		      echo '<table id="posImagem" cellspacing="0" cellpadding="2">';
		      while ($qr_gal->fetch()) {
	  ?>
		<tr id="<?=$r_id?>">
		  <td width='20px' title='Clique e arraste para mudar a posição da foto' class='tip'></td>

		  <td class='small'>
		    [<a href='?p=<?=$p?>&delete_imagem&item=<?=$r_id?>&prefix=r_<?=$var['pre']?>_imagem&pre=roi&col=imagem&folder=<?=$var['imagem_folderlist']?>&noVisual' title="Clique para remover o ítem selecionado" class='tip trash-imagem' style="cursor:pointer;" id="<?=$r_id?>">remover</a>]
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



       if($numImg==0) {
	   ?>


		 <div class='divImagem'>
		   <input class="imagem required" type='file' name='imagem0' id='imagem' alt='0' style="height:18px;font-size:7pt;margin-bottom:8px;">
		   <br><span class='small'>- JPEG, PNG ou GIF;<?=$var['imagemWidth_texto'].$var['imagemHeight_texto']?></span>
		 </div>
     <?php } ?>

		 </p>

  </li>





	<li>	
	  <label>Título *<span class='small'>Nome da oferta</span></label>
	  <input type='text' name='titulo' id='titulo' class='required' value='<?=$val['titulo']?>'>
	</li>


	<li>
	  <label>Data Exibição *<span class='small'>Entre com a data de exibição no site</span></label>
	  <input type='text' id='data_exibicao' name='data_exibicao' class='required  highlight-days-67 range-low-<?=date('Y-m-d',strtotime('-2 year'))?> range-high-<?=date('Y-m-d',strtotime('+1 year'))?> split-date data' size='10' value='<?=dateen2pt('-',$val['data_exibicao'],'/')?>'>
	</li>



	<li>	
	  <label>Valor Normal *<span class='small'>Preço normal do produto/serviço</span></label>
	  <input type='text' name='valor_normal' id='valor_normal' class='required' value='<?=monetary($val['valor_normal'])?>'>
	</li>


	<li>
	  <label>Desconto *<span class='small'>Informe um número decimal para o desconto</span></label>
	  <input type='text' name='desconto' id='desconto' class='required number' value='<?=$val['desconto']?>' size=2 maxlength=2> %
	</li>


	<li>
	  <label>Estado *<span class='small'>Selecione um estado</span></label>
        <select name="estado" id="estado" class="required">
          <option value="">UF</option>
          <option value="AC"<?=returnVal('estado','AC','select')?>>AC</option>
          <option value="AL"<?=returnVal('estado','AL','select')?>>AL</option>
          <option value="AM"<?=returnVal('estado','AM','select')?>>AM</option>
          <option value="AP"<?=returnVal('estado','AP','select')?>>AP</option>
          <option value="BA"<?=returnVal('estado','BA','select')?>>BA</option>
          <option value="CE"<?=returnVal('estado','CE','select')?>>CE</option>
          <option value="DF"<?=returnVal('estado','DF','select')?>>DF</option>
          <option value="ES"<?=returnVal('estado','ES','select')?>>ES</option>
          <option value="GO"<?=returnVal('estado','GO','select')?>>GO</option>
          <option value="MA"<?=returnVal('estado','MA','select')?>>MA</option>
          <option value="MT"<?=returnVal('estado','MT','select')?>>MT</option>
          <option value="MS"<?=returnVal('estado','MS','select')?>>MS</option>
          <option value="MG"<?=returnVal('estado','MG','select')?>>MG</option>
          <option value="PA"<?=returnVal('estado','PA','select')?>>PA</option>
          <option value="PB"<?=returnVal('estado','PB','select')?>>PB</option>
          <option value="PR"<?=returnVal('estado','PR','select')?>>PR</option>
          <option value="PE"<?=returnVal('estado','PE','select')?>>PE</option>
          <option value="PI"<?=returnVal('estado','PI','select')?>>PI</option>
          <option value="RJ"<?=returnVal('estado','RJ','select')?>>RJ</option>
          <option value="RN"<?=returnVal('estado','RN','select')?>>RN</option>
          <option value="RS"<?=returnVal('estado','RS','select')?>>RS</option>
          <option value="RR"<?=returnVal('estado','RR','select')?>>RR</option>
          <option value="RO"<?=returnVal('estado','RO','select')?>>RO</option>
          <option value="SC"<?=returnVal('estado','SC','select')?>>SC</option>
          <option value="SP"<?=returnVal('estado','SP','select')?>>SP</option>
          <option value="SE"<?=returnVal('estado','SE','select')?>>SE</option>
          <option value="TO"<?=returnVal('estado','TO','select')?>>TO</option>
      </select>
	</li>


	<li>
	  <label>Cidade *<span class='small'>Selecione uma cidade</span></label>
        <select name="cidade" id="cidade" class="required">
         <option>Cidade</option>
         <option>Primeiro selecione um estado</option>
        </select>
  </li>


	<li>
	  <label>CEP *<span class='small'>CEP do estabelecimento da oferta</span></label>
	  <input type='text' name='cep' id='cep' class='required cep' value='<?=$val['cep']?>'>
	</li>


	<li>
	  <label>Descrição *<span class='small'>Descrição da oferta</span></label>
	  <textarea name='descricao' id='descricao' class='tinymce required' cols='80' rows='7'><?=$val['descricao']?></textarea>
	</li>


	<li>
	  <label>Destaque *<span class='small'>Texto rápido sobre informações básicas da oferta</span></label>
	  <textarea name='destaque' id='destaque' class='tinymce required' cols='80' rows='7'><?=$val['destaque']?></textarea>
	</li>


	<li>
	  <label>Regulamento *<span class='small'>Regulamento sobre a oferta</span></label>
	  <textarea name='regulamento' id='regulamento' class='tinymce required' cols='80' rows='7'><?=$val['regulamento']?></textarea>
	</li>


	<li>
	  <label>Informações de contato<span class='small'>Informações de contato, responsável e telefone</span></label>
	  <textarea name='infocontato' id='infocontato' class='tinymce' cols='80' rows='3'><?=$val['infocontato']?></textarea>
	</li>


	<li>
	  <label>Endereço *<span class='small'>Local ou locais para usar o desconto</span></label>
	  <textarea name='endereco' id='endereco' class='tinymce required' cols='80' rows='3'><?=$val['endereco']?></textarea>
	</li>


	<li>	
	  <label>Mínimo para venda *<span class='small'>Número mínimo para venda</span></label>
	  <input type='text' name='minimo_venda' id='minimo_venda' class='required number' value='<?=$val['minimo_venda']?>'>
	</li>



 </ol>



    <br>
    <p align='center'>
    <input type='submit' value='ok' class='first'><input type='button' id='form-back' value='voltar'></p>
    <div class='spacer'></div>


</form>
