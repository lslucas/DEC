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
  if($total_itens===0) $total = 'Nenhum '.strtolower($var['mono_singular']);
   elseif($total_itens===1) $total = "<span id='num_total'>1</span> ".strtolower($var['mono_singular']);
  else $total = "<span id='num_total'>".$total_itens.'</span> '.strtolower($var['mono_plural']);




/*
 *query para o order by
 */
$orderby = !isset($_GET['orderby'])?"${var['pre']}_data_exibicao DESC":urldecode($_GET['orderby']);





$sql = "SELECT  ${var['pre']}_id,
		${var['pre']}_titulo,
		${var['pre']}_loc_id,
		${var['pre']}_valor_normal,
		${var['pre']}_desconto,
		${var['pre']}_status,
		${var['pre']}_data_exibicao data_exibicao_en,
		DATE_FORMAT(${var['pre']}_data_exibicao,'%d/%m/%y') data_exibicao
		
		FROM ${var['table']}
    ORDER BY $orderby
    LIMIT $limit_start,$limit_end
    ";


 if (!$qry = $conn->prepare($sql)) {
  echo 'Houve algum erro durante a execução da consulta<p class="code">'.$sql.'</p><hr>';
  echo $conn->error;

  } else {

    $qry->execute();
    $qry->store_result();
    $num = $qry->num_rows;
    $qry->bind_result($id, $titulo, $empresa, $valor_normal, $desconto, $status, $data_exibicao_en, $data_exibicao);




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
    <option value='banir'>Desativar</option>
  </select>

<span class='small' style='margin-left:20px;'>Ordernar por:
  <select name='orderby' id='orderby' class='min'>
    <option value='<?=$var['pre'].'_data_cadastro'?> ASC'<?=$orderby==$var['pre'].'_data_cadastro ASC'?' selected':''?>>Data de cadastro, crescente</option>
    <option value='<?=$var['pre'].'_data_cadastro'?> DESC'<?=$orderby==$var['pre'].'_data_cadastro DESC'?' selected':''?>>Data de cadastro, decrescente</option>
    <option value='<?=$var['pre'].'_data_exibicao'?> ASC'<?=$orderby==$var['pre'].'_data_exibicao ASC'?' selected':''?>>Data de exibição, crescente</option>
    <option value='<?=$var['pre'].'_data_exibicao'?> DESC'<?=$orderby==$var['pre'].'_data_exibicao DESC'?' selected':''?>>Data de exibição, decrescente</option>
    <option value='<?=$var['pre'].'_desconto'?> ASC'<?php if($orderby==$var['pre'].'_desconto ASC') echo ' selected';?>>Desconto, crescente</option>
    <option value='<?=$var['pre'].'_desconto'?> DESC'<?php if($orderby==$var['pre'].'_desconto DESC') echo ' selected';?>>Desconto, decrescente</option>
  </select>
</span>



<table class="list">
   <thead> 
      <tr>
        <th width="5px"><input type='checkbox' name='check-all' value='1'></th>
        <th width="70px">Exibição</th>
        <th>Oferta</th>
      </tr>
   </thead>
   <tbody>
<?php

    $j=0;
    // Para cada resultado encontrado...
    while ($qry->fetch()) {
$row_actions = <<<end
<a href='?p=$p&delete&item=$id&noVisual' title="Clique para remover o ítem selecionado" class='tip trash' style="cursor:pointer;" id="${id}" name='$titulo'>Remover</a> | <a href="?p=$p&update&item=$id" title='Clique para editar o ítem selecionado' class='tip edit'>Editar</a>
end;

$row_actions .= <<<end
 | <a href="?p=${p}&status&item=${id}&noVisual" title="Clique para alterar o status do ítem selecionado" class="tip status status${id}" style="cursor:pointer;" id="${id}" name="${titulo}">
end;

   if ($status==1)
     $row_actions .= '<font class="green">Ativo</font>'; 

     else $row_actions .= '<font color="#999999">Pendente</font>';


$row_actions .= '</a>';



$permissoes='';
?>
      <tr id="tr<?=$id?>">
        <td><input type='checkbox' name='item[]' class='check' value='<?=$id?>'></td>
        <td><?=$data_exibicao?></td>
        <td>
        	<?=$titulo?>
          <br/><i class='min'>Desconto de <?=$desconto?>%
          <br/>De R$ <?=monetary($valor_normal)?> para <b><?='R$ '.monetary_off($valor_normal,$desconto)?></b></i>
        	<div class='row-actions'><?=$row_actions?></div></td>

      </tr>



<?php
     $j++;


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
