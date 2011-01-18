<?php
 if (isset($_FILES)) {

  include_once "_inc/class.upload.php";
   $sqlvideo = '';
   $w=$pos=0;


    if (isset($_FILES['video']['name']) && is_file($_FILES['video']['tmp_name']) ) {

		 ini_set('post_max_size', '128M');
		 ini_set('upload_max_filesize', '128M');
		 ini_set('memory_limit', '128M');
		 


/**
 * A function for easily uploading files. This function will automatically generate a new 
 *        file name so that files are not overwritten.
 * Taken From: http://www.bin-co.com/php/scripts/upload_function/
 * Arguments:    $file_id- The name of the input field contianing the file.
 *                $folder    - The folder to which the file should be uploaded to - it must be writable. OPTIONAL
 *                $types    - A list of comma(,) seperated extensions that can be uploaded. If it is empty, anything goes OPTIONAL
 * Returns  : This is somewhat complicated - this function returns an array with two values...
 *                The first element is randomly generated filename to which the file was uploaded to.
 *                The second element is the status - if the upload failed, it will be 'Error : Cannot upload the file 'name.txt'.' or something like that
 */
    $file_id = 'video';
	$types      ='flv';
	$folder     = $var['path_video'].'/';

    $ext_arr = getExt(basename($_FILES[$file_id]['name']));
    $ext = $ext_arr; //Get the last extension
	
    $file_title = $res['item'].'_'.rand().'.'.$ext;
	$uploadfile = $folder.$file_title;

    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder don't exist.";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';
		echo $result;

    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            echo "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
        }
    }




				   $sql_vid = "UPDATE ".TABLE_PREFIX."_${var['table']} 
						   SET ${var['pre']}_video='${file_title}'
						   WHERE
								${var['pre']}_id=".$res['item'];
				   $qry_vid = $conn->query($sql_vid);


      }


 }
