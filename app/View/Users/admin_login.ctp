<?php echo $this->Html->css('form', true); ?>
<div>
  <?php echo $this->Form->create('User');?>
  <p class="heading_form">Sign In</p>
  <?php
  echo $this->Form->input('email_address');
  echo $this->Form->input('pass_word', array(
    'type' => 'password', 
    'label' => 'Password'
  ));
  echo $this->Form->input('Submit', array(
    'class' => 'submit', 
    'type' => 'submit', 
    'label' => false
  ));
  ?>
  <?php echo $this->Form->end(); ?>
</div>