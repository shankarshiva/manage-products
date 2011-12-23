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
      echo $this->Form->input('image_name', array('type'=>'file'));
  
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