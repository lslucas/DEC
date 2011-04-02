<?php

   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';


    /*
     *query das projurso
     */
    $sql_proj = "SELECT proj_id, proj_titulo, 
                        DATE_FORMAT(proj_data, '%d/%m/%Y') data
                  FROM ".TABLE_PREFIX."_projeto

                      WHERE proj_titulo IS NOT NULL
                            AND proj_status=1

                            ORDER BY proj_titulo ASC
                            ";

    if(!$qry_proj= $conn->prepare($sql_proj)) {
      echo $conn->error;

    } else {

      $qry_proj->execute();
      $qry_proj->bind_result($item, $titulo, $data);



      include_once '_inc.header.php';


?>
          <h1>PROGRAMAS E PROJETOS</h1></td>
          </tr>
          <tr>
            <td><h4>O Departamento de Educação e Cultura de Taubaté desenvolve, implanta e administra diversos projetos pedagógicos e mantém parcerias com instituições interessadas na melhoria da educação.</h4></td>
          </tr>
          <tr>
            <td><table style="background:url(images/banner.png) no-repeat" width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="184" align="center" valign="middle"><img src="images/banner_programas.png" width="691" height="174" /></td>
              </tr>
              <tr>
                <td height="28" style="height:28;" align="right" valign="middle" ><h5>Projeto Meio Ambiente.</h5></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="205" valign="top"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h2>NOSSOS PROJETOS</h2></td>
          </tr>
          <tr>
            <td><table width="664" border="0" cellspacing="0" cellpadding="0" id="botoes">
              <tr>
                <td width="664" height="54" align="left" valign="middle" >

              <table border="0" cellspacing="0" cellpadding="0" id="botoes">
              <?php

                $i=0;
                while($qry_proj->fetch()) {

                  if($i==0)
                    echo "<tr>";

              ?>
                <td height="54" width="99" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><a href='programas_interna.php?item=<?=$item?>'><h4><?=$titulo?></h4></a></td>
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
              <tr>
                <td></td>
              </tr>
              </table>
<?php
    }

    include_once '_inc.footer.php';

?>
