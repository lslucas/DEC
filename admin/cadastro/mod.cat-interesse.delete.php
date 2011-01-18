<?php

 $res['prefix'] = "r_${var['pre']}_cat-interesse";
 $res['pre']    = "rcint";
 $res['col']    = "rcint_cad_id";
 $res['table']  = TABLE_PREFIX."_".$res['prefix'];



 $sql_guarda = "SELECT ${res['pre']}_id id, ${res['col']} field FROM `${res['table']}` WHERE ${res['col']}=?";

 if(!($qry_guarda = $conn->prepare($sql_guarda))) {
   echo "ERRO: ".$conn->error;

 } else {


     $qry_guarda->bind_param('i',$item);
     $qry_guarda->execute();
     $qry_guarda->store_result();
     $num = $qry_guarda->num_rows();
     $qry_guarda->close();



     if(isset($_GET['verifica'])) {
      echo $num;


      } elseif ($num>0) {

         $sql_rem = "DELETE FROM `${res['table']}` WHERE ${res['col']}=?";
         $qry_rem = $conn->prepare($sql_rem);
         $qry_rem->bind_param('i', $item);
         $qry_rem->execute();


          if($qry_rem->affected_rows==1)
           echo "interesse apagado!<br>";
           elseif($qry_rem->affected_rows>1) echo $qry_rem->affected_rows." interesses apagados!<br>";

         $qry_rem->close();



     } else {
       echo "Não possui interesses.<br/>";
     }


  }
