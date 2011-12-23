<?php
class SubCategoriesController extends AppController 
{

	var $name = 'SubCategories';

	/**
	 * Used components
	 *
	 */
	
	var $components = array(
			'Image'
	);
	
	/**
	 * Used helpers
	 *
	 * @var array
	 * @access public
	 */
	var $helpers = array(
			'Form',
			'Html',
			'Functions'
	);
	
	/**
	 * Function for display the sub categories
	 *
	 */
	function admin_index() 
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
	function admin_add() 
	{
		// Setting the layout for admin
		$this->layout = 'admin';
		if (!empty($this->data)) 
		{
			$this->SubCategory->create();
			
			//  uploading the files to server
			$result = $this->Image->uploadFiles('img/small', 'img/big', $this->data['SubCategory']);
			
			// initializing the array
			$subCategoeryArray['SubCategory'] = array();
			
			if(isset($result['urls']) && !empty($result['urls']))
			{
				// setting the values into array
				$subCategoeryArray['SubCategory'] = array(
					'category_id'=>$this->data['SubCategory']['category_id'],
					'sub_category_name'=>$this->data['SubCategory']['sub_category_name'],
					'sub_image_name'=>$result['uploaded_filename']
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
	function admin_edit($id = null) 
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
			
			if(isset($this->data['SubCategory']['image_name']['name'])
					&& !empty($this->data['SubCategory']['image_name']['name']))
			{
				$result = $this->Image->uploadFiles('img/small', 'img/big', $this->data['SubCategory']);
			
				if(isset($result['urls']) && !empty($result['urls']))
				{
					// Deleting the images
					if(file_exists('img/small'.$subCategoryImageName))
					{
						@unlink('img/small'.$subCategoryImageName);
					}
					// Deleting the images
					if(file_exists('img/big'.$subCategoryImageName))
					{
						@unlink('img/big'.$subCategoryImageName);
					}
					// setting the values into array
					$subCategoeryArray['SubCategory'] = array(
						'id' => $this->data['SubCategory']['id'],
						'category_id' => $this->data['SubCategory']['category_id'],
						'sub_category_name' => $this->data['SubCategory']['sub_category_name'],
						'sub_image_name' => $result['uploaded_filename']
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
	function admin_delete($id = null) 
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