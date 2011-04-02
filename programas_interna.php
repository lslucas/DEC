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
    $sql_proj = "SELECT proj_id, proj_titulo, proj_texto
                  FROM ".TABLE_PREFIX."_projeto

                      WHERE proj_titulo IS NOT NULL
                            AND proj_status=1
                            AND proj_id={$item}
               ";

    if(!$qry_proj= $conn->prepare($sql_proj)) {
      echo $conn->error;

    } else {

      $qry_proj->execute();
      $qry_proj->bind_result($item, $titulo, $texto);
      $qry_proj->fetch();





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
            <td height="161" align="left" valign="top" style="background-color:white" ><table width="680" border="0" cellspacing="0" cellpadding="0" id="lista" style="margin-left:10px; margin-top:10px;">
              <tr>
              <td><h3><?=$titulo?></h3></td>
                </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td><table  width="650" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="325" valign="top"><h4><?=$texto?></h4></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
<?php
    }

    include_once '_inc.footer.php';

?>
