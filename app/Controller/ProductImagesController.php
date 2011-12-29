<?php
class ProductImagesController extends AppController
{

  public $name = 'ProductImages';

  /**
	 * Used components
	 *
	 */

  public $components = array(
    'Image',
    'Upload'
  );

  /**
	 * Used helpers
	 *
	 * @var array
	 * @access public
	 */
  public $helpers = array(
    'Form', 
    'Html', 
    'Functions'
  );

  /**
	 * Function for display the product images
	 *
	 */
  public function admin_index()
  {
    // Setting the layout for admin
    $this->layout = 'admin';
    $this->ProductImage->recursive = 0;
    $this->set('productImages', $this->paginate());
  }

  /**
	 * Function for add the product images
	 *
	 */
  public function admin_add()
  {
  // Setting the layout for admin
  $this->layout = 'admin';
  
  if (!empty($this->data))
  {
    $this->ProductImage->create();
    
    // set the upload destination folder
    $destination = realpath('img/small') . '/';
    $destination1 = realpath('img/big') . '/';
    
    // grab the file
    $file = $this->data['ProductImage']['file_data'];
    
    // upload the image using the upload component
    $result = $this->Upload->upload($file, $destination, null, array(
        'type' => 'resizecrop',
        'size' => array(
            THUMBNAIL_IMAGE_WIDTH,
            THUMBNAIL_IMAGE_HEIGHT
        ),
        'output' => 'jpg'
    ));
    
    // upload the image using the upload component
    $result = $this->Upload->upload($file, $destination1, null, array(
        'type' => 'resizecrop',
        'size' => array(
            DETAILS_IMAGE_WIDTH,
            DETAILS_IMAGE_HEIGHT
        ),
        'output' => 'jpg'
    ));
    
    $errors = $this->Upload->errors;

    if($errors)
    {
      // display error
      $errors = $this->Upload->errors;
       
      // piece together errors
      if(is_array($errors)){
        
        $errors = implode("<br />",$errors);
      }
       
      $this->Session->setFlash($errors);
    
      $this->redirect(array(
          'controller' => 'ProductImages',
          'action' => 'add',
          'admin' => true
      ));
      exit();
    }
    else
    {
      // setting the vlaues into array.
      $productImageArray['ProductImage'] = array(
          'product_id' => $this->data['ProductImage']['product_id'],
          'image_name' => $this->Upload->result
      );
    }

    if ((count($productImageArray['ProductImage']) > 0) &&
         $this->ProductImage->save($productImageArray))
      {
        $this->Session->setFlash(__('The product image has been saved', true));
        /* $this->redirect(array(
          'action' => 'index'
        )); */
        
        $lastInsertId = $this->ProductImage->id;
        
        $this->redirect(array(
            'controller' => 'ProductImages',
            'action' => 'edit/'.$lastInsertId,
            'admin' => true
        ));
        
      }
      else
      {
        $this->Session->setFlash(__('The product image could not be saved. Please, try again.', true));
      }
    }
    $products = $this->ProductImage->Product->find('list');
    $this->set(compact('products'));
    
  }

