<?php
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';

 /*
     *busca total de itens e faz variaveis de paginação
     */
    $sql_tot = "SELECT NULL FROM ".TABLE_PREFIX."_noticia WHERE not_titulo IS NOT NULL AND not_status=1";
    $qry_tot = $conn->query($sql_tot);

    $total_itens = $qry_tot->num_rows;
    $limit_end   = 4;
    $n_paginas   = ceil($total_itens/$limit_end);
    $pg_atual    = isset($_GET['pg']) && !empty($_GET['pg'])?$_GET['pg']:1;
    $limit_start = ceil(($pg_atual-1)*$limit_end);

    $qry_tot->close();



    /*
     *query das notícias
     */
    $sql_not = "SELECT not_id, not_titulo, not_subtitulo,
		                  (SELECT rni_imagem FROM ".TABLE_PREFIX."_r_not_imagem WHERE rni_not_id=not_id ORDER BY rni_pos ASC LIMIT 1) imagem 
                  FROM ".TABLE_PREFIX."_noticia

                      WHERE not_titulo IS NOT NULL
                            AND not_status=1

                            ORDER BY not_titulo ASC
                            LIMIT {$limit_start}, {$limit_end}";

    if(!$qry_not= $conn->prepare($sql_not)) {
      echo $conn->error;

    } else {

      $qry_not->execute();
      $qry_not->bind_result($item, $titulo, $subtitulo, $imagem);



      include_once '_inc.header.php';


?>
          <h1>NOTÍCIAS</h1></td>
          </tr>
          <tr>
            <td><h4>Fique por dentro de tudo que acontece no setor de educação da sua cidade, do seu estado, de Brasil e no Mundo.</h4></td>
          </tr>
          <tr>
            <td><table style="background:url(images/banner.png) no-repeat" width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="184" align="center" valign="middle"><img src="images/banner_noticias.png" width="691" height="174" /></td>
              </tr>
              <tr>
                <td height="28" style="height:28;" align="right" valign="middle" ><h5>Notícias.</h5></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="205" valign="top"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
          <?php

            $i=0;
            while($qry_not->fetch()) {

          ?>
          <table width="700" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="90"><table width="700" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100" height="61" valign="top" style="background:url(images/fundo_thumb.png) no-repeat;">
                      <div id="mascaraSobreThumb"><a href='noticias_interna.php?item=<?=$item?>'><img src="images/luzthumb.png" width="100" height="60" border="0"></a></div><img src="images/noticia/thumb/<?=$imagem?>" alt="<?=$titulo?>" width="100" height="60" />
                      </td>
                      <td ><table width="600" border="0" cellspacing="0" cellpadding="0" id="lista">
                        <tr>
                        <td style="padding-left:15px"><h4><span style="color:#003F5F"><?=$titulo?></span></h4></td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px; top:-5px;"><a href='noticias_interna.php?item=<?=$item?>' id="lista"><?=$subtitulo?></a></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td style="background:#cccccc" height="1"></td>
                </tr>
                </table>
              </td>
            </tr>
          </table>
          <?php

            $i++;
            }
          ?>
      <tr>
        <td align="center"><table width="190" border="0" align="center" cellpadding="0" cellspacing="5" id="nav">
          <tr>
            <?php
                /*
                 *paginação
                 */
                $queryString = ereg_replace("(\?\&)?(pg=[0-9])",'',$_SERVER['QUERY_STRING']);
                $nav_cat = '';


                if(!isset($_GET['pg']))
                 $nav_cat.='&';

                $nav_cat.=$queryString;
                $nav_nexturl   = $pg_atual==$n_paginas?'javascript:void(0)':'?pg='.($pg_atual+1).$nav_cat;
                $nav_prevurl   = $pg_atual==1?'javascript:void(0)':'?pg=1'.$nav_cat;

                echo '<td width="16"><a class="fcinzaclaro" href="'.$nav_prevurl.'">anterior</a></td>';


              echo '<td width="102" align="center">';
              for($p=1;$p<=$n_paginas;$p++) {

                $nav_url   = $pg_atual==$p?'javascript:void(0)':'?pg='.$p.$nav_cat;

                if($p<>$_GET['pg'])
                  echo ' <a class="fcinzaclaro" href="'.$nav_url.'">';

                if($p<>$_GET['pg'])
                  echo $p;
                 else echo ' '.$p.' ';


                if($p<>$_GET['pg'])
                  echo '</a> ';

                if($p<$n_paginas) echo '|';

              }

              echo '</td>';

              echo '<td width="16"><a class="fcinzaclaro" href="'.$nav_nexturl.'">próximo</a>';
            ?>

<?php

    }

    include_once '_inc.footer.php';

?>
