<?php
/*
 * File: /app/controllers/components/image.php
 */
class ImageComponent extends Object
{

  function initialize(&$controller, $settings = array())
  {
    // saving the controller reference for later use
    $this->controller = & $controller;
  }

  function startup(&$controller)
  {
  }

  function beforeRender(&$controller)
  {
  }

  function shutdown(&$controller)
  {
  }

  function beforeRedirect(&$controller, $url, $status = null, $exit = true)
  {
  }

  /**
	 * uploads files to the server
	 * @params:
	 *      $folder     = the folder to upload the files e.g. 'img/files'
	 *      $formdata   = the array containing the form files
	 *      $itemId     = id of the item (optional) will create a new sub folder
	 * @return:
	 *      will return an array with the success of each file upload
	 */
  function uploadFiles($smallFolder, $bigFolder, $formdata, $itemId = null)
  {
    // setup dir names absolute and relative
    $smallFolderUrl = WWW_ROOT . $smallFolder;
    $bigFolderUrl = WWW_ROOT . $bigFolder;
    
    $rel_url = $smallFolder;
    
    // create the folder if it does not exist
    if (!is_dir($smallFolderUrl))
    {
      mkdir($smallFolderUrl);
    }
    if (!is_dir($bigFolderUrl))
    {
      mkdir($bigFolderUrl);
    }
    
    // list of permitted file types, this is only images but documents can be
    // added
    $permitted = array(
      'image/gif', 
      'image/jpeg', 
      'image/pjpeg', 
      'image/png',
      'images/x-png',
      'image/jpg'
    );
    
    // replace spaces with underscores
    $filename = str_replace(' ', '_', $formdata['image_name']['name']);
    // assume filetype is false
    $typeOK = false;
    // check filetype is ok
    foreach ( $permitted as $type )
    {
      if ($type == $formdata['image_name']['type'])
      {
        $typeOK = true;
        break;
      }
    }
    
    // if file type ok upload the file
    if ($typeOK)
    {
      // switch based on error code
      switch ($formdata['image_name']['error'])
      {
        case 0 :
          // check filename already exists
          if (!file_exists($smallFolder . '/' . $filename))
          {
            // create full filename
            $url = $rel_url . '/' . $filename;
            $fname = $filename;
            // upload the file
            
            $smalluploaddir = $smallFolder; // the /small/ directory for
                                            // thumbnails
            $biguploaddir = $bigFolder; // the /small/ directory for thumbnails
            $resizedfile = $smalluploaddir . '/' . $fname;
            $resizedBigfile = $biguploaddir . '/' . $fname;
            $smallImgScale = '100';
            $bigImgScale = '270';
            $tempFile = 'img/temp/' . $fname;
            $success = move_uploaded_file($formdata['image_name']['tmp_name'], $tempFile);
            $this->resize_img($tempFile, $bigImgScale, $resizedBigfile);
            $this->resize_img($tempFile, $smallImgScale, $resizedfile);
            unlink($tempFile);
          
          }
          else
          {
            // create unique filename and upload file
            ini_set('date.timezone', 'Europe/London');
            $now = date('Y-m-d-His');
            $fname = $now . $filename;
            $url = $rel_url . '/' . $fname;
            
            $smalluploaddir = $smallFolder; // the /small/ directory for
                                            // thumbnails
            $biguploaddir = $bigFolder; // the /small/ directory for thumbnails
            $resizedfile = $smalluploaddir . '/' . $fname;
            $resizedBigfile = $biguploaddir . '/' . $fname;
            $smallImgScale = '100';
            $bigImgScale = '270';
            $tempFile = 'img/temp/' . $fname;
            $success = move_uploaded_file($formdata['image_name']['tmp_name'], $tempFile);
            $this->resize_img($tempFile, $bigImgScale, $resizedBigfile);
            $this->resize_img($tempFile, $smallImgScale, $resizedfile);
            unlink($tempFile);
          
          }
          // if upload was successful
          if ($success)
          {
            // save the url of the file
            $result['urls'][] = $url;
            $result['uploaded_filename'] = $fname;
          }
          else
          {
            $result['errors'][] = "Error uploaded $filename. Please try again.";
          }
          break;
        case 3 :
          // an error occured
          $result['errors'][] = "Error uploading $filename. Please try again.";
          break;
        default :
          // an error occured
          $result['errors'][] = "System error uploading $filename. Contact webmaster.";
          break;
      }
    }
    elseif ($formdata['image_name']['error'] == 4)
    {
      // no file was selected for upload
      $result['nofiles'][] = "No file Selected";
    }
    else
    {
      // unacceptable file type
      $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
    }
    
    return $result;
  }

