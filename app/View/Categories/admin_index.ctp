<div class="categories index">
  <h2>
    <?php 
      echo __('Categories');
    ?>
  </h2>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th>
        <?php 
          echo $this->Paginator->sort('category_name');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('category_image');
        ?>
      </th>
      <th class="actions actionCenter" >
        <?php 
          echo __('Actions');
        ?>
      </th>
    </tr>
    <?php
    $i = 0;
    foreach ($categories as $category):
      $class = null;
      if ($i++ % 2 == 0) 
      {
        $class = ' class="altrow"';
      }
      ?>
      <tr<?php echo $class;?>>
        <td><?php echo $category['Category']['category_name']; ?>&nbsp;</td>
        <td>
        <?php
        // Checking if image is exist or not
        $displayImage = $this->Functions->checkImageAvailability('img/small', $category['Category']['category_image']);
        echo $this->Html->image('small/'.$displayImage, array('alt'=> $category['Category']['category_name'], 'border' => '0'));
        ?>
        &nbsp;</td>
        <td class="actions">
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $category['Category']['id'])); ?>
        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $category['Category']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $category['Category']['id'])); ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php 
    echo $this->Element('pagination');
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
        echo $this->Html->link(__('New Category', true), array('action' => 'add')); 
      ?>
    </li>
  </ul>
</div>
