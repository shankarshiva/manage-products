<div class="products index">
  <h2>
    <?php 
      echo __('Products');
    ?>
  </h2>
  <table cellpadding="0" cellspacing="0" border="0">
    <tr>
      <th>
        <?php 
          echo $this->Paginator->sort('category_id');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('sub_category_id');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('product_name');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('product_desc');
        ?>
      </th>
      <th>
        <?php 
          echo $this->Paginator->sort('price');
        ?>
      </th>
      <th class="actions actionCenter">
        <?php 
          echo __('Actions');
        ?>
      </th>
    </tr>
    <?php
    $i = 0;
    foreach ($products as $product):
      $class = null;
      if ($i++ % 2 == 0) 
      {
        $class = ' class="altrow"';
      }
      ?>
      <tr<?php echo $class;?>>
        <td>
        <?php 
          echo $this->Html->link($product['Category']['category_name'], array('controller' => 'categories', 'action' => 'index', $product['Category']['id'])); 
        ?>
        </td>
        <td>
        <?php 
          echo $this->Html->link($product['SubCategory']['sub_category_name'], array('controller' => 'sub_categories', 'action' => 'index', $product['SubCategory']['id'])); 
        ?>
        </td>
        <td>
          <?php 
            echo $product['Product']['product_name']; 
          ?>&nbsp;
        </td>
        <td>
          <?php 
            echo $product['Product']['product_desc']; 
          ?>&nbsp;
          
        </td>
        <td>
          <?php 
            echo $product['Product']['price']; 
          ?>&nbsp;
        </td>
        <td class="actions">
        <?php 
          echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id'])); 
        ?>
        <?php 
          echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); 
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
        echo $this->Html->link(__('New Product', true), array('action' => 'add')); 
      ?>
    </li>
  </ul>
</div>