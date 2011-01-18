<?php

  foreach($_POST as $chave=>$valor) {
   $res[$chave] = $valor;
  }



     #insere as fotos/galeria do artigo
     include_once 'mod.exec.galeria.php';

?>
<script>window.location='<?=$rp?>index.php?p=<?=$p?>&update&obr=<?=$res['obr_id']?>';</script>
