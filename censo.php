<?php

   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';

   $sql= "SELECT MIN(cen_ano) min, MAX(cen_ano) max FROM ".TABLE_PREFIX."_censo WHERE cen_ano IS NOT NULL AND cen_status=1 LIMIT 0,1";
    if(!$qry= $conn->prepare($sql)) {
      echo $conn->error;

    } else {

      $qry->execute();
      $qry->bind_result($min, $max);
      $qry->fetch();
      $qry->close();

    }

    /*
     *query das projícias
     */
   $sql_censo = "SELECT cen_ano FROM ".TABLE_PREFIX."_censo

                      WHERE cen_ano IS NOT NULL
                            AND cen_status=1
                            GROUP BY cen_ano
                            ORDER BY cen_ano DESC
               ";

    if(!$qry_censo= $conn->prepare($sql_censo)) {
      echo $conn->error;

    } else {

      $qry_censo->execute();
      $qry_censo->bind_result($ano);



      include_once '_inc.header.php';
?>
  <h2>CONFIRA O CENSO DE <?=$min?> A <?=$max?></h2></td>
          </tr>
          <tr>
            <td><table width="620" border="0" cellspacing="0" cellpadding="0" id="botoes">
              <?php

                $i=0;
                while($qry_censo->fetch()) {

                  if($i==0)
                    echo "<tr>";

              ?>
                <td height="54" width="99" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><a href='censo_interna.php?ano=<?=$ano?>'><h4 style='font-size:8pt'><?=trim($ano)?></h4></a></td>
                <td width="7">&nbsp;</td>
              <?php
                if($i==5) {
                  echo ' </tr> <tr> <td colspan="7" height="5"></td> </tr>';
                  $i=-1;
                }

                $i++;

               }
                $qry_censo->close();


                for($j=0;$j<4;$j++) {
              ?>
                <td height="54" width="99" align="center" valign="middle">&nbsp;</td>
                <td width="7">&nbsp;</td>
              <?php
                }
              ?>
            </table>
<?php

    }

    include_once '_inc.footer.php';

?>
