<!-- Body Part Starts Here -->
<?php echo $this->Html->css('form', true); ?>
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
