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
  <script type="text/javascript" src="js/loopedslider.js"></script>
  <script>

    $(function() {

			$('#destaque').loopedSlider({
				addPagination: false,
				autoStart: 5000,
        containerClick: false
			});


    });

  </script>

  <link rel="stylesheet" href="js/coin-slider-styles.css" type="text/css" /> 

<style type="text/css">
* {
	font-family: Arial, Helvetica, sans-serif;
  font-weight:normal;
	font-size: 11px;
	color: #464646;

} body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/bg/bg_geral.jpg);
	background-repeat: no-repeat;
	background-color: #00537D;
} hr {

  margin-top:10px;
  margin-bottom:10px;
  border:0px;
  border-top:1px solid #CECECE;

} h1, h2, h3, h4, h5, h6 {

  color: #104C54;
  font-weight:bolder;
  margin:0px;
  padding:0px;

}

h3 { font-size:18px; }
h4 { font-size:1.2em; }
h5 { font-size:0.95em; }
.content-box { padding:10px; }
.sub-box > img { float:left; display:table-cell; }
.sub-box > div { padding-left:25px; }

a, a:link, a:visited {

  text-decoration:none;
  color:#656565;
  font-size:12px;
  font-weight:normal;

} a:hover, a:active {

  text-decoration:underline;
  color:#104C54;

} .fontTitulo {
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

/*
 *menu
 */
.menu a, .menu a:link, .menu a:visited, .menu a:hover, .menu a:active {

  color:white;

}
/*
 *marcadores
 */
ul.twitter { list-style:none; margin:0; padding:0; }

/*
 *formulários
 */
input::-webkit-input-placeholder { color: #424242; }
input:-moz-placeholder { color: #424242; }


input[type='checkbox'], input[type='password'], input[type='text'] {

  width:180px;
  height:16px;
  border:1px solid #939393;
  background-color:#B1B1B1;
  color:#424242;
  font-size:12px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
}

input[name='news-email'], input[name='news-nome'] { margin-right:8px; }
input[name='news-submit'] { bottom:-3px; display:inline; position:relative; }
/*
* Required 
*/
.container { width:350px; height:200px; overflow:hidden; position:relative; cursor:pointer; }
.slides { position:absolute; top:0; left:0; margin-left:0px; }
.slides > div { position:absolute; top:0; width:350px; display:none; text-align:left; }
.slides > div > a, .slides > div > a:link, .slides > div > a:visited { text-decoration:none; color:#777777; font-size:12px; font-weight:bold; text-align:left; }
.slides > div > a:hover, .slides > div > a:active { text-decoration:none; color:#656565; font-size:12px; font-weight:bold; text-align:left; }
.slides > div > span, .slides > div > a > span { position:relative; bottom:0px; margin-top:5px; display:block; color:#777777; text-align:left; font-size:12px; font-weight:bold; width:310px; height:15px; white-space:no-wrap; }
.slides > div > a > img { margin-bottom:5px; }
div#arrows { width:40px; text-align:right; float:right; position:relative; margin-right:5px; margin-top:-20px; }
div#arrows > img{ cursor:pointer; } 
img.next { margin-left:5px; }
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
    <td><table width="750" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/bg/bg_menu.png" class="menu fontPadrao">
      <tr>
        <td align="center" valign="middle"><a href='index.php'>Home</a></td>
        <td align="center" valign="middle"><a href='equipe.php'>Equipe</a></td>
        <td align="center" valign="middle"><a href='escolas.php'>Escolas</a></td>
        <td align="center" valign="middle"><a href='programas.php'>Programas</a></td>
        <td align="center" valign="middle"><a href='concursos.php'>Concursos</a></td>
        <td align="center" valign="middle"><a href='noticias.php'>Noticías</a></td>
        <td align="center" valign="middle"><a href='contato.php'>Legislação</a></td>
        <td align="center" valign="middle"><a href='contato.php'>Contato</a></td>
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


	<div id="destaque">
		<div class="container">
	        <div class="slides">
              <?php

                $i = 0;
                while($qry_dest->fetch()) {

                  echo "<div>";

                  if(!empty($link)) echo "<a href='${link}'>";

                    echo "<img src='images/destaque/${imagem}' border=0/>";

                  if(!empty($titulo)) echo "<span>${titulo}</span>";
                  if(!empty($link)) echo "</a>";


                  echo "</div>";

                 $i++;
                }

              ?>
                </div>
          </div>
          <div id='arrows'>
            <img src='images/arrow-left.png' border=0 class='previous'/>
            <img src='images/arrow-right.png' border=0 class='next'/>
          </div>
        </div> 


            </td>
            <td width="25">&nbsp;</td>
            <td align="left" valign="top">
              <span class="textoPadrao">NOTICÍAS</span>
              <div style='height:22px;'></div>

              <h3>Enade</h3>
              <?php

                $i = 0;
                while($qry_not->fetch()) {

                  if($i==1) {
                    echo "<div style='height:12px;'></div>";
                    echo "<hr>";
                    echo "<div style='height:12px;'></div>";
                    echo "<h3>Universidades</h3>";
                  }



                  echo "<div style='height:8px;'></div>";
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
            <td width="209" height="128" align="left" valign="middle" background="images/pagina_inicial/bg_subdestaque2.jpg">

              <div align='center'><img src='images/total-alunos.jpg' border=0/></div>
              <div style='padding:10px;'>
              Total de alunos da rede municipal.
              </div>

            </td>
            <td width="26"><h4>&nbsp;</h4></td>
            <td width="209" height="128" align="left" valign="middle" background="images/pagina_inicial/bg_subdestaque2.jpg" class="fontTitulo">
             <div class='content-box'>

                <h5>Comunicado de Atribuições de Aula</h5>

                <div style='height:18px;'></div>
                <div class='sub-box'>
                  <img src='images/ico-download.jpg' border=0 class='ico'/>
                  <div>
                    PI - Edital 29/09/2010
                    <br/><a href='javascript:void(0);'>(download)</a>
                  </div>
                </div>
                <div style='height:18px;'></div>
                <div class='sub-box'>
                  <img src='images/ico-download.jpg' border=0 class='ico'/>
                  <div>
                    PIII - Ciências 29/19/2011
                    <br/><a href='javascript:void(0);'>(download)</a>
                  </div>
                </div>

              </div>
            </td>
            <td width="26"><h4>&nbsp;</h4></td>
            <td width="232" align="left" valign="middle" background="images/pagina_inicial/bg_subDestque.jpg">

              <div align='center'><img src='images/escolas-municipais.jpg' border=0/></div>
              <div style='padding:10px;'>
              Confira a relação das Escolas Municipais de Ensino Fundamental e Médio da cidade de Taubaté. As relações estão publicadas com endereços e telefones de contato.
              </div>
            </td>
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
                <td height="82" align="left" valign="middle" background="images/pagina_inicial/bg_twitter.jpg">
                  <div class='content-box'>
                    <h4>TWITTER</h4>
                    <div style='height:6px;'></div>
                    <?=getTwitterStatus('redemunicipal')?>
                  </div>
                </td>
              </tr>
              <tr>
                <td><img src="images/pagina_inicial/space.gif" alt="" width="1" height="14" border="0" /></td>
              </tr>
              <tr>
                <td height="64" align="left" valign="top" background="images/pagina_inicial/bg_newsletter.jpg">
                  <div class='content-box'>
                    <h4>NEWSLETTER</h4>

                    <form name='news' action='controller/newsletter.php' method='post'>

                       <input type='text' name='news-nome' placeholder='Nome'/>
                       <input type='text' name='news-email' placeholder='E-mail'/>
                       <input type='image' name='news-submit' src='images/bt-ok.png' border=0/>

                    </form>


                  </div>
                </td>
              </tr>
            </table></td>
            <td width="26">&nbsp;</td>
            <td width="232" height="160" align="left" valign="top"><table width="232" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href='http://twitter.com/lslucas' target='_blank'><img src="images/pagina_inicial/btn_twitter.jpg" width=232 height=24 border=0/></a></td>
              </tr>
              <tr>
                <td><img src="images/pagina_inicial/space.gif" width="1" height="8" border="0" /></td>
              </tr>
              <tr>
                <td height="128" align="left" valign="top" background="images/pagina_inicial/bg_login.jpg">

                  <div class='content-box' style='margin-left:15px;'>
                    <h4>ÁREA ADMINISTRATIVA</h4>

                    <div style='height:8px;'></div>
                    <form name='adm' action='controller/adm.php' method='post'>

                       <input type='text' name='adm-login' placeholder='Login'/>
                       <div style='height:6px;'></div>
                       <input type='password' name='adm-senha' placeholder='Senha'/>
                       <div style='height:6px;'></div>

                       <table border=0>
                        <tr>
                          <td width=130><a href='javascript:void(0);'>esqueceu a senha?</a></td>
                          <td><input type='image' name='adm-submit' src='images/bt-entrar.png' border=0/></td>
                        </tr>
                        <tr>
                          <td rowspan=2><a href='javascript:void(0);'>dúvidas?</a></td>
                        </tr>
                       </table>

                    </form>


                  </div>

                </td>
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