  function crop_img($imgname, $scale, $filename)
  {
    $filetype = $this->getFileExtension($imgname);
    $filetype = strtolower($filetype);
    
    switch ($filetype)
    {
      case "jpeg" :
      case "jpg" :
        $img_src = ImageCreateFromjpeg($imgname);
        break;
      case "gif" :
        $img_src = imagecreatefromgif($imgname);
        break;
      case "png" :
        $img_src = imagecreatefrompng($imgname);
        break;
    }
    
    $width = imagesx($img_src);
    $height = imagesy($img_src);
    $ratiox = $width / $height * $scale;
    $ratioy = $height / $width * $scale;
    
    // -- Calculate resampling
    $newheight = ($width <= $height) ? $ratioy : $scale;
    $newwidth = ($width <= $height) ? $scale : $ratiox;
    
    // -- Calculate cropping (division by zero)
    $cropx = ($newwidth - $scale != 0) ? ($newwidth - $scale) / 2 : 0;
    $cropy = ($newheight - $scale != 0) ? ($newheight - $scale) / 2 : 0;
    
    // -- Setup Resample & Crop buffers
    $resampled = imagecreatetruecolor($newwidth, $newheight);
    $cropped = imagecreatetruecolor($scale, $scale);
    
    // -- Resample
    imagecopyresampled($resampled, $img_src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    // -- Crop
    imagecopy($cropped, $resampled, 0, 0, $cropx, $cropy, $newwidth, $newheight);
    
    // Save the cropped image
    switch ($filetype)
    {
      case "jpeg" :
      case "jpg" :
        imagejpeg($cropped, $filename, 80);
        break;
      case "gif" :
        imagegif($cropped, $filename, 80);
        break;
      case "png" :
        imagepng($cropped, $filename, 80);
        break;
    }
  }

  function resize_img($imgname, $size, $filename)
  {
    $filetype = $this->getFileExtension($imgname);
    $filetype = strtolower($filetype);
    
    switch ($filetype)
    {
      case "jpeg" :
      case "jpg" :
        $img_src = ImageCreateFromjpeg($imgname);
        break;
      case "gif" :
        $img_src = imagecreatefromgif($imgname);
        break;
      case "png" :
        $img_src = imagecreatefrompng($imgname);
        break;
    }
    
    $true_width = imagesx($img_src);
    $true_height = imagesy($img_src);
    
    if ($true_width >= $true_height)
    {
      $width = $size;
      $height = ($width / $true_width) * $true_height;
    }
    else
    {
      $width = $size;
      $height = ($width / $true_width) * $true_height;
    }
    $img_des = ImageCreateTrueColor($width, $height);
    imagecopyresampled($img_des, $img_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);
    
    // Save the resized image
    switch ($filetype)
    {
      case "jpeg" :
      case "jpg" :
        imagejpeg($img_des, $filename, 80);
        break;
      case "gif" :
        imagegif($img_des, $filename, 80);
        break;
      case "png" :
        imagepng($img_des, $filename, 80);
        break;
    }
  }

  function getFileExtension($str)
  {
    $i = strrpos($str, ".");
    if (!$i)
    {
      return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
  }

}
?>