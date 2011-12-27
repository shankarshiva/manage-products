<!-- Body Part Starts Here -->
<div class="bodyPart" >
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>        
      <td ><div class="spacer11"></div></td>
      <td valign="top" class="mainRight" id="bodypart2">
        <div id="productListing">
          <!-- Body Part Starts Here -->
          <div class="space10"></div>
          <?php echo $this->Form->create('User');?>
          <table border="0" cellpadding="0" cellspacing="0" width="50%" >
            <tr>
            <td>
              <div class="subHeading"><?php echo __('Login'); ?></div>
            </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
            <td width="20%">
              <strong>UserName :</strong>
            </td>
            <td ><?php echo $this->Form->input('email_address', array('label'=>false)); ?></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
            <td>
              <strong>Password :</strong>
            </td>
            <td>
            <?php echo $this->Form->input('pass_word', array(
                        'type' => 'password', 
                        'label' => false
                      ));
            ?>
            </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
          </table>
           <?php echo $this->Form->end('Login'); ?>
          <!-- Body Part  Ends Here -->
        </div>
      </td>
    </tr>
  </table>
</div>
