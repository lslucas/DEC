<?php
      include_once '_inc.header.php';
?>
<style>
  .div { display:none; }
  .team{ cursor:pointer; }
</style>
<script type='javascript'>
  jQuery(function($) {
    $('.team').click(function() {
      alert('teste');

      var $divId = $(this).attr('alt');
      $('.div').slideUp();
      $('#'+$divId).slideToggle();
    });
  });
</script>
<table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h1>EQUIPE</h1></td>
  </tr>
  <tr>
    <td><h4>O Departamento de Educação possui uma vasta equipe de profissionais capacitados e preparados para a gestão e auxílio as unidades escolares.<br /><br />

São 112 unidades escolares e mais de 35 mil alunos que demandam atividades de um grande número de profissionais.</h4></td>
  </tr>
  <tr>
    <td height="1" background="#cccccc"></td>
  </tr>
</table>
</td>
            <td width="40"></td>
            <td width="360" style="background:url(images/fundo_equipe.png) no-repeat;"><table width="360" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="183" align="center" valign="middle" style=" margin-top:5px; margin-left:5px; margin-right:5px;" ><img src="images/banner_equipe.png" width="350" height="174" /></td>
              </tr>
              <tr>
                <td height="30" align="right" style="margin-right:3px;" ><h5>Profissionais Capacitados</h5></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><h4>&nbsp;</h4></td>
          </tr>
          <tr>
            <td colspan="3"><table width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><h2>SETORES DO DEPARTAMENTO DE EDUCAÇÃO</h2></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="205" valign="top"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="417"><table width="417" border="0" cellspacing="0" cellpadding="0" id="botoes">
              <tr>
                <td height="54" width="99" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><span class='team' alt='bolsa'><h4>Bolsas de<br /> Estudos</h4></span></td>
                <td width="7">&nbsp;</td>
                <td width="99" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><span class='team' alt='compras'><h4>Compras</h4></span></td>
                <td width="7">&nbsp;</td>
                <td width="99"  align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><span class='team' alt='comunicacao'><h4>Comunicação</h4></span></td>
                <td width="7">&nbsp;</td>
                <td width="99"  align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><span class='team' alt='coordenacao'><h4>Coordenação</h4></span></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td height="54" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='diretor'>Diretor do<br />
                  Departameno</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='gerencia'>Gerência</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='informatica'>Informática</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='merenda'>Merenda<br />
                  Escolar</h4></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td height="54" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='profissionais'>Profissionais<br />
                  Capacitados</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='projetos'>Projetos</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='secretaria'>Secretária<br />
                  Geral</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='pagamento'>Setor de<br />
                  Pagamento</h4></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td height="54" align="center" valign="middle" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='setores'>Setores</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='plantao'>Plantão</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='supervisao'>Supervisão<br />
                  Orientação</h4></td>
                <td>&nbsp;</td>
                <td align="center" valign="center" style="background:url(images/botoes_censo.png) no-repeat;"><h4 class='team' alt='transporte'>Transporte<br />
                  Escolar</h4></td>
              </tr>
            </table></td>
            <td width="20">&nbsp;</td>
            <td width="263" height="234" valign="top" style="background:url(images/fundo_descricao_equipe.png) no-repeat;">
            <!-- EDITAR A PARTIR DAQUI -->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='bolsa' class='div' style='diplay:block;'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>BOLSAS DE ESTUDOS</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='compras' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>COMPRAS</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='comunicacao' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>COMUNICAÇÃO</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='coordenacao' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>COORDENAÇÃO</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='diretor' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>DIRETOR DE DEPARTAMENTO</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='gerencia' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>GERÊNCIA</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
              </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='informatica' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>INFORMÁTICA</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div  id='merenda' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>MERENDA ESCOLAR</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='profissionais' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>PROFISSIONAIS CAPACITADOS</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
              </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='projetos' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>PROJETOS</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div  id='secretaria' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>SECRETARIA GERAL</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
             </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='pagamento' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>SETOR DE PAGAMENTO</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->

            <!-- INICIO TABELA EDITAVEL-->
            <div id='setores' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>SETORES</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->


            <!-- INICIO TABELA EDITAVEL-->
            <div id='setores' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>SETORES</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->


            <!-- INICIO TABELA EDITAVEL-->
            <div id='plantao' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>PLANTÃO</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->


            <!-- INICIO TABELA EDITAVEL-->
            <div id='supervisao' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>SUPERVISÃO ORIENTAÇÃO</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->


            <!-- INICIO TABELA EDITAVEL-->
            <div id='transporte' class='div'>
            <table width="263" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="65" style="padding-left:17px;padding-right:17px;"><h2>TRANSPORTE ESCOLAR</h2></td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:17px;padding-right:17px;"><h4>O setor responsável pelas bolsas de estudos atua em todos os níveis, desde a inscrição até a concessão da bolsa.
                  </h4>
                  <h4>O trabalho é feito em parceria com o
                    Departamento de Ação Social.</h4></td>
              </tr>
              <tr>
                <td style="padding-left:17px;padding-right:17px;"><h4>Responsável: <span style="color:#003F5F">Regiane Pasquali</span></h4></td>
              </tr>
              </table>
            </div>
            <!-- FIM TABELA EDITAVEL-->
<?php

    include_once '_inc.footer.php';

?>
