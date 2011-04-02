<?php
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';



    /*
     *query das notícias
     */
    $item = (int) $_GET['item'];
    $sql_not = "SELECT not_id, not_titulo, not_subtitulo, not_texto,
		                  (SELECT rni_imagem FROM ".TABLE_PREFIX."_r_not_imagem WHERE rni_not_id=not_id ORDER BY rni_pos ASC LIMIT 1) imagem 
                  FROM ".TABLE_PREFIX."_noticia

                      WHERE not_titulo IS NOT NULL
                            AND not_status=1
                            AND not_id={$item}
               ";

    if(!$qry_not= $conn->prepare($sql_not)) {
      echo $conn->error;

    } else {

      $qry_not->execute();
      $qry_not->bind_result($item, $titulo, $subtitulo, $texto, $imagem);
      $qry_not->fetch();



      include_once '_inc.header.php';


?>
          <h1>NOTÍCIAS</h1></td>
          </tr>
          <tr>
            <td><table width="270" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="10"><table width="254" border="0" align="left" cellpadding="2" cellspacing="0">
                  <tr>
                    <td style="background:#d4d4d4;"><table width="100%" cellpadding="0" cellspacing="3" style="background:#ffffff">
                      <tr>
                      <td><span class="txt_666"><img src="images/noticia/<?=$imagem?>" alt="<?=$titulo?>" width="250" height="200" /></span></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="10"></td>
                <td></td>
              </tr>
            </table>
            <h2><?=$subtitulo?></h2>
            <h4><?=$texto?></h4></td>
          </tr>
          <tr>
            <td><a href="noticias.php"><img src="images/voltarparanoticias.png" width="130" height="31" border="0" /></a>
<?php

    }

    include_once '_inc.footer.php';

?>
