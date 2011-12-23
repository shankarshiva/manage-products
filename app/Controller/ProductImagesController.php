<?php
class ProductImagesController extends AppController {

	var $name = 'ProductImages';

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
	 * Function for display the product images
	 *
	 */
	function admin_index() 
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
	function admin_add() 
	{
		// Setting the layout for admin
		$this->layout = 'admin';
		
		if (!empty($this->data)) 
		{
			$this->ProductImage->create();
			
			// uploading the files using component
			$result = $this->Image->uploadFiles('img/small', 'img/big', $this->data['ProductImage']);
			
			// Initializing the array
			$productImageArray['ProductImage'] = array();
			
			if(isset($result['urls']) && !empty($result['urls']))
			{
				// setting the vlaues into array.
				$productImageArray['ProductImage'] = array(
					'product_id'=>$this->data['ProductImage']['product_id'],
					'image_name'=>$result['uploaded_filename']
				);
			}
		
			if((count($productImageArray['ProductImage']) > 0) && $this->ProductImage->save($productImageArray))
			{
				$this->Session->setFlash(__('The product image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The product image could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductImage->Product->find('list');
		$this->set(compact('products'));
	}

	/**
	 * Function for edit the product images
	 *
	 */
	function admin_edit($id = null) 
	{
		// setting the layout for admin
		$this->layout = 'admin';
		
		// if id not passing then redirecting
		if (!$id && empty($this->data)) 
		{
			$this->Session->setFlash(__('Invalid product image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) 
		{
			
			$this->ProductImage->create();
			
			$this->ProductImage->recursive = 0;
			$prodImageDetails = $this->ProductImage->findById($id);
			$prodImageName 		= $prodImageDetails['ProductImage']['image_name'];
			
			// initializing the array
			$productImageArray['ProductImage'] = array();
			
			if(isset($this->data['ProductImage']['image_name']['name'])
					&& !empty($this->data['ProductImage']['image_name']['name']))
			{
				// uploading images to server
				$result = $this->Image->uploadFiles('img/small', 'img/big', $this->data['ProductImage']);

				if(isset($result['urls']) && !empty($result['urls']))
				{
					// Deleting the images
					if(file_exists('img/small'.$prodImageName))
					{
						@unlink('img/small'.$prodImageName);
					}
					// Deleting the images
					if(file_exists('img/big'.$prodImageName))
					{
						@unlink('img/big'.$prodImageName);
					}
					
					// setting the vlaues into array.
					$productImageArray['ProductImage'] = array(
						'id' => $this->data['ProductImage']['id'],
						'product_id' => $this->data['ProductImage']['product_id'],
						'image_name' => $result['uploaded_filename']
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
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The product image could not be saved. Please, try again.', true));
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
	function admin_delete($id = null) 
	{
		// setting the layout for admin
		$this->layout = 'admin';
		
		//if id not passing then redirecting
		if (!$id) 
		{
			$this->Session->setFlash(__('Invalid id for product image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductImage->delete($id)) 
		{
			$this->Session->setFlash(__('Product image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product image was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>