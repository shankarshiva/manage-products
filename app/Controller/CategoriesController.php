<?php
class CategoriesController extends AppController
{

  //var $name = 'Categories';

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

  public $uses = array(
      'Category',
      'User'
  );
  
  
  /**
	 * Function for categories display
	 *
	 */
  public function admin_index()
  {

    //$this->adminCheckLogin();
    // setting the layout for admin
    $this->layout = 'admin';
    
    $this->Category->recursive = 0;
    $this->set('categories', $this->paginate());
  }

  /**
	 * Function for adding the categories
	 *
	 */
  public function admin_add()
  {
  // setting the layout for admin
  $this->layout = 'admin';
  
  if (!empty($this->data))
  {
    $this->Category->create();
    
    // set the upload destination folder
    $destination = realpath('img/small') . '/';
    $destination1 = realpath('img/big') . '/';
    	
    // grab the file
    $file = $this->data['Category']['file_data'];
    
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
          'controller' => 'Categories',
          'action' => 'add',
          'admin' => true
      ));
      exit();
    }
    else
    {
      $categoeryArray['Category'] = array();
      // setting the vlaues into array.
       $categoeryArray['Category'] = array(
        'category_name' => $this->data['Category']['category_name'], 
        'category_image' => $this->Upload->result
      );
    }

    if ((count($categoeryArray['Category']) > 0) &&
         $this->Category->save($categoeryArray))
        {
          $this->Session->setFlash(__('The category has been saved', true));
          $this->redirect(array(
            'action' => 'index'
          ));
        }
        else
        {
          $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
        }
      }
    }

   /**
	 * Function for edit the categories
	 *
	 */
  public function admin_edit($id = null)
  {
  // setting the layout for admin
  $this->layout = 'admin';
  
  // if id not passing then redirecting
  if (!$id && empty($this->data))
  {
    $this->Session->setFlash(__('Invalid category', true));
    $this->redirect(array(
      'action' => 'index'
    ));
  }
  
  if (!empty($this->data))
  {
    
    $this->Category->recursive = 0;
    $categoryDetails = $this->Category->findById($id);
    $categoryImageName = $categoryDetails['Category']['category_image'];
    
    // initialising the array.
    $categoeryArray['Category'] = array();
    
    if (isset($this->data['Category']['file_data']['name']) &&
         !empty($this->data['Category']['file_data']['name']))
        {

          // set the upload destination folder
          $destination = realpath('img/small') . '/';
          $destination1 = realpath('img/big') . '/';
           
          // grab the file
          $file = $this->data['Category']['file_data'];
          
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
                'controller' => 'Categories',
                'action' => 'edit/'.$id,
                'admin' => true
            ));
            exit();
          }
          else
          {
            $categoeryArray['Category'] = array();
            // setting the vlaues into array.
            $categoeryArray['Category'] = array(
                'id' => $this->data['Category']['id'],
                'category_name' => $this->data['Category']['category_name'],
                'category_image' => $this->Upload->result
            );
          }
          
          
         /*  // uploading the files using component
          $result = $this->Image->uploadFiles('img/small', 'img/big', $this->data['Category']);
          
          if (isset($result['urls']) && !empty($result['urls']))
          {
            // Deleting the images
            if (file_exists('img/small' . $categoryImageName))
            {
              @unlink('img/small' . $categoryImageName);
            }
            
            // Deleting the images
            if (file_exists('img/big' . $categoryImageName))
            {
              @unlink('img/big' . $categoryImageName);
            }
            
            // setting the values into array
            $categoeryArray['Category'] = array(
              'id' => $this->data['Category']['id'], 
              'category_name' => $this->data['Category']['category_name'], 
              'category_image' => $result['uploaded_filename']
            );
          } */
        }
        else
        {
          // setting the values into array
          $categoeryArray['Category'] = array(
            'id' => $this->data['Category']['id'], 
            'category_name' => $this->data['Category']['category_name'], 
            'category_image' => $categoryImageName
          );
        }
        
        if ($this->Category->save($categoeryArray))
        {
          $this->Session->setFlash(__('The category has been saved', true));
          $this->redirect(array(
            'action' => 'index'
          ));
        }
        else
        {
          $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
        }
      }
      
      if (empty($this->data))
      {
        $this->data = $this->Category->read(null, $id);
      }
    
    }

   /**
	 * Function for delete the categories
	 *
	 */
   public function admin_delete($id = null)
    {
      
      $this->layout = 'admin';
      
      if (!$id)
      {
        $this->Session->setFlash(__('Invalid id for category', true));
        $this->redirect(array(
          'action' => 'index'
        ));
      }
      if ($this->Category->delete($id))
      {
        $this->Session->setFlash(__('Category deleted', true));
        $this->redirect(array(
          'action' => 'index'
        ));
      }
      $this->Session->setFlash(__('Category was not deleted', true));
      $this->redirect(array(
        'action' => 'index'
      ));
    }
  
  }
        ?>