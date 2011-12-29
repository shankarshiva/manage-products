<?php

/**
 * functions helper library.
 *
 *
 * @package       Cake.View.Helper
 * @property      FunctionsHelper $Html
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html
 */
class FunctionsHelper extends AppHelper 
{

	/**
	 * Function fo checking if the image is exist in required folder or not.
	 */
	public function checkImageAvailability($folder, $image)
	{
		$imgpath = WWW_ROOT.$folder.'/'.$image;

		if(!empty($image))
		{
			if(file_exists($imgpath))
			{
				$productImage = $image;
			}
			else
			{
				$productImage = 'no-image-100.jpg';
			}
		}
		else
		{
			$productImage = 'no-image-100.jpg';
		}
		
		return $productImage;
		
	}
	
	// Fucntions
	//You do not need to alter these functions
	function getHeight($image) {
	  $size = getimagesize($image);
	  $height = $size[1];
	  return $height;
	}
	//You do not need to alter these functions
	function getWidth($image) {
	  $size = getimagesize($image);
	  $width = $size[0];
	  return $width;
	}
	
}
