<?php

   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';



    /*
     *query das notícias
     */
    $sql_not = "SELECT not_id, not_titulo, not_tipo
                  FROM ".TABLE_PREFIX."_noticia

                      WHERE not_titulo IS NOT NULL
                            AND not_status=1

                            ORDER BY not_data DESC
                            LIMIT 0,2";

    $qry_not= $conn->prepare($sql_not);
    $qry_not->execute();
    $qry_not->store_result();
    $qry_not->bind_result($id, $titulo, $tipo);





    /*
     *query dos destaques
     */
    $sql_dest = "SELECT dest_id, dest_titulo, dest_imagem, dest_link
                  FROM ".TABLE_PREFIX."_destaque

                      WHERE dest_imagem IS NOT NULL
                            AND dest_status=1

                            ORDER BY dest_data DESC
                            LIMIT 0,5";

    $qry_dest= $conn->prepare($sql_dest);
    $qry_dest->execute();
    $qry_dest->store_result();
    $qry_dest->bind_result($id, $titulo, $imagem, $link);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>DEC</title>

  <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="js/coin-slider.min.js"></script>
  <script>

    $(function() {

      $('#coin-slider').coinslider({ width: 350, height:170, navigation: false, delay: 5000 });

    });

  </script>

  <link rel="stylesheet" href="js/coin-slider-styles.css" type="text/css" /> 

<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/bg/bg_geral.jpg);
	background-repeat: no-repeat;
	background-color: #00537D;
}
.fontPadrao {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFF;
}
.fontTitulo {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
	color: #024362;
}
.textoPadrao {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #999;
}
</style>
</head>

<body>	
<table width="764" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="118" align="left" valign="top" background="images/bg/topo.png" style="padding:7px"><table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="252" height="108" align="center" valign="middle"><img src="images/bg/logo_taubate.png" width="193" height="51" border="0" /></td>
        <td width="288">&nbsp;</td>
        <td width="210" align="center" valign="middle"><img src="images/bg/livros_topo.jpg" width="137" height="76" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="750" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/bg/bg_menu.png">
      <tr>
        <td align="center" valign="middle" class="fontPadrao">Home</td>
        <td align="center" valign="middle" class="fontPadrao">Equipe</td>
        <td align="center" valign="middle" class="fontPadrao">Escolas</td>
        <td align="center" valign="middle" class="fontPadrao">Programas</td>
        <td align="center" valign="middle" class="fontPadrao">Concursos</td>
        <td align="center" valign="middle" class="fontPadrao">Noticías</td>
        <td align="center" valign="middle" class="fontPadrao">Legislação</td>
        <td align="center" valign="middle" class="fontPadrao">Contato</td>
        <td width="160">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="20" align="left" valign="top" style="padding-top:4px"><img src="images/bg/bg_rodape.png" width="764" height="20" border="0" /></td>
  </tr>
  <tr>
    <td height="500" align="left" valign="top" background="images/bg/bg_geral.png" style="padding-bottom:6px; padding-top:6px; padding-left:17px; padding-right:17px"><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="740"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="360" height="214" align="center" valign="middle" background="images/pagina_inicial/bg_destaque.jpg">


              <div id='coin-slider'>
              <?php

                $i = 0;
                while($qry_dest->fetch()) {

                  echo "<a href='img${i}_url'>";
                  echo "<img src='images/destaque/${imagem}' border=0/>";
                  echo "<span>${titulo}</span>";
                  echo "</a>";

                 $i++;
                }

              ?>
              </div>


            </td>
            <td width="25">&nbsp;</td>
            <td align="left" valign="top">
              <span class="textoPadrao">NOTICÍAS</span>

              <h3>Enade</h3>
              <?php

                $i = 0;
                while($qry_not->fetch()) {

                  if($i==1)
                    echo "<h3>Universidades</h3>";


                  echo "<a href='noticias.php?item=${id}'>${titulo}</a>";


                 $i++;
                }

              ?>


            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="26">&nbsp;</td>
      </tr>
      <tr>
        <td><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="209" height="128" align="center" valign="middle" background="images/pagina_inicial/bg_subdestaque2.jpg"><h4><span class="textoPadrao">Texto Padrão</span></h4></td>
            <td width="26"><h4>&nbsp;</h4></td>
            <td width="209" height="128" align="center" valign="middle" background="images/pagina_inicial/bg_subdestaque2.jpg" class="fontTitulo"><h4>Comunicado</h4></td>
            <td width="26"><h4>&nbsp;</h4></td>
            <td width="232" align="center" valign="middle" background="images/pagina_inicial/bg_subDestque.jpg"><h4 class="textoPadrao">Texto Padrão</h4></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="26">&nbsp;</td>
      </tr>
      <tr>
        <td height="160"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="441" height="160" align="left" valign="top"><table width="441" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="82" align="center" valign="middle" background="images/pagina_inicial/bg_twitter.jpg"><span class="fontTitulo">TWITTER</span></td>
              </tr>
              <tr>
                <td><img src="images/pagina_inicial/space.gif" alt="" width="1" height="14" border="0" /></td>
              </tr>
              <tr>
                <td height="64" align="center" valign="middle" background="images/pagina_inicial/bg_newsletter.jpg" class="fontTitulo">NEWSLETTER</td>
              </tr>
            </table></td>
            <td width="26">&nbsp;</td>
            <td width="232" height="160" align="left" valign="top"><table width="232" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/pagina_inicial/btn_twitter.jpg" width="232" height="24" border="0" /></td>
              </tr>
              <tr>
                <td><img src="images/pagina_inicial/space.gif" width="1" height="8" border="0" /></td>
              </tr>
              <tr>
                <td height="128" align="center" valign="middle" background="images/pagina_inicial/bg_login.jpg"><span class="fontTitulo">AREA ADMINISTRATIVA</span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="26" align="left" valign="top"><img src="images/bg/bg_rodape2.png" width="764" height="26" border="0" /></td>
  </tr>
</table>
</body>
</html>
