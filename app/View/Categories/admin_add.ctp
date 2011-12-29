<div class="categories form">
  <?php 
    echo $this->Form->create('Category',array('enctype'=>'multipart/form-data'));
  ?>
  <fieldset>
    <legend>
      <?php 
        echo __('Add Category'); 
      ?>
    </legend>
    <?php
      echo $this->Form->input('category_name');
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
        echo $this->Html->link(__('List Categories', true), array('action' => 'index'));
      ?>
    </li>
  </ul>
</div>
