<div class="categories form">
  <?php 
    echo $this->Form->create('Category',array('enctype'=>'multipart/form-data'));
  ?>
  <fieldset>
    <legend>
      <?php 
        echo __('Edit Category'); 
      ?>
    </legend>
    <?php
      echo $this->Form->input('id');
      echo $this->Form->input('category_name');
      echo $this->Form->input('image_name', array('type'=>'file'));
   
      $categoryImage = '';
      $categoryName  = '';
      if(isset($this->data['Category']['category_image']) && !empty($this->data['Category']['category_image']))
      {
        $categoryImage = $this->data['Category']['category_image'];
        $categoryName  = $this->data['Category']['category_name'];
      }
      // Checking if image is exist or not
      $displayImage = $this->Functions->checkImageAvailability('img/small', $categoryImage);
    ?>
    <div>
    <?php
      echo $this->Html->image('small/'.$displayImage, array('alt'=> $categoryName, 'border' => '0'));
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
        echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Category.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Category.id'))); 
      ?>
    </li>
    <li>
      <?php 
        echo $this->Html->link(__('List Categories', true), array('action' => 'index'));
      ?>
    </li>
  </ul>
</div>
