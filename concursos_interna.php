<?php
   $rp = './admin/';
   include_once $rp.'_inc/global.php';
   require_once $rp.'_inc/db.php';
   include_once $rp.'_inc/global_function.php';



    /*
     *query das notícias
     */
    $item = (int) $_GET['item'];
    $sql_conc = "SELECT conc_id, conc_titulo, 
                        DATE_FORMAT(conc_data, '%d/%m/%Y') data, 
                        DATE_FORMAT(conc_data_prova, '%d/%m/%Y') data_prova, 
                        DATE_FORMAT(conc_data_resultado, '%d/%m/%Y') data_resultado, 
                        DATE_FORMAT(conc_data_validade, '%d/%m/%Y') data_validade, 
                        conc_texto,
                        conc_inscricao
                  FROM ".TABLE_PREFIX."_concurso

                      WHERE conc_titulo IS NOT NULL
                            AND conc_status=1
                            AND conc_id={$item}";
    if(!$qry_conc= $conn->prepare($sql_conc)) {
      echo $conn->error;

    } else {

      $qry_conc->execute();
      $qry_conc->bind_result($item, $titulo, $data, $data_prova, $data_resultado, $data_validade, $texto, $inscricao);
      $qry_conc->store_result();
      $qry_conc->fetch();


      include_once '_inc.header.php';


?>
          <h1>CONCURSOS</h1></td>
          </tr>
          <tr>
            <td><h2><?=$data?>: <?=$titulo?></h2>
              <?php if(!empty($data_prova)) {?>
              <b>Data da prova:</b> <?=$data_prova?>
              <?php } ?>
              <?php if(!empty($data_resultado)) {?>
              <br/><b>Resultado:</b> <?=$data_resultado?>
              <?php } ?>
              <?php if(!empty($data_validade)) {?>
              <br/><b>Validade:</b> <?=$data_validade?>
              <?php } ?>

              <?php if(!empty($inscricao)) {?>
              <p><div class='titulo'>Inscrições</div><?=$inscricao?></p>
              <?php } ?>
              <?php if(!empty($texto)) {?>
              <p><div class='titulo'>Descrição</div> <?=$texto?></p>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><a href="concursos.php"><img src="images/voltarparanoticias.png" width="130" height="31" border="0" /></a>
<?php

      $qry_conc->close();

    }

    include_once '_inc.footer.php';

?>
