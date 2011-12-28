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
        &raquo; <?php echo $this->Html->link(__($selectedCategoryName, true), array('controller'=>'Products', 'action' => 'subCategoryList', $selectedCategoryId));?>
        &raquo;  <?php echo $selectedSubCategoryName;?>
      </div>
      <div class="subHeading"> <?php echo __('Products'); ?> </div>
      <div class="space5"></div>
       <?php 
        echo $this->Element('product_listing'); 
      ?>
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
