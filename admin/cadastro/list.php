<?php
/*
 *busca total de itens e faz variaveis de paginação
 */
$sql_tot = "SELECT NULL FROM ${var['table']}";
$qry_tot = $conn->query($sql_tot);

$total_itens = $qry_tot->num_rows;
$limit_end   = 30;
$n_paginas   = ceil($total_itens/$limit_end);
$pg_atual    = isset($_GET['pg']) && !empty($_GET['pg'])?$_GET['pg']:1;
$limit_start = ceil(($pg_atual-1)*$limit_end);

$qry_tot->close();


  /*
   *label para mostrar n de registros
   */
  if($total_itens===0) $total = 'Nenhum cadastro';
   elseif($total_itens===1) $total = "<span id='num_total'>1</span> cadastro";
  else $total = "<span id='num_total'>".$total_itens.'</span> cadastros';




/*
 *query para o order by
 */
$orderby = !isset($_GET['orderby'])?'cad_nome ASC':urldecode($_GET['orderby']);


/*
 *consulta
 */
$sql = "SELECT
		cad_id,
		cad_nome,
		cad_email,
		(SELECT cid_municipio FROM ".TABLE_PREFIX."_cidade_uf WHERE cid_codigo=cad_cidade),
		cad_estado,
		cad_status,
		DATE_FORMAT(cad_timestamp,'%d/%m/%Y') cadastro

	
	FROM ${var['table']} 
        ORDER BY $orderby
        LIMIT $limit_start,$limit_end
	";

 //se a query nao estiver bem feita mostra erro
 if (!$qry = $conn->prepare($sql)) {
  echo 'Houve algum erro durante a execução da consulta<p class="code">'.$sql.'</p><hr>'.$conn->error;

  //senao continua
  } else {

    $qry->execute();
    $qry->bind_result($id, $nome, $email, $cidade, $estado, $status, $cadastro);



?>
<h1><?=$var['mono_plural']?></h1>
<p class='header'></p>

<div class='small' align='right'><?=$total?></div>


  <?php

    //caso haja algum cadastro
    if($total_itens>0) {
  ?>

  <select name='actions' class='min'>
    <option value=''>Ações</option>
    <option value='delete'>Remover</option>
    <option value='ativar'>Ativar</option>
    <option value='banir'>Banir</option>
  </select>

<span class='small' style='margin-left:20px;'>Ordernar por:
  <select name='orderby' id='orderby' class='min'>
  <option value='<?=$var['pre'].'_timestamp'?> ASC'<?php if($orderby==$var['pre'].'_timestamp ASC') echo ' selected';?>>Data crescente</option>
    <option value='<?=$var['pre'].'_timestamp'?> DESC'<?php if($orderby==$var['pre'].'_timestamp DESC') echo ' selected';?>>Data decrescente</option>
    <option value='<?=$var['pre'].'_nome'?> ASC'<?php if($orderby==$var['pre'].'_nome ASC') echo ' selected';?>>Nome crescente</option>
    <option value='<?=$var['pre'].'_nome'?> DESC'<?php if($orderby==$var['pre'].'_nome DESC') echo ' selected';?>>Nome decrescente</option>
  </select>
</span>

<table class="list">
   <thead> 
      <tr>
        <th width="5px"><input type='checkbox' name='check-all' value='1'></th>
        <th>Nome</th>
        <th>E-mail</th>
        <th width="90px">Cadastro</th>
        <th width="80px">Status</th>
      </tr>
   </thead>
   <tbody>
<?php

    // Para cada resultado encontrado...
    while ($qry->fetch()) {




$row_actions = <<<end
<a href='?p=$p&delete&noVisual' title="Clique para remover o ítem selecionado" class='tip trash' style="cursor:pointer;" id="${id}" name='$nome'>Remover</a> | <a href="?p=$p&update&item=$id" title='Clique para editar o ítem selecionado' class='tip edit'>Visualizar</a>
end;

/*
 *alterar status do usuario
 */
$row_actions .= <<<end
 | <a href="?p=${p}&status&noVisual" title="Clique para alterar o status do ítem selecionado" class="tip status status${id}" style="cursor:pointer;" id="${id}" name="${nome}">
end;

   if ($status<>2) $row_actions .= '<font class="red">Banir</font>'; 
     else $row_actions .= '<font class="green">Re-ativar</font>';

$row_actions .= '</a>';



  /*
   *flag de status do usuário
   */
  if ($status==1) $status = '<font class="green">Ativo</font>';
    elseif ($status==0) $status = '<font color="#999999">Pendente</font>';
  else $status = '<font color="red">Banido</font>'; 

?>
      <tr id="tr<?=$id?>">
        <td><input type='checkbox' name='item[]' class='check' value='<?=$id?>'></td>
        <td><?=$nome?><br><i><?=!empty($cidade) ? $cidade.'/'.$estado : ''?></i><div class='row-actions'><?=$row_actions?></div></td>
        <td><?=$email?></td>
        <td><?=$cadastro?></td>
        <td id='status<?=$id?>'><?=$status?></td>
      </tr>


<?php
    }

    $qry->close();
?>
    </tbody>
    </table>


     <?php
        /*
         *paginação
         */
        if($n_paginas>1) {

            #$nav_cat       = isset($catid)?'&cat='.$catid:'';
           $queryString = ereg_replace("(\?|&)?(pg=[0-9]{1,})",'',$_SERVER['QUERY_STRING']);
           $nav_cat='&'.$queryString;

	      $nav_nextclass = $pg_atual==$n_paginas?'unstyle ':'';
	      $nav_nexturl   = $pg_atual==$n_paginas?'javascript:void(0)':'?pg='.($pg_atual+1).$nav_cat;

              echo "<div class='spacer' style='height:30px;'></div>";
	      echo "<span style='float:left'>";
	      echo "  <a href='${nav_nexturl}' class='${nav_nextclass}navbar more'>Mais ítens</a>";
	      echo "</span>";


	      echo "<span style='float:right'>";

	      $nav_prevclass = $pg_atual==1?'unstyle ':'';
	      $nav_prevurl   = $pg_atual==1?'javascript:void(0)':'?pg=1'.$nav_cat;
	
	      echo "<a href='${nav_prevurl}' class='${nav_prevclass}navbar prev'>Anterior</a>";
	

	    for($p=1;$p<=$n_paginas;$p++) {

	      $nav_class = $pg_atual<>$p?'':'unstyle ';
	      $nav_url   = $pg_atual==$p?'javascript:void(0)':'?pg='.$p.$nav_cat;
	  ?>
	  <a href='<?=$nav_url?>' class='<?=$nav_class?> navbar'><?=$p?></a>
	  <?php

	    }

	    echo "<a href='${nav_nexturl}' class='${nav_nextclass}navbar next'>Próximo</a>";
	    echo "</span>";
	  ?>
	</div>

     <?php


       } #fecha if paginacao



    } #fecha if total_itens




  } #fecha if query
?>
