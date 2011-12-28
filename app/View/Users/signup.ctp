<?php echo $this->Html->css('form', true); ?>
<div class="users form">
  <?php echo $this->Form->create('User');?>
  <h1><?php echo __('Registration'); ?></h1>
  	<br />
  <?php
  echo $this->Form->input('name');
  echo $this->Form->input('user_type', array(
    'type' => 'hidden', 
    'value' => 1
  ));
  echo $this->Form->input('created_date', array(
      'type' => 'hidden',
      'value' => '<?php echo date("Y-m-d H:i:s");?>'
  ));
  
  echo $this->Form->input('email_address');
  echo $this->Form->input('pass_word', array(
    'type' => 'password', 
    'label' => 'Password'
  ));
  echo $this->Form->input('cpass_word', array(
    'type' => 'password', 
    'label' => 'Confirm Password'
  ));

  echo $this->Html->image($this->Html->url(array(
    'controller' => 'users', 
    'action' => 'captcha'
  ), true));
  ?>
  <p>Enter security code shown above:</p>
  <?php
  echo $this->Form->input('User.captcha', array(
    'autocomplete' => 'off', 
    'label' => false, 
    'class' => '', 
    'error' => __('The characters you 
  type must match the characters in the picture. Please try again.', true)
  ));
  
  echo $this->Form->input('Submit', array(
    'class' => 'black_button', 
    'type' => 'submit', 
    'label' => false
  ));
  ?>
  <br /><br />
  <?php 
  echo $this->Form->end(); 
  ?>
</div>