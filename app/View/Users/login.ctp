<!-- Body Part Starts Here -->
<?php echo $this->Html->css('form', true); 
  $url = $facebookLoginUrl;
?>
<div class"space20"></div>
<div class="loginHeading facebookIcon">
  <a href="javascript:void(0);" onclick="javascript:facebookpopup('<?php echo $url?>');"  >
  Login with <?php echo $this->Html->image('/images/facebook.png', array('alt'=> '', 'border' => '0', 'height'=>20, 'width'=>20));?> 
  </a>
</div>

<div id="users form">
  <?php echo $this->Form->create('User');?>
  <h1><?php echo __('Login'); ?></h1><br \>
			<?php
      echo $this->Form->input('email_address');
      echo $this->Form->input('pass_word', array(
          'type' => 'password',
          'label'=>'Password'
        ));
      ?>
     <input type="submit" value="Login" class="black_button">
     <br />
	<?php echo $this->Form->end(); ?>
	<br clear="all">
</div>

<!-- Body Part Starts Here -->
<script>

function facebookpopup(url){
	 /*   if(isSign==1){
	        showMessage('Sorry signup is disabled by admin.');
	        return false;
	    }*/
//	    window.open(url ,'width=400,height=200');

	       
	window.open(url,null,",height=550,width=800,status=yes,scrollbars=1,toolbar=no,menubar=no,location=no");
	}
      
      </script>