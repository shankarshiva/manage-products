<!-- Body Part Starts Here -->
<div class="bodyPart" >
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>        
    <!-- Left Part Starts Here -->
    <td class="userLeftPart" valign="top" align="center" >
      <?php 
        echo $this->Element('category_left_menu'); 
      ?>
    </td>

    <!-- Left Part Ends Here -->
    <td ><div class="spacer11"></div></td>
    <td valign="top" class="mainRight" id="bodypart2">
      <div class="breadcrumb">
        <a href="<?php echo HTTP_HOST?>/products/home"><?php echo __('Home'); ?></a>
        &raquo; <?php echo $this->Html->link(__($selectedCategoryName, true), array('controller'=>'Products', 'action' => 'categoryList', $selectedCategoryId));?>
        &raquo;  <?php echo $selectedSubCategoryName;?>
      </div>
      <div class="subHeading"> <?php echo __('Products'); ?> </div>
      <div class="space5"></div>
      <div class="userRightPart">
        <ul class="featuredProducts">
        <?php
        if (count($productList) > 0)
        {
          foreach ($productList as $product)
          {
            $productName = $product['Product']['product_name'];
            $productDesc = $product['Product']['product_desc'];
            $productId   = $product['Product']['id'];
            $productPrice = $product['Product']['price'];

            $productImage = '';
            if(isset($product['ProductImage'][0]['image_name']) && !empty($product['ProductImage'][0]['image_name']))
            {
              $productImage = $product['ProductImage'][0]['image_name'];
            }

            // Checking if image is exist or not
            $displayImage = $this->Functions->checkImageAvailability('img/small', $productImage);
            ?>
            <li>
            <div class="productHeading">
              <?php echo $this->Html->link(__($productName, true), array('controller'=>'Products', 'action' => 'productDetails', $productId));?>
            </div>
              <table border="0" cellpadding="2" cellspacing="2" width="100%">
                <tr>
                  <td style="width:100px;" valign="top">
                  <div class="productImageHolder">
                    <?php echo $this->Html->link(
                    $this->Html->image('small/'.$displayImage, array('alt'=> $productName, 'border' => '0')),
                    array('controller'=>'Products', 'action' => 'productDetails', $productId),
                    array('escape' => false)
                    );
                    ?>
                  </div>
                  </td>
                  <td style="width:5px;">&nbsp;</td>
                  <td valign='top'>
                    <p align="justify">
                      <?php
                      $productDescription = $productDesc;
                      if (strlen($productDesc) > 450 )
                      {
                        $moreLink = $this->Html->link(__(' .........click here to see more', true), array('controller'=>'Products', 'action' => 'productDetails', $productId));
                        $productDescription = substr($productDesc, 0 , 450).$moreLink;
                      }
                      echo $productDescription;
                      ?>
                    </p>
                  <div class="space5"></div>
                  </td>
                  <td valign="top" align="center" style="width:100px;">
                    <span class="productPrice">$<?php echo $productPrice;?></span> 
                  </td>
                </tr>
              </table>
            </li>
          <?php
          }
        }
        else
        {
        ?>
        <br><li style="text-align:center;"><strong>--No Resutls Found--</strong></li><br>
        <?php
        }
        ?>
        </ul>
      </div>
    </td>
    </tr>

    <tr>
      <td align="left" valign="top">
        <?php echo $this->Html->image('/images/left_bar2.jpg', array('border' => '0'))?>
      </td>
      <td ><div class="spacer11"></div></td>
      <td align="center" valign="top"  >&nbsp;</td>
    </tr>   
  <!-- Body Part Ends Here -->
  </table>
</div>
