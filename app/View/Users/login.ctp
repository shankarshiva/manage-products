<!-- Body Part Starts Here -->
<?php echo $this->Html->css('form', true); 

//$url = 'http://localhost/manage-products/Users/login/Facebook';
$url = $facebookLoginUrl;

?>

<div class="loginHeading bigBg">
  <a href="javascript:void(0);" onclick="javascript:facebookpopup('<?php echo $url?>');" class="facebookIcon" >
  Login with <?php echo $this->Html->image('/images/facebook_icon.jpeg', array('alt'=> '', 'border' => '0', 'height'=>30, 'width'=>30));?> 
  </a>
</div>
<!-- 
<div class="loginHeading bigBg">Log in or Signup with</div>

<div class="signupLinks">
  <a class="facebookIcon" onclick="javascript:facebookpopup('http://localhost/manage-products/Users/facebook');" href="javascript:void(0);"></a>
</div>-->
				
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