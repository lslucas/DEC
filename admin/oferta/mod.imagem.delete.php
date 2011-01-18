<?php

 $res['prefix'] = "r_${var['pre']}_imagem";
 $res['pre']    = "roi";
 $res['col']    = "roi_imagem";
 $res['table']  = TABLE_PREFIX."_".$res['prefix'];

  /*
   *pastas
   */
  /*
   *$var['path'] = 'oferta';
   *$var['path_imagem']   = PATH_IMG.'/'.$var['path'];
   *$var['path_original'] = PATH_IMG.'/'.$var['path'].'/original';
   *$var['path_thumb']    = PATH_IMG.'/'.$var['path'].'/thumb';
   *$res['folder'] = $var['path_imagem'].','.$var['path_original'].','.$var['path_thumb'];
   */
   $res['folder'] = $var['imagem_folderlist'];


 $sql_guarda = "SELECT ${res['pre']}_id id, ${res['col']} field FROM `${res['table']}` WHERE ${res['col']}=?";

 if(!($qry_guarda = $conn->prepare($sql_guarda))) {
   echo "ERRO: ".$conn->error;

 } else {


     $qry_guarda->bind_param('i',$item);
     $qry_guarda->execute();
     $qry_guarda->bind_result($id, $field);
     $qry_guarda->store_result();
     $num = $qry_guarda->num_rows();


         $row_id=$row_field='';
         while($qry_guarda->fetch()) {
          $row_id    .= $id.',';
          $row_field .= $field.',';
         }

        $row_id=substr($row_id,0,-1);
        $row['id'] = explode(',',$row_id);

        $row_field=substr($row_field,0,-1);
        $row['field'] = explode(',',$row_field);



     $qry_guarda->close();



     if(isset($_GET['verifica'])) {
      echo $num;


      } elseif ($num>0) {

         $sql_rem = "DELETE FROM `${res['table']}` WHERE ${res['col']}=?";
         $qry_rem = $conn->prepare($sql_rem);
         $qry_rem->bind_param('i', $item);
         $qry_rem->execute();




           for($i=0;$i<count($row['id']);$i++) {
            if (!empty($row['id'][$i])) {

             $arq = $row['field'][$i];
             $folder = explode(',',$res['folder']);


                 for($j=0;$j<count($folder);$j++) {
                  $arquivo = $folder[$j].'/'.$arq;

                    if (!empty($folder[$j]) && is_file($arquivo)) {
                     unlink($arquivo);
                    }

                 }


            }
           }




          if($qry_rem->affected_rows==1)
           echo "imagem apagada!<br>";
           elseif($qry_rem->affected_rows>1) echo $qry_rem->affected_rows." imagens apagadas!<br>";

         $qry_rem->close();



     } else {
       echo "Não possui imagens.<br/>";
     }


  }
