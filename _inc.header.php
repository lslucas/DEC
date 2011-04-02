<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>DEC</title>

  <link rel="stylesheet" href="js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

  <!--<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>-->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
  <script type="text/javascript" src="js/loopedslider.js"></script>
  <script type="text/javascript" src="js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script>

    $(function() {

      /*
       *lightbox para atribuições de aulas
       */
      $('.lightbox').fancybox();

      /*
       *destaque de imagem rotativo
       */
			$('#destaque').loopedSlider({
				addPagination: false,
				autoStart: 5000,
        containerClick: false
			});


      $('[name="newsletter"]').submit(function(e) {
        e.preventDefault();

        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: $(this).serialize(),
          success: function(msg) {
           $('#return-newsletter').html(msg);
          }
        });

      });


    });

  </script>
  <link rel="stylesheet" href="js/coin-slider-styles.css" type="text/css" /> 
  <link rel="stylesheet" href="style.css" type="text/css" />
  <link href="css/style.css" rel="stylesheet" type="text/css" />

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
        <td align="center" valign="middle"><a href='legislacao.php'>Legislação</a></td>
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
        <td width="740">

          <table width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>


