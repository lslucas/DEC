<?php
 if (isset($_FILES)) {

  include_once "_inc/class.upload.php";
   $sqlarquivo = '';
   $w=$pos=0;



   $sql_smod = "SELECT rla_pos FROM ".TABLE_PREFIX."_r_${var['pre']}_arquivo WHERE rla_${var['pre']}_id=? ORDER BY rla_pos DESC LIMIT 1";
   $qry_smod = $conn->prepare($sql_smod);
   $qry_smod->bind_param('i',$res['item']);
   $qry_smod->execute();
   $qry_smod->bind_result($pos);
   $qry_smod->fetch();
   $qry_smod->close();
   $pos = ($pos<>0)?$pos=$pos+1:$pos;



       $sql= "INSERT INTO ".TABLE_PREFIX."_r_${var['pre']}_arquivo 

		    (rla_${var['pre']}_id,
		     rla_arquivo,
		     rla_pos
		     )
		    VALUES
		    (?,
		     ?,
		     ?)";
       $qry=$conn->prepare($sql);
       $qry->store_result();


 for ($i=0;$i<=count($_FILES);$i++) {


   if (isset($_FILES['arquivo'.$i]['name']) && is_file($_FILES['arquivo'.$i]['tmp_name']) ) {


     $filename = slugify($_FILES['arquivo'.$i]['name']).'-'.substr(rand(),0,3);
     $handle = new Upload($_FILES['arquivo'.$i]);


     if ($handle->uploaded) {
       $handle->file_new_name_body  = $filename;
       $handle->Process($var['path_arquivo']);
       if (!$handle->processed) echo 'error : ' . $handle->error;


         $arquivo = $handle->file_dst_name;


     $qry->bind_param('isi', $res['item'], $arquivo,$pos);
     $qry->execute();
     }


    }

      $pos++;
 }



   $qry->close();


 }