  //You do not need to alter these functions
  function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);
  
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    switch($imageType) {
      case "image/gif":
        $source=imagecreatefromgif($image);
        break;
      case "image/pjpeg":
      case "image/jpeg":
      case "image/jpg":
        $source=imagecreatefromjpeg($image);
        break;
      case "image/png":
      case "image/x-png":
        $source=imagecreatefrompng($image);
        break;
    }
    imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
    switch($imageType) {
      case "image/gif":
        imagegif($newImage,$thumb_image_name);
        break;
      case "image/pjpeg":
      case "image/jpeg":
      case "image/jpg":
        imagejpeg($newImage,$thumb_image_name,90);
        break;
      case "image/png":
      case "image/x-png":
        imagepng($newImage,$thumb_image_name);
        break;
    }
    chmod($thumb_image_name, 0777);
    return $thumb_image_name;
  }
  
  
  
      /**
	 * Function for edit the product images
	 *
	 */
  public function admin_edit($id = null)
  {
    // setting the layout for admin
    $this->layout = 'admin';
    
    $this->set('productImageId', $id);
    
    // if id not passing then redirecting
    if (!$id && empty($this->data))
    {
      $this->Session->setFlash(__('Invalid product image', true));
      $this->redirect(array(
          'action' => 'index'
      ));
    }


    if(isset($this->data['cropSubmit']) && ($this->data['cropSubmit'] == 'TRUE'))
    {

      $thumb_width = CROP_THUMBNAIL_WIDTH;	// Width of thumbnail image
      $thumb_height = CROP_THUMBNAIL_HEIGHT; // Height of thumbnail image
      
      $random_key   = rand(9999,999999);
      $thumb_image_prefix = "thumbnail_";

      $large_image_name  = $this->data['orgImageName'];

      $thumb_image_name = $thumb_image_prefix.$large_image_name;
      
      $large_image_location = 'img/big/'.$large_image_name;

      //$ext = trim(substr($large_image_name, strrpos($large_image_name, ".") + 1, strlen($large_image_name)));
      
      $thumb_image_location = 'img/crop_images/'.$thumb_image_name;
      
      //Get the new coordinates to crop the image.
      $x1 = $_POST["x1"];
      $y1 = $_POST["y1"];
      $x2 = $_POST["x2"];
      $y2 = $_POST["y2"];
      $w = $_POST["w"];
      $h = $_POST["h"];
      //Scale the image to the thumb_width set above
      $scale = $thumb_width/$w;
      $cropped = $this->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
      
      $this->Session->setFlash(__('Image has been cropped successfully', true));
      
      $this->redirect(array(
                'controller' => 'ProductImages',
                'action' => 'index',
                'admin' => true
            ));
    }
    else
    {
      
      if (!empty($this->data))
      {
      
        $this->ProductImage->create();
      
        $this->ProductImage->recursive = 0;
        $prodImageDetails = $this->ProductImage->findById($id);
        $prodImageName = $prodImageDetails['ProductImage']['image_name'];
      
        // initializing the array
        $productImageArray['ProductImage'] = array();
      
        if (isset($this->data['ProductImage']['file_data']['name']) &&
            !empty($this->data['ProductImage']['file_data']['name']))
        {
          // set the upload destination folder
          $destination = realpath('img/small') . '/';
          $destination1 = realpath('img/big') . '/';
      
          // grab the file
          $file = $this->data['ProductImage']['file_data'];
      
          // upload the image using the upload component
          $result = $this->Upload->upload($file, $destination, null, array(
              'type' => 'resizecrop',
              'size' => array(
                  THUMBNAIL_IMAGE_WIDTH,
                  THUMBNAIL_IMAGE_HEIGHT
              ),
              'output' => 'jpg'
          ));
      
          // upload the image using the upload component
          $result = $this->Upload->upload($file, $destination1, null, array(
              'type' => 'resizecrop',
              'size' => array(
                  DETAILS_IMAGE_WIDTH,
                  DETAILS_IMAGE_HEIGHT
              ),
              'output' => 'jpg'
          ));
      
          $errors = $this->Upload->errors;
      
          if($errors)
          {
            // display error
            $errors = $this->Upload->errors;
             
            // piece together errors
            if(is_array($errors)){
              $errors = implode("<br />",$errors);
            }
             
            $this->Session->setFlash($errors);
      
            $this->redirect(array(
                'controller' => 'ProductImages',
                'action' => 'edit/'.$id,
                'admin' => true
            ));
            exit();
          }
          else
          {
            // setting the vlaues into array.
            $productImageArray['ProductImage'] = array(
                'id' => $this->data['ProductImage']['id'],
                'product_id' => $this->data['ProductImage']['product_id'],
                'image_name' => $this->Upload->result
            );
          }
        }
        else
        {
          // setting the vlaues into array.
          $productImageArray['ProductImage'] = array(
              'id' => $this->data['ProductImage']['id'],
              'product_id' => $this->data['ProductImage']['product_id'],
              'image_name' => $prodImageName
          );
        }
      
        if ($this->ProductImage->save($productImageArray))
        {
          $this->Session->setFlash(__('The product image has been saved', true));
          $this->redirect(array(
              'action' => 'index'
          ));
        }
        else
        {
          $this->Session->setFlash(__('The product image could not be saved. Please, try again.', true));
        }
      }
      
    }
  
    if (empty($this->data))
    {
      $this->data = $this->ProductImage->read(null, $id);
    }
    
    $products = $this->ProductImage->Product->find('list');
    $this->set(compact('products'));

    }

      /**
    	 * Function for delete the product images
    	 *
    	 */
      public function admin_delete($id = null)
      {
        // setting the layout for admin
        $this->layout = 'admin';
        
        // if id not passing then redirecting
        if (!$id)
        {
          $this->Session->setFlash(__('Invalid id for product image', true));
          $this->redirect(array(
            'action' => 'index'
          ));
        }
        if ($this->ProductImage->delete($id))
        {
          $this->Session->setFlash(__('Product image deleted', true));
          $this->redirect(array(
            'action' => 'index'
          ));
        }
        $this->Session->setFlash(__('Product image was not deleted', true));
        $this->redirect(array(
          'action' => 'index'
        ));
      }
    
    }
        ?>