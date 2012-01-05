<?php
  echo $this->Html->script('image_crop/jquery-pack.js');
  echo $this->Html->script('image_crop/jquery.imgareaselect.min.js');
?>

<!-- Body Part Starts Here -->
<div class="bodyPart" >
<div class="pageHeading"><h1><?php echo __('Edit Profile'); ?></h1></div>
<table class="userRightPart" width="100%" cellspacing="10" cellpadding="5">
<tr>

<td width="50%" valign="top">
  <table class="userRightPart" width="100%" height="420" cellspacing="0" cellpadding="5" border="0">
    <tr>
      <td valign="top"> 
        <?php
        echo $this->Form->create('User', array('enctype'=>'multipart/form-data'));
        echo $this->Form->input('id');
        echo $this->Form->input('name', array('class'=>'inputText'));
        echo $this->Form->input('email_address', array('class'=>'inputText'));
        echo $this->Form->input('file_data', array('type'=>'file', 'class'=>'inputText'));
        
        $profileImage = '';
        if(isset($this->data['User']['profile_image']) && !empty($this->data['User']['profile_image']))
        {
          $profileImage = $this->data['User']['profile_image'];
        }
    
        // Checking if image is exist or not
        $displayImage = $this->Functions->checkImageAvailability('img/profile', $profileImage);
    
        ?>
        <div class="space20"></div>
        <div >
          <table  width="100%">
            <tr>
              <td>
              Original Image
              </td>
              <td>
              Cropped Image
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
              <?php
                echo $this->Html->image('profile/small/'.$displayImage, array('alt'=> '', 'border' => '0', 'class'=>'profileImage'));
              ?>
              </td>
              <td>
              <?php 
              $cropped_image = 'thumbnail_'.$profileImage;
              $displayCropImage = $this->Functions->checkImageAvailability('img/crop_images', $cropped_image);
              
              echo $this->Html->image('crop_images/'.$displayCropImage, array('alt'=> '', 'border' => '0', 'class'=>'profileImage'));
              ?>
              </td>
              <td valign="bottom" align="right"> <div class="submitButtonRight">   
            <?php
            echo $this->Form->input('Submit', array(
                'class' => 'frontBlackButton',
                'type' => 'submit',
                'label' => false
            ));
            ?>
            </div></td>
            </tr>
          </table>
        </div>
        <div class="space20"></div>
       
        <?php 
          echo $this->Form->end();
        ?>
      </td>
    </tr>
  </table>
</td>

<td width="50%" valign="top">
 <table class="userRightPart" width="100%" height="420"  cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
      <?php 
      $thumb_width = CROP_THUMBNAIL_WIDTH;	// Width of thumbnail image
      $thumb_height = CROP_THUMBNAIL_HEIGHT; // Height of thumbnail image
      
      $large_image_name = $displayImage;
      $large_image_location = 'img/profile/'.$large_image_name;
      ?>
      <div class="space20"></div>  
      <div>
        Do You Want To Crop the Image?
        <input type="submit" value="Yes" class="frontBlackButton" onclick="showCropSection(1);">
        <input type="submit" value="No" class="frontBlackButton" onclick="showCropSection(3);">
      </div>
      <div class="space20"></div>  
      <div style="display:none;" id="show_crop_section">
      <?php 
        echo $this->Html->image('profile/'.$large_image_name, array('alt'=> 'Create Thumbnail', 'border' => '0', 'class'=>'profileOrgImage', 'id'=>'thumbnail'));
      ?>
  		<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
  			<?php
          echo $this->Html->image('profile/'.$large_image_name, array('alt'=> 'Thumbnail Preview', 'border' => '0', 'class'=>'profileCropDemoImage', 'id'=>'thumbnail'));
        ?>
  		</div>
  		<br style="clear:both;"/>
  		<form name="thumbnail" action="/manage-products/Users/editProfile/<?php echo $this->data['User']['id']; ?>" method="post">
  			<input type="hidden" name="x1" value="" id="x1" />
  			<input type="hidden" name="y1" value="" id="y1" />
  			<input type="hidden" name="x2" value="" id="x2" />
  			<input type="hidden" name="y2" value="" id="y2" />
  			<input type="hidden" name="cropSubmit" value="TRUE" id="cropSubmit" />
  			<input type="hidden" name="orgImageName" value="<?php echo $large_image_name;?>" id="orgImageName" />
  			<br />
  			<strong>Selected Width:</strong> <input type="value" name="w" value="" id="w" size="5" style="width:10%" readonly />
  			<strong>Selected Height:</strong> <input type="value" name="h" value="" id="h" size="5" style="width:10%" readonly />
  			<input type="submit" name="upload_thumbnail" value="Crop Image" id="save_thumb" class="frontBlackButton" />
  		</form>
  	  </div>
  	  <div class="space20"></div>  
  	
      </td>
    </tr>
 </table>
</td>

</tr>
</table>
<div class="space10"></div>
</div>
<!-- Body Part  Ends Here -->        
<?php
  echo $this->Html->script('crop_image.js');
?>
