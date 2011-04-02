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
    $cat = (int) $_GET['cat'];
    $sql_esc = "SELECT esc_id,
                       esc_titulo,
                       esc_endereco, 
                      (SELECT cat_titulo FROM ".TABLE_PREFIX."_categoria WHERE cat_area='escola' AND cat_id=rec_cat_id)
                  FROM ".TABLE_PREFIX."_escola
                  INNER JOIN ".TABLE_PREFIX."_r_esc_categoria
                  ON rec_esc_id=esc_id

                  WHERE rec_cat_id={$cat}
                        AND esc_titulo IS NOT NULL
                            AND esc_endereco IS NOT NULL
                            GROUP BY esc_id
                            ORDER BY esc_titulo ASC
               ";
    if(!$qry_esc= $conn->prepare($sql_esc)) {
      echo $conn->error;

    } else {

      $qry_esc->execute();
      $qry_esc->bind_result($id, $titulo, $endereco, $cat);
      $qry_esc->fetch();
      $qry_esc->store_result();





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
          <td><h2>Unidades de <?=$cat?></h2></td>
          </tr>
          <tr>
            <td height="161" align="left" valign="top" style="background-color:white"><table width="680" border="0" cellspacing="0" cellpadding="0" id="lista" style="margin-left:10px; margin-top:10px;">
              <tr>
                <td width="325"><h3>ESCOLA</h3></td>
                <td width="355"><h3>ENDEREÇO</h3></td>
              </tr>
              <tr>
                <td colspan="2" height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td colspan="2"><table  width="650" border="0" cellspacing="0" cellpadding="0">
                  <?php

                    while($qry_esc->fetch()) {

                  ?>
                  <tr>
                    <td width="325"><h4><?=$titulo?></h4></td>
                    <td width="325"><h4><?=$endereco?></h4></td>
                  </tr>
                  <?php

                    }

                  ?>
                </table></td>
              </tr>
              </table>
<?php
      $qry_esc->close();

    }

    include_once '_inc.footer.php';

?>
