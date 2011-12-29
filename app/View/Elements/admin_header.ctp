<h1>Admin Panel</h1>
<ul>
<?php 
if($this->Session->read('AdminUser.id'))
{
?>
 <li>
    <?php 
      //echo $this->Html->link(__('Crom Images'), array('controller' => 'Products', 'action' => 'cropImage')); 
    ?> 
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Categories'), array('controller' => 'Categories', 'action' => 'index')); 
    ?> 
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Sub Categories'), array('controller' => 'SubCategories', 'action' => 'index')); 
    ?>
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Products'), array('controller' => 'Products', 'action' => 'index')); 
    ?>
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Manage Product Images'), array('controller' => 'ProductImages', 'action' => 'index')); 
    ?>
  </li>
  <li>
    <?php 
      echo $this->Html->link(__('Logout'), array('controller' => 'Users', 'action' => 'logout')); 
    ?>
  </li>
<?php 
}
else
{
  ?>
   <li>
    <?php 
      echo $this->Html->link(__('Login'), array('controller' => 'Users', 'action' => 'login')); 
    ?>
  </li>
  <?php
}
?>
</ul>