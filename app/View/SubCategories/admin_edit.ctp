<div class="subCategories form">
  <?php 
    echo $this->Form->create('SubCategory', array('enctype'=>'multipart/form-data'));
  ?>
  <fieldset>
    <legend>
      <?php 
        echo __('Admin Edit Sub Category'); 
      ?>
    </legend>
    <?php
      echo $this->Form->input('id');
      echo $this->Form->input('category_id');
      echo $this->Form->input('sub_category_name');
      echo $this->Form->input('image_name', array('type'=>'file'));
      
      $subCategoryImage = '';
      $subCategoryName  = '';
      if(isset($this->data['SubCategory']['sub_image_name']) && !empty($this->data['SubCategory']['sub_image_name']))
      {
        $subCategoryImage = $this->data['SubCategory']['sub_image_name'];
        $subCategoryName  = $this->data['SubCategory']['sub_category_name'];
      }
      
      // Checking if image is exist or not
      $displayImage = $this->Functions->checkImageAvailability('img/small', $subCategoryImage);
    ?>
    <div>
    <?php
      echo $this->Html->image('small/'.$displayImage, array('alt'=> $subCategoryName, 'border' => '0'));
    ?>
    </div>
  </fieldset>
  <?php 
    echo $this->Form->end(__('Submit', true));
  ?>
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
        echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SubCategory.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SubCategory.id'))); 
      ?>
    </li>
    <li>
      <?php 
        echo $this->Html->link(__('List Sub Categories', true), array('action' => 'index'));
      ?>
    </li>
  </ul>
</div>