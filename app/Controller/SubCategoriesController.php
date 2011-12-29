<?php
class SubCategoriesController extends AppController 
{

	public $name = 'SubCategories';

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
	 * Function for display the sub categories
	 *
	 */
	public function admin_index() 
	{
		// Setting the layout for admin
		$this->layout = 'admin';
		$this->SubCategory->recursive = 0;
		$this->set('subCategories', $this->paginate());
	}

	/**
	 * Function for add the sub categories
	 *
	 */
	public function admin_add() 
	{
		// Setting the layout for admin
		$this->layout = 'admin';
		if (!empty($this->data)) 
		{
			$this->SubCategory->create();
			
			
			// set the upload destination folder
			$destination = realpath('img/small') . '/';
			$destination1 = realpath('img/big') . '/';
			
			// grab the file
			$file = $this->data['SubCategory']['file_data'];
			
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
			      'controller' => 'SubCategories',
			      'action' => 'add',
			      'admin' => true
			  ));
			  exit();
			}
			else
			{
			  $subCategoeryArray['SubCategory'] = array();
			  // setting the vlaues into array.
			  $subCategoeryArray['SubCategory'] = array(
					'category_id'=>$this->data['SubCategory']['category_id'],
					'sub_category_name'=>$this->data['SubCategory']['sub_category_name'],
					'sub_image_name'=>$this->Upload->result
				);
			}
	
			if((count($subCategoeryArray['SubCategory']) > 0) && $this->SubCategory->save($subCategoeryArray))
			{
				$this->Session->setFlash(__('The sub category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The sub category could not be saved. Please, try again.', true));
			}
		}

		$categories = $this->SubCategory->Category->find('list');
		$this->set(compact('categories'));
	}

	/**
	 * Function for edit the sub categories
	 *
	 */
	public function admin_edit($id = null) 
	{
		// Setting the layout for admin
		$this->layout = 'admin';
		
		// if id not passing then redirecting
		if (!$id && empty($this->data)) 
		{
			$this->Session->setFlash(__('Invalid sub category', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) 
		{
			$this->SubCategory->recursive = 0;
			$subCategoryDetails = $this->SubCategory->findById($id);
			$subCategoryImageName = $subCategoryDetails['SubCategory']['sub_image_name'];

			// initializing the array
			$subCategoeryArray['SubCategory'] = array();
			
			if(isset($this->data['SubCategory']['file_data']['name'])
					&& !empty($this->data['SubCategory']['file_data']['name']))
			{
			  // set the upload destination folder
			  $destination = realpath('img/small') . '/';
			  $destination1 = realpath('img/big') . '/';
			  	
			  // grab the file
			  $file = $this->data['SubCategory']['file_data'];		  
			  
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
			        'controller' => 'SubCategories',
			        'action' => 'edit/'.$id,
			        'admin' => true
			    ));
			    exit();
			  }
			  else
			  {
			    // setting the vlaues into array.
			    $subCategoeryArray['SubCategory'] = array(
						'id' => $this->data['SubCategory']['id'],
						'category_id' => $this->data['SubCategory']['category_id'],
						'sub_category_name' => $this->data['SubCategory']['sub_category_name'],
						'sub_image_name' => $this->Upload->result
					);
			  }
			}
			else  
			{
				// setting the values into array
				$subCategoeryArray['SubCategory'] = array(
					'id' => $this->data['SubCategory']['id'],
					'category_id' => $this->data['SubCategory']['category_id'],
					'sub_category_name' => $this->data['SubCategory']['sub_category_name'],
					'sub_image_name' => $subCategoryImageName
				);
			}
		
			if ($this->SubCategory->save($subCategoeryArray)) 
			{
				$this->Session->setFlash(__('The sub category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The sub category could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) 
		{
			$this->data = $this->SubCategory->read(null, $id);
		}
		
		$categories = $this->SubCategory->Category->find('list');
		
		$this->set(compact('categories'));
		
	}

	/**
	 * Function for delete the sub categories
	 *
	 */
	public function admin_delete($id = null) 
	{
		// Setting the layout for admin
		$this->layout = 'admin';
		
		// if id not passing then redirecting
		if (!$id) 
		{
			$this->Session->setFlash(__('Invalid id for sub category', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->SubCategory->delete($id)) 
		{
			$this->Session->setFlash(__('Sub category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->Session->setFlash(__('Sub category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>