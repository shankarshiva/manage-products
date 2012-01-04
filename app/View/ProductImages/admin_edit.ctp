<?php
  echo $this->Html->script('image_crop/jquery-pack.js');
  echo $this->Html->script('image_crop/jquery.imgareaselect.min.js');
?>

<div class="productImages form">
  <?php 
    echo $this->Form->create('ProductImage', array('enctype'=>'multipart/form-data'));
  ?>
  <fieldset>
    <legend>
      <?php 
        echo __('Admin Edit Product Image'); 
      ?>
    </legend>
    <?php
    
      echo $this->Form->input('id');
      echo $this->Form->input('product_id');
      echo $this->Form->input('file_data', array('type'=>'file'));
  
      $productImage = '';
      $productName = '';
      if(isset($this->data['ProductImage']['image_name']) && !empty($this->data['ProductImage']['image_name']))
      {
        $productImage = $this->data['ProductImage']['image_name'];
        $productName  = $this->data['Product']['product_name'];
      }
      // Checking if image is exist or not
      $displayImage = $this->Functions->checkImageAvailability('img/small', $productImage);
    ?>
    <div>
    <?php
      echo $this->Html->image('small/'.$displayImage, array('alt'=> $productName, 'border' => '0'));
    ?>
    </div>
  </fieldset>
  <?php 
    echo $this->Form->end(__('Submit', true));
  ?>
  <hr />
  
  <?php

  $large_image_name = $productImage;
  
  $thumb_width = CROP_THUMBNAIL_WIDTH;	// Width of thumbnail image
  $thumb_height = CROP_THUMBNAIL_HEIGHT; // Height of thumbnail image
  
  $existImagePath = "img/big/";
  $large_image_location = $existImagePath.$large_image_name;

  $current_large_image_width = $this->Functions->getWidth($large_image_location);
  $current_large_image_height = $this->Functions->getHeight($large_image_location);

  ?>
  <div>
    Do You Want To Crop the Image?
    <input type="submit" value="Yes" class="black_button" onclick="showCropSection(1);">
    <input type="submit" value="No" class="black_button" onclick="showCropSection(2);">
  </div>
  
  <div align="center" style="display:none;" id="show_crop_section">
    <?php 
      echo $this->Html->image('big/'.$large_image_name, array('alt'=> 'Create Thumbnail', 'border' => '0','style'=>'float: left; margin-right: 10px;', 'id'=>'thumbnail'));
    ?>
		<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
			<?php
        echo $this->Html->image('big/'.$large_image_name, array('alt'=> 'Thumbnail Preview', 'border' => '0','style'=>'position: relative;', 'id'=>'thumbnail'));
      ?>
		</div>
		<br style="clear:both;"/>
		<form name="thumbnail" action="/manage-products/admin/ProductImages/edit/<?php echo $productImageId; ?>" method="post">
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<input type="hidden" name="cropSubmit" value="TRUE" id="cropSubmit" />
			<input type="hidden" name="orgImageName" value="<?php echo $large_image_name;?>" id="orgImageName" />
			<br />
			<strong>Selected Width:</strong> <input type="value" name="w" value="" id="w" size="5" style="width:10%" readonly />
			<strong>Selected Height:</strong> <input type="value" name="h" value="" id="h" size="5" style="width:10%" readonly />
			<input type="submit" name="upload_thumbnail" value="Crop Image" id="save_thumb"  />
		</form>
	</div>
  
</div>
<div class="actions">
  <h3>
    <?php 
      echo __('Actions'); 
    ?>
  </h3>
  <ul>
    <li>
      <?php 
        echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ProductImage.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ProductImage.id'))); 
      ?>
    </li>
    <li>
      <?php 
        echo $this->Html->link(__('List Product Images', true), array('action' => 'index'));
      ?>
    </li>
  </ul>
</div>

<?php
  echo $this->Html->script('crop_image.js');
?>
