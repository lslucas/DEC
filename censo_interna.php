<?php
   /*
    *cabeçalho para funcoes,variaveis e conexao com a base
    */
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';

    /*
     *query das censo escolar
     */
   $year = (int) $_GET['ano'];
   $sql_censo = "SELECT cen_ano, 
     cen_estadual_creche, 
     cen_estadual_preescolar, 
     cen_estadual_fundamental, 
     cen_estadual_especial, 
     cen_estadual_eja, 
     cen_estadual_medio, 
     cen_municipal_creche, 
     cen_municipal_preescolar, 
     cen_municipal_fundamental, 
     cen_municipal_especial, 
     cen_municipal_eja, 
     cen_municipal_medio, 
     cen_particular_creche, 
     cen_particular_preescolar, 
     cen_particular_fundamental, 
     cen_particular_especial, 
     cen_particular_eja, 
     cen_particular_medio

     FROM ".TABLE_PREFIX."_censo

                      WHERE cen_ano IS NOT NULL
                            AND cen_status=1
                            AND cen_ano=?
               ";

    if(!$qry_censo= $conn->prepare($sql_censo)) {
      echo $conn->error;

    } else {

      $qry_censo->bind_param('i', $year);
      $qry_censo->execute();
      $qry_censo->bind_result($ano, $est_creche, $est_preescolar, $est_fundamental, $est_especial, $est_eja, $est_medio, $mun_creche, $mun_preescolar, $mun_fundamental, $mun_especial, $mun_eja, $mun_medio, $part_creche, $part_preescolar, $part_fundamental, $part_especial, $part_eja, $part_medio);
      $qry_censo->fetch();




      include_once '_inc.header.php';
?>
        <h1>CENSO ESCOLARES</h1></td>
          </tr>
          <tr>
            <td><h4>O CensoEscolar é um levantamento de dados estatístico-educacionais de âmbito nacional realizado todos os anos e coordenado pelo Inep. Ele é feito com a colaboração das secretárias estaduais e municipais de Educação e com a participação de todas as escolas públicas e privadas do país.</h4></td>
          </tr>
          <tr>
            <td><table style="background:url(images/banner.png) no-repeat" width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="184" align="center" valign="middle"><img src="images/banner_censoescolar.png" width="691" height="174" /></td>
              </tr>
              <tr>
                <td height="28" style="height:28;" align="right" valign="middle" ><h5>Censo Escolares</h5></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="26"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td><h2>CENSO ESCOLAR ANO DE <?=$ano?></h2></td>
          </tr>
          <tr>
            <td height="161" align="left" valign="top" style="background:url(images/fundo_borda.png) no-repeat">


 <table border="1" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
      <td colspan="7" valign="top" width="876"><p align="center"><strong><?=$ano?></strong></p></td>
      </tr>
      <tr>
        <td rowspan="2" valign="top" width="125"><p> </p></td>
        <td colspan="2" valign="top" width="250"><p align="center"><strong>Educação    Infantil</strong></p></td>
        <td rowspan="2" valign="top" width="125"><p align="center"><strong>Ensino    Fundamental</strong></p></td>
        <td rowspan="2" valign="top" width="125"><p align="center"><strong>Ed. Especial</strong></p></td>
        <td rowspan="2" valign="top" width="125"><p align="center"><strong>EJA( EF – EM)</strong></p></td>
        <td rowspan="2" valign="top" width="125"><p align="center"><strong>Ensino Médio</strong></p></td>
      </tr>
      <tr>
        <td valign="top" width="125"><p><strong>Creche</strong></p></td>
        <td valign="top" width="125"><p><strong>Pré-Escola</strong></p></td>
      </tr>
      <tr>
        <td valign="top" width="125"><p>Total</p></td>
        <td valign="top" width="125"><p><?=$est_creche+$mun_creche+$part_creche?></p></td>
        <td valign="top" width="125"><p><?=$est_preescolar+$mun_preescolar+$part_preescolar?></p></td>
        <td valign="top" width="125"><p><?=$est_fundamental+$mun_fundamental+$part_fundamental?></p></td>
        <td valign="top" width="125"><p><?=$est_especial+$mun_especial+$part_especial?></p></td>
        <td valign="top" width="125"><p><?=$est_eja+$mun_eja+$part_eja?></p></td>
        <td valign="top" width="125"><p><?=$est_medio+$mun_medio+$part_medio?></p></td>
      </tr>
      <tr>
        <td valign="top" width="125"><p>Rede Estadual</p></td>
        <td valign="top" width="125"><p><?=$est_creche?></p></td>
        <td valign="top" width="125"><p><?=$est_preescolar?></p></td>
        <td valign="top" width="125"><p><?=$est_fundamental?></p></td>
        <td valign="top" width="125"><p><?=$est_especial?></p></td>
        <td valign="top" width="125"><p><?=$est_eja?></p></td>
        <td valign="top" width="125"><p><?=$est_medio?></p></td>
      </tr>
      <tr>
        <td valign="top" width="125"><p>Rede Municipal</p></td>
        <td valign="top" width="125"><p><?=$mun_creche?></p></td>
        <td valign="top" width="125"><p><?=$mun_preescolar?></p></td>
        <td valign="top" width="125"><p><?=$mun_fundamental?></p></td>
        <td valign="top" width="125"><p><?=$mun_especial?></p></td>
        <td valign="top" width="125"><p><?=$mun_eja?></p></td>
        <td valign="top" width="125"><p><?=$mun_medio?></p></td>
      </tr>
      <tr>
        <td valign="top" width="125"><p>Rede Particular</p></td>
        <td valign="top" width="125"><p><?=$part_creche?></p></td>
        <td valign="top" width="125"><p><?=$part_preescolar?></p></td>
        <td valign="top" width="125"><p><?=$part_fundamental?></p></td>
        <td valign="top" width="125"><p><?=$part_especial?></p></td>
        <td valign="top" width="125"><p><?=$part_eja?></p></td>
        <td valign="top" width="125"><p><?=$part_medio?></p></td>
      </tr>
      <tr>
        <td colspan="5" valign="top" width="626">
          <div align="left">Total geral do município</div></td>
          <td colspan="2" valign="top" width="250"><p><strong><?=$est_creche+$mun_creche+$part_creche+$est_preescolar+$mun_preescolar+$part_preescolar+$est_fundamental+$mun_fundamental+$part_fundamental+$est_especial+$mun_especial+$part_especial+$est_eja+$mun_eja+$part_eja+$est_medio+$mun_medio+$part_medio?></strong></p></td>
      </tr>
    </tbody>
  </table>

  <p align=right><a href="censo.php"><img src="images/btnVoltar.png" border="0" /></a></p>
<?php

    }
    include_once '_inc.footer.php';

?>
