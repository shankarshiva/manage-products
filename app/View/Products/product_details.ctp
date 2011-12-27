<?php

$productName = '';
$productDesc = '';
$productImageArray = array();

foreach ($productDetails as $product) 
{
  $productName = $product['Product']['product_name'];
  $productDesc = $product['Product']['product_desc'];
  $productPrice = $product['Product']['price'];
  $productImageArray = $product['ProductImage'];
}
?>
<!-- Body Part Starts Here -->
<div class="bodyPart" >
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>        
    <td ><div class="spacer11"></div></td>
    <td valign="top" class="mainRight" id="bodypart2">
      <div class="breadcrumb">
        <?php 
          echo $this->Html->link(__('Home', true), array('controller'=>'Products', 'action' => 'home'));
        ?>
        &raquo; 
        <?php 
          echo $this->Html->link(__($productCatName, true), array('controller'=>'Products', 'action' => 'subCategoryList', $productCatId));
        ?>
        <?php 
        if(!empty($productSubCatName))
        {
        ?>
        &raquo; 
        <?php 
          echo $this->Html->link(__($productSubCatName, true), array('controller'=>'Products', 'action' => 'productList', $productSubCatId));
          }
        ?>
        &raquo; 
        <?php 
          echo $productName;
        ?>
      </div>
      <div class="space5"></div>
      <div class="pageHeading"><h1><?php echo __('Product Details'); ?></h1></div>
      <div class="productHeading"><?php echo $productName;?></div>
        <table border="0" cellpadding="2" cellspacing="2" width="100%">
          <tr>
            <td style="width:100px;" valign="top">
              <div id="two" class="contentslider">
                <div class="cs_wrapper">
                  <div class="cs_slider">
                  <?php
                  if (count($productImageArray) > 0)
                  {
                    foreach ($productImageArray as $productImage) 
                    {
                      $eachImage = $productImage['image_name'];

                      // Checking if image is exist or not
                      $displayImage = $this->Functions->checkImageAvailability('img/big', $eachImage);
                      ?>
                      <div class="cs_article">
                        <?php echo $this->Html->image('big/'.$displayImage, array('alt'=> $productName, 'border' => '0'))?>
                      </div>
                      <!-- End cs_article -->
                    <?php
                    }
                  }
                  else
                  {
                  ?>
                  <div class="cs_article">
                    <?php echo $this->Html->image('big/no-image-270.jpg', array('alt'=> $productName, 'border' => '0'))?>
                  </div>
                  <!-- End cs_article -->
                  <?php
                  }
                  ?>
                  </div><!-- End cs_slider -->
                </div><!-- End cs_wrapper -->
              </div><!-- End contentslider -->
            </td>
            <td valign="top" >
              <span class="productPrice">Price $<?php echo $productPrice;?></span><br><br>
              <p align="justify"><?php echo  $productDesc ;?></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  <!-- Body Part Ends Here -->
  </table>
</div>
<?php
  echo $this->Html->script(array('product_details.js', 'slideshow/jquery.easing.1.3.js', 'slideshow/jquery.ennui.contentslider.js'));
?>
