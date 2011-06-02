<?php


/*
 *query das escolas
 */
$sql = "SELECT  ${var['pre']}_id,
		${var['pre']}_ano,
		(${var['pre']}_estadual_creche+${var['pre']}_estadual_preescolar+${var['pre']}_estadual_fundamental+${var['pre']}_estadual_especial+${var['pre']}_estadual_eja+${var['pre']}_estadual_medio) soma_estadual,
		(${var['pre']}_municipal_creche+${var['pre']}_municipal_preescolar+${var['pre']}_municipal_fundamental+${var['pre']}_municipal_especial+${var['pre']}_municipal_eja+${var['pre']}_municipal_medio) soma_municipal,
		(${var['pre']}_particular_creche+${var['pre']}_particular_preescolar+${var['pre']}_particular_fundamental+${var['pre']}_particular_especial+${var['pre']}_particular_eja+${var['pre']}_particular_medio) soma_particular,
		${var['pre']}_status
		
		FROM ".TABLE_PREFIX."_${var['path']}
		ORDER BY ${var['pre']}_ano DESC";

 if (!$qry = $conn->prepare($sql)) {
  echo 'Houve algum erro durante a execução da consulta<p class="code">'.$sql.'</p><hr>';
  echo $conn->error;

  } else {

    $qry->execute();
    $qry->bind_result($id, $ano, $soma_estadual, $soma_municipal, $soma_particular, $status);

?>
<h1><?=$var['mono_plural']?></h1>
<p class='header'></p>


<table class="list">
   <thead> 
      <tr>
        <th width="25px"></th>
        <th width="150px">Ano</th>
        <th>Total Alunos Rede Estadual</th>
        <th>Total Alunos Rede Municipal</th>
        <th>Total Alunos Rede Particular</th>
      </tr>
   </thead>
   <tbody>
<?php
    $j=0;
    // Para cada resultado encontrado...
    while ($qry->fetch()) {


$row_actions = <<<end
<a href='?p=$p&delete&item=$id&noVisual' title="Clique para remover o ítem selecionado" class='tip trash' style="cursor:pointer;" id="${id}" name='$nome'>Remover</a> | <a href="?p=$p&update&item=$id" title='Clique para editar o ítem selecionado' class='tip edit'>Editar</a>
end;

$row_actions .= <<<end
 | <a href="?p=${p}&status&item=${id}&noVisual" title="Clique para alterar o status do ítem selecionado" class="tip status status${id}" style="cursor:pointer;" id="${id}" name="${nome}">
end;

   if ($status==1)
     $row_actions .= '<font color="#000000">Ativo</font>';

     else $row_actions .= '<font color="#999999">Pendente</font>';

$row_actions .= '</a>';


?>
      <tr id="tr<?=$id?>">
        <td>
      	</td>
        <td><?=$ano?><div class='row-actions'><?=$row_actions?></div></td>
        <td><?=$soma_estadual?></td>
        <td><?=$soma_municipal?></td>
        <td><?=$soma_particular?></td>
      </tr>



<?php
     $j++;
    }

    $qry->close();
?>
    </tbody>
    </table>
<?php

    }
?>
