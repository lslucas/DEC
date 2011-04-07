<?php

   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';


    /*
     *query das projícias
     */
    $item = (int) $_GET['item'];
   $sql_esc = "SELECT rec_cat_id,
                  (SELECT cat_titulo FROM ".TABLE_PREFIX."_categoria WHERE cat_area='escola' AND cat_id=rec_cat_id)
                  FROM ".TABLE_PREFIX."_r_esc_categoria

                      WHERE rec_cat_id IS NOT NULL
                            AND rec_esc_id IS NOT NULL
                            AND EXISTS(SELECT null FROM ".TABLE_PREFIX."_escola WHERE esc_id=rec_esc_id AND esc_status=1)
                            GROUP BY rec_cat_id
               ";

    if(!$qry_esc= $conn->prepare($sql_esc)) {
      echo $conn->error;

    } else {

      $qry_esc->execute();
      $qry_esc->bind_result($cat_id, $cat);
      $qry_esc->fetch();





      include_once '_inc.header.php';


?>
          <h1>ESCOLAS</h1></td>
          </tr>
          <tr>
            <td><h4>A rede municipal de educação de Taubaté conta com 112 unidades próprias e 6 conveniadas.</h4></td>
          </tr>
          <tr>
            <td><table style="background:url(images/banner.png) no-repeat" width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="184" align="center" valign="middle"><img src="images/banner_escolas.png" width="691" height="174" /></td>
              </tr>
              <tr>
                <td height="28" style="height:28;" align="right" valign="middle" ><h5>112 unidades próprias e 6 convêniadas.</h5></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="205" valign="top"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h2>UNIDADES ESCOLARES</h2></td>
          </tr>
          <tr>
            <td align='center'>
              <table border="0" cellspacing="0" cellpadding="0" id="botoes">
              <?php

                $i=0;
                while($qry_esc->fetch()) {

                  if($i==0)
                    echo "<tr>";

              ?>
                <td height="54" width="99" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><a href='escolas_interna.php?cat=<?=$cat_id?>'><h4 style='font-size:8pt'><?=trim($cat)?></h4></a></td>
                <td width="7">&nbsp;</td>
              <?php
                if($i==5) {
                  echo ' </tr> <tr> <td colspan="7" height="5"></td> </tr>';
                  $i=-1;
                }

                $i++;

               }
              ?>
             </table>
              </td>
              </tr>
            </table>
<?php
      $qry_esc->close();

    }

    include_once '_inc.footer.php';

?>
