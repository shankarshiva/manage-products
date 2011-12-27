<div id="menu_list">
  <ul>
    <li><h2>Categories</h2>
      <ul>
        <?php 
        foreach ($categoryList as $category)
        {
          $categoryName = $category['Category']['category_name'];
          $categoryId = $category['Category']['id'];

          $subcategoryArray = array();

          if(isset($category['SubCategory'][0]) && !empty($category['SubCategory'][0]))
          {
            $subcategoryArray = $category['SubCategory'];
          }
          ?>
          <li>
          <?php
            echo $this->Html->link(__($categoryName, true), array('controller'=>'Products', 'action' => 'subCategoryList', $categoryId));
          ?>
            <ul>
            <?php
            if(count($subcategoryArray) > 0)
            {
              foreach($subcategoryArray as $subcategory)
              {
                $subcategoryName = $subcategory['sub_category_name'];
                $subCatId = $subcategory['id'];
                ?>
                <li>
                  <?php
                    echo $this->Html->link(__($subcategoryName, true), array('controller'=>'Products', 'action' => 'productList', $subCatId));
                  ?>
                </li>
              <?php
              }
            }
            ?>
            </ul>
          </li>
        <?php
        }
        ?>
      </ul>
    </li>
  </ul>
</div>