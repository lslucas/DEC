<?php

   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';


 /*
     *busca total de itens e faz variaveis de paginação
     */
    $sql_tot = "SELECT NULL FROM ".TABLE_PREFIX."_concurso WHERE conc_titulo IS NOT NULL AND conc_status=1";
    $qry_tot = $conn->query($sql_tot);

    $total_itens = $qry_tot->num_rows;
    $limit_end   = 10;
    $n_paginas   = ceil($total_itens/$limit_end);
    $pg_atual    = isset($_GET['pg']) && !empty($_GET['pg'])?$_GET['pg']:1;
    $limit_start = ceil(($pg_atual-1)*$limit_end);

    $qry_tot->close();




    /*
     *query das concurso
     */
    $sql_conc = "SELECT conc_id, conc_titulo, 
                        DATE_FORMAT(conc_data, '%d/%m/%Y') data, 
                        conc_inscricao
                  FROM ".TABLE_PREFIX."_concurso

                      WHERE conc_titulo IS NOT NULL
                            AND conc_status=1

                            ORDER BY conc_data DESC
                            LIMIT {$limit_start}, {$limit_end}
                            ";

    if(!$qry_conc= $conn->prepare($sql_conc)) {
      echo $conn->error;

    } else {

      $qry_conc->execute();
      $qry_conc->bind_result($item, $titulo, $data, $inscricao);



      include_once '_inc.header.php';


?>
          <h1>CONCURSOS</h1></td>
          </tr>
          <tr>
            <td><h4>Aguarde notícias sobre concursos públicos!</h4></td>
          </tr>
          <tr>
            <td><table style="background:url(images/banner.png) no-repeat" width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="184" align="center" valign="middle"><img src="images/banner_concursos.png" width="691" height="174" /></td>
              </tr>
              <tr>
                <td height="28" style="height:28;" align="right" valign="middle" ><h5>Concursos Públicos</h5></td>
              </tr>
            </table>
          <?php

            $i=0;
            while($qry_conc->fetch()) {

          ?>
          <table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="40">
                    <table width="600" border="0" cellspacing="0" cellpadding="0" id="lista">
                        <tr>
                        <td style="padding-left:15px"><a href='concursos_interna.php?item=<?=$item?>' id="lista"><h4><span style="color:#003F5F"><?=$data?>: <?=$titulo?></span></h4></a></td>
                        </tr>
                      </table></td>
                </tr>
                <tr>
                  <td style="background:#cccccc" height="1"></td>
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
            </table>
<?php

    }

    include_once '_inc.footer.php';

?>
