<div class="productImages form">
  <?php 
    echo $this->Form->create('ProductImage', array('enctype'=>'multipart/form-data'));
  ?>
  <fieldset>
    <legend>
      <?php 
        echo __('Admin Add Product Image'); 
      ?>
    </legend>
    <?php
      echo $this->Form->input('product_id');
      echo $this->Form->input('file_data', array('type'=>'file'));
    ?>
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
        echo $this->Html->link(__('List Product Images', true), array('action' => 'index'));
      ?>
    </li>
  </ul>
</div>