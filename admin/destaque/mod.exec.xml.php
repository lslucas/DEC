<?php

  include_once "_inc/function.xml.php";

  $sourceXML  = '../banners.xml';
  $xmlEnconding = 'utf8';


  /*
   *where
   */
  $where = "WHERE dest_status=1 AND dest_imagem IS NOT NULL OR dest_status=1 AND dest_video IS NOT NULL";

  /*
   *verifica se é randomico ou não
   */
  $sql_random = "SELECT dest_random, dest_time, dest_showheader, COUNT(dest_id) FROM ".TABLE_PREFIX."_destaque $where GROUP BY dest_random";
  if (!$qry_random = $conn->prepare($sql_random)) {
   echo 'Houve algum erro durante a execução da consulta<p class="code">'.$sql_random.'</p><hr>';

   } else {

    $qry_random->execute();
    $qry_random->bind_result($random, $time, $showheader, $total);
    $qry_random->fetch();
    $qry_random->close();

  }


  headerXMLParametro('rotator', 'isRandom="'.$random.'"'); // FUN«√O QUE GERA O CABE«ALHO DO XML 
   childNoCDATA('bannerTime', $time);
   childNoCDATA('numberOfBanners', $total);
    node1('banners', 'showHeader="'.$showheader.'"');


$sql = "SELECT
              dest_titulo,
              dest_link,
              dest_imagem,
              dest_video,
              dest_texto

	  FROM ".TABLE_PREFIX."_destaque
    $where

	  ORDER BY dest_data DESC";

 if (!$qry = $conn->prepare($sql)) {
  echo 'Houve algum erro durante a execução da consulta<p class="code">'.$sql.'</p><hr>';

  } else {

    $qry->execute();
    $qry->bind_result($titulo, $link, $imagem, $video, $texto);

    $PATH_IMG = $rp.'../banner_img';
    $file='';



    while ($qry->fetch()) {

      if(!empty($imagem) && is_file($PATH_IMG.'/destaque/'.$imagem))
        $file = 'destaque/'.$imagem;

      if(!empty($video) && is_file($PATH_IMG.'/destaque/video/'.$video))
        $file = 'destaque/video/'.$video;


       node('banner');
          if(!empty($titulo)) child('name',utf8_encode(html_entity_decode($titulo)));
           else childNoCDATA('name','');


          if(!empty($texto)) child('body',utf8_encode(html_entity_decode($texto)));
           else childNoCDATA('body','');

          childNoCDATA('imagePath',$file);
          childNoCDATA('link',$link);
       closeNode('banner');


	  }

    $qry->close();


  	closeNode('banners');
  footerXML('rotator'); // FUN«√O QUE GERA O RODAP… E SALVA O XML
  unset($sourceXML,$newXML);

  }
