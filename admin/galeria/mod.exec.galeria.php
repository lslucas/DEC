<?php
 if (isset($_FILES)) {

  include_once "_inc/class.upload.php";
   $sqlImagem = '';
   $w=$pos=0;


   $sql_smod = "SELECT gal_pos FROM ".TABLE_PREFIX."_galeria WHERE gal_obr_id=? ORDER BY gal_pos DESC LIMIT 1";
   $qry_smod = $conn->prepare($sql_smod);
   $qry_smod->bind_param('i',$res['obr_id']);
   $qry_smod->execute();
   $qry_smod->bind_result($pos);
   $qry_smod->fetch();
   $qry_smod->close();
   $pos = ($pos!==0)?$pos=$pos+1:$pos;



       $sql= "INSERT INTO ".TABLE_PREFIX."_galeria 

		    (gal_obr_id,
		     gal_imagem,
		     gal_pos
		     )
		    VALUES
		    (?,
		     ?,
		     ?)";
       $qry=$conn->prepare($sql);
       $qry->store_result();



   for ($i=0;$i<=count($_FILES);$i++) {


       if (isset($_FILES['galeria'.$i]['name']) && is_file($_FILES['galeria'.$i]['tmp_name']) ) {


	 $filename = $res['obr_id'].'_'.rand();
	 $handle = new Upload($_FILES['galeria'.$i]);

	 if ($handle->uploaded) {
	   $handle->file_new_name_body  = $filename;
	   $handle->Process($var['path_original']);
	   if (!$handle->processed) echo 'error : ' . $handle->error;

	   $handle->file_new_name_body  = $filename;
	   $handle->image_resize        = true;
	   $handle->image_ratio_crop    = true;
	   $handle->image_x             = $var['imagemWidth'];
	   $handle->image_y             = $var['imagemHeight'];
	   $handle->process($var['path_imagem']);
	   if (!$handle->processed) echo 'error : ' . $handle->error;

	   $handle->file_new_name_body  = $filename;
	   $handle->image_resize        = true;
	   $handle->image_ratio_crop    = true;
	   $handle->image_x             = $var['thumbWidth'];
	   $handle->image_y             = $var['thumbHeight'];
	   $handle->process($var['path_thumb']);
	   if (!$handle->processed) echo 'error : ' . $handle->error;


	     $imagem = $handle->file_dst_name;


	 $qry->bind_param('isi', $res['obr_id'],$imagem,$pos); 
	 $qry->execute();
         }
      }

    $pos++;
   }



   $qry->close();


 }
?>
