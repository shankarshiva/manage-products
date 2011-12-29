<div class="productImages index">
<h2>
  <?php 
    echo __('Product Images');
  ?>
</h2>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th>
        <?php 
          echo $this->Paginator->sort('product_id');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('image_name');
        ?>
      </th>
      <th>
        <?php 
          echo __('Cropped Image');
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
    foreach ($productImages as $productImage):
      $class = null;
      if ($i++ % 2 == 0) 
      {
        $class = ' class="altrow"';
      }
      ?>
      <tr<?php echo $class;?>>
        <td>
        <?php echo $this->Html->link($productImage['Product']['product_name'], array('controller' => 'products', 'action' => 'index', $productImage['Product']['id'])); ?>
        </td>
        <td>
        <?php        
        // Checking if image is exist or not
        $displayImage = $this->Functions->checkImageAvailability('img/small', $productImage['ProductImage']['image_name']);
        echo $this->Html->image('small/'.$displayImage, array('alt'=> $productImage['Product']['product_name'], 'border' => '0'));
        ?>
        &nbsp;</td>
        
        <td>
        <?php        
        // Checking if image is exist or not
        $cropped_image = 'thumbnail_'.$productImage['ProductImage']['image_name'];
        $displayImage = $this->Functions->checkImageAvailability('img/crop_images', $cropped_image);

        echo $this->Html->image('crop_images/'.$displayImage, array('alt'=> $productImage['Product']['product_name'], 'border' => '0'));
        ?>
        &nbsp;</td>
        
        <td class="actions">
        <?php 
          echo $this->Html->link(__('Edit', true), array('action' => 'edit', $productImage['ProductImage']['id'])); 
          echo $this->Html->link(__('Delete', true), array('action' => 'delete', $productImage['ProductImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productImage['ProductImage']['id'])); 
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
        echo $this->Html->link(__('New Product Image', true), array('action' => 'add')); 
      ?>
    </li>
  </ul>
</div>