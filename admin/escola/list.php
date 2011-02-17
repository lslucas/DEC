<?php


/*
 *query das categorias
 */
 $sql_cat = "SELECT rec_cat_id, rec_esc_id FROM ".TABLE_PREFIX."_r_esc_categoria GROUP BY rec_esc_id ORDER BY rec_cat_id ASC";
 $ct = array();


 if ($qry_cat = $conn->query($sql_cat)) {

   while($cat = $qry_cat->fetch_array()) {

    $esc_id = null;
    $esc_id = $cat['rec_esc_id'];


    $sql_ncat = "SELECT cat_titulo FROM ".TABLE_PREFIX."_categoria INNER JOIN ".TABLE_PREFIX."_r_esc_categoria ON rec_cat_id=cat_id WHERE rec_esc_id={$cat['rec_esc_id']} ORDER BY cat_titulo";
    $cc = null;

      if($qry_ncat = $conn->query($sql_ncat)) {

        while($ncat = $qry_ncat->fetch_array()) {
          $cc .= $ncat['cat_titulo'].', ';
        }


      }

    $ct[$esc_id] = substr($cc, 0, -2);


   }


 }


/*
 *query das escolas
 */
$sql = "SELECT  ${var['pre']}_id,
		${var['pre']}_titulo,
		${var['pre']}_telefone,
		${var['pre']}_responsavel,
		${var['pre']}_status,
		(SELECT rei_imagem FROM ".TABLE_PREFIX."_r_${var['pre']}_imagem WHERE rei_${var['pre']}_id=${var['pre']}_id ORDER BY rei_pos ASC LIMIT 1) imagem
		
		FROM ".TABLE_PREFIX."_${var['path']}
		ORDER BY ${var['pre']}_titulo ASC";


 if (!$qry = $conn->prepare($sql)) {
  echo 'Houve algum erro durante a execução da consulta<p class="code">'.$sql.'</p><hr>';
  echo $conn->error;

  } else {

    $qry->execute();
    $qry->bind_result($id, $titulo, $telefone, $responsavel, $status, $imagem);

?>
<h1><?=$var['mono_plural']?></h1>
<p class='header'></p>


<table class="list">
   <thead> 
      <tr>
        <th width="25px"></th>
        <th width="150px">Responsável</th>
        <th>Escola</th>
      </tr>
   </thead>
   <tbody>
<?php
    $j=0;
    // Para cada resultado encontrado...
    while ($qry->fetch()) {


$delete_images = "&prefix=r_${var['pre']}_imagem&pre=rei&col=imagem&folder=${var['imagem_folderlist']}";
$row_actions = <<<end
<a href='?p=$p&delete&item=$id${delete_images}&noVisual' title="Clique para remover o ítem selecionado" class='tip trash' style="cursor:pointer;" id="${id}" name='$nome'>Remover</a> | <a href="?p=$p&update&item=$id" title='Clique para editar o ítem selecionado' class='tip edit'>Editar</a>
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
        <center>
          <a id='ima<?=$j?>' href="$im<?=$j?>?width=100%" class="betterTip" style="cursor:pointer;">
            <img src="images/lupa.gif">
          </a>
          <div id="im<?=$j?>" style="float:left;display:none">
          <?php
              $arquivo = substr($var['path_thumb'],0).'/'.$imagem;
              if (is_file($arquivo)) 
               echo "<img src='{$arquivo}'>";

              else
               echo 'sem imagem';
          ?>
          </div>
        </center>
      	</td>
        <td><?=$responsavel?><br/><?=nl2br($telefone)?></td>
        <td>
          <?=$titulo?>
          <br/><?=$ct[$id]?>
          <div class='row-actions'><?=$row_actions?></div>
        </td>
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
