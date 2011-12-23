<h1>Admin Panel</h1>
<ul>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Categories'), array('controller' => 'categories', 'action' => 'index')); 
    ?> 
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Sub Categories'), array('controller' => 'sub_categories', 'action' => 'index')); 
    ?>
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Products'), array('controller' => 'products', 'action' => 'index')); 
    ?>
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Product Images'), array('controller' => 'product_images', 'action' => 'index')); 
    ?>
  </li>
</ul>