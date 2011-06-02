<?php
## RESGATA VARIAVEIS
  $sql_var = "SELECT mod_nome,mod_nome_singular,mod_nome_plural,mod_genero,mod_path,mod_pre FROM ".TABLE_PREFIX."_modulo WHERE mod_path=?";
  $qry_var = $conn->prepare($sql_var);
  $qry_var->bind_param('s',$p);
  $qry_var->execute();
  $qry_var->bind_result($vr_nome,$vr_singular,$vr_plural,$vr_genero,$vr_path,$vr_pre);
  $qry_var->fetch();

    $var['pre'] = $vr_pre;
    $var['path'] = $vr_path;
    $var['title'] = $vr_nome;
    $var['mono_singular'] = $vr_singular;
    $var['mono_plural'] = $vr_plural;
    $var['genero'] = $vr_genero;
    $var['novo'] = 'nov'.$vr_genero.' '.$vr_singular;
    $var['um'] = ($vr_genero=='a')?'uma '.$vr_singular:'um '.$vr_singular;
    $var['insert'] = 'Cadastro de '.$vr_singular;
    $var['update'] = 'Alterar '.$vr_singular;

#UPLOAD DE ARQUIVOS
    $var['imagemWidth'] = 350;
    $var['imagemHeight'] = 173;
    $var['thumbWidth'] = 175;
    $var['thumbHeight'] = 86;

    $var['imagemWidth_texto'] = ' '.$var['imagemWidth'].'px (largura)';
    $var['imagemHeight_texto'] = ' '.$var['imagemHeight'].'px (altura)';

    $var['path_imagem']   = PATH_IMG.'/'.$var['path'];
    $var['path_original'] = PATH_IMG.'/'.$var['path'].'/original';
    $var['path_thumb']    = PATH_IMG.'/'.$var['path'].'/thumb';

    $var['imagem_folderlist'] = $var['path_imagem'].','.$var['path_original'].','.$var['path_thumb'];




    $field  = array('cen_ano',
      'cen_estadual_creche',
      'cen_estadual_preescolar',
      'cen_estadual_fundamental',
      'cen_estadual_especial',
      'cen_estadual_eja',
      'cen_estadual_medio',
      'cen_municipal_creche',
      'cen_municipal_preescolar',
      'cen_municipal_fundamental',
      'cen_municipal_especial',
      'cen_municipal_eja',
      'cen_municipal_medio',
      'cen_particular_creche',
      'cen_particular_preescolar',
      'cen_particular_fundamental',
      'cen_particular_especial',
      'cen_particular_eja',
      'cen_particular_medio',
      'cen_status'
    );
    $lfield = implode(',',$field);
    $vfield = implode(',$',$field);
    $vfield = '$'.$vfield;
    $vfield = explode(',',$vfield);

  $qry_var->close();



 if ($act=='update') {

  $sql_form = "SELECT $lfield FROM ".TABLE_PREFIX."_${var['path']} WHERE ${var['pre']}_id=".$_GET['item'];
  $qry_form = $conn->query($sql_form);
  $row = $qry_form->fetch_array();

  $qry_form->close();

 }


# DEFINE OS VALORES DE CADA CAMPO
   for($i=0;$i<count($field);$i++) {
    $sufix_field = str_replace($var['pre'].'_','',$field[$i]);
    $val[$sufix_field] = isset($row[$field[$i]])?$row[$field[$i]]:'';
   }


?>
