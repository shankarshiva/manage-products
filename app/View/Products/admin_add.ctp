<div class="products form">
  <?php 
    echo $this->Form->create('Product');
  ?>
  <fieldset>
    <legend>
      <?php 
        echo __('Add Product'); 
      ?>
    </legend>
    <?php
      echo $this->Form->input('category_id', array('onchange'=>'getSubCategories();'));
      echo $this->Form->input('sub_category_id');
      echo $this->Form->input('product_name');
      echo $this->Form->input('product_desc');
      echo $this->Form->input('price');
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
        echo $this->Html->link(__('List Products', true), array('action' => 'index'));
      ?>
    </li>
  </ul>
</div>
<?php
  echo $this->Html->script('add_product.js');
?>
