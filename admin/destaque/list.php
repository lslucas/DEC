<?php

$sql = "SELECT 
		${var['pre']}_id,
		${var['pre']}_titulo,
		DATE_FORMAT(${var['pre']}_data,'%d/%m/%y') data,
		${var['pre']}_link,
		${var['pre']}_imagem,
		${var['pre']}_video,
		${var['pre']}_status

	  FROM ".TABLE_PREFIX."_${var['table']}
	  
	  ORDER BY ${var['pre']}_data DESC";


 if (!$qry = $conn->prepare($sql)) {
  echo 'Houve algum erro durante a execução da consulta<p class="code">'.$sql.'</p><hr>';

  } else {

    #$sql->bind_param('s', $data); 
    $qry->execute();
    $qry->bind_result($id,$titulo,$data,$link,$imagem, $video, $status);
?>
<h1><?=$var['mono_plural']?></h1>
<p class='header'></p>


<table class="list">
   <thead> 
      <tr>
        <th width="25px"></th>
        <th width="75px">Data</th>
        <th style='min-width:120px;'>Título</th>
        <th style='min-width:120px;'>Link</th>
      </tr>
   </thead>  
   <tbody>
<?php

    $j=0;
    // Para cada resultado encontrado...
    while ($qry->fetch()) {

     #trata caso link esteja vazio
     $link = empty($link)?'[vazio]':$link;


# | <a href='$base/$p?item=$id' title="Veja no site" class='tip view' style="cursor:pointer;">Ver</a>
$row_actions = <<<end
<a href='?p=$p&delete&item=$id&noVisual' title="Clique para remover o ítem selecionado" class='tip trash' style="cursor:pointer;" id="${id}" name='$titulo'>Remover</a> | <a href="?p=$p&update&item=$id" title='Clique para editar o ítem selecionado' class='tip edit'>Editar</a>
end;

$row_actions .= <<<end
 | <a href="?p=${p}&status&item=${id}&noVisual" title="Clique para alterar o status do ítem selecionado" class="tip status status${id}" style="cursor:pointer;" id="${id}" name="${titulo}">
end;

   if ($status==1)
     $row_actions .= '<font color="#000000">Ativo</font>'; 
     
     else $row_actions .= '<font color="#999999">Pendente</font>';


$row_actions .= '</a>';

$permissoes='';
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
	        $video = substr($var['path_video'],0).'/'.$video;

		if (is_file($arquivo)) echo "<img src='{$arquivo}'>";
     elseif(is_file($video)) echo 'SWF ou FLV';
		  else echo 'sem imagem ou vídeo/swf';
	      ?>
	  </div>
	</center>

	</td>
        <td><?=$data?></td>
        <td><?=$titulo?><div class='row-actions'><?=$row_actions?></div></td>
        <td><?=$link?></td>

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

