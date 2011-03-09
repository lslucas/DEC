<?php
 # include_once "../auth.php";
   include_once '../_inc/global.php';
   include_once '../_inc/db.php';
   include_once '../_inc/global_function.php';
   include_once 'mod.var.php';


  for($i=0;$i<count($_POST['posImagem']);$i++) {
  
  if (!empty($_POST['posImagem'][$i])) {
   $id_imagem = $_POST['posImagem'][$i];
   
    $sql_up = "UPDATE ".TABLE_PREFIX."_r_leg_arquivo SET rpa_pos=? WHERE rpa_id=?";
    $sql_up = $conn->prepare($sql_up);
    $sql_up->bind_param('ii',$i,$id_imagem);
    $sql_up->execute();

  }

 }

?>
