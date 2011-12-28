<div class="subCategories index">
  <h2>
    <?php 
      echo __('Sub Categories');
    ?>
  </h2>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th>
        <?php 
          echo $this->Paginator->sort('category_id');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('sub_category_name');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('sub_image_name');
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
    foreach ($subCategories as $subCategory):
      $class = null;
      if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
      }
      ?>
      <tr<?php echo $class;?>>
        <td>
        <?php 
          echo $this->Html->link($subCategory['Category']['category_name'], array('controller' => 'categories', 'action' => 'index', $subCategory['Category']['id'])); 
        ?>
        </td>
        <td>
          <?php 
            echo $subCategory['SubCategory']['sub_category_name']; 
          ?>&nbsp;
        </td>
        <td>
        <?php        
        // Checking if image is exist or not
        $displayImage = $this->Functions->checkImageAvailability('img/small', $subCategory['SubCategory']['sub_image_name']);
        echo $this->Html->image('small/'.$displayImage, array('alt'=> $subCategory['SubCategory']['sub_category_name'], 'border' => '0'));
        ?>
        &nbsp;</td>
        <td class="actions">
        <?php 
          echo $this->Html->link(__('Edit', true), array('action' => 'edit', $subCategory['SubCategory']['id'])); 
          echo $this->Html->link(__('Delete', true), array('action' => 'delete', $subCategory['SubCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subCategory['SubCategory']['id'])); 
        ?>
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
        echo $this->Html->link(__('New Sub Category', true), array('action' => 'add')); 
      ?>
    </li>
  </ul>
</div>