<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Register'); ?></legend>
        <?php echo $this->Form->input('username', array('class'=> 'form-control', 'placeholder'=>'Username', 'label'=>false));?><br />
        
        <?php echo $this->Form->input('password', array('class'=> 'form-control', 'placeholder'=>'Password', 'label'=>false));?><br />
        
		<?php echo $this->Form->input('email', array('class'=> 'form-control', 'placeholder'=>'email@example.com', 'label'=>false)); ?><br />
        
    </fieldset>
<?php echo $this->Form->end(array('label'=>'Register','class'=>'btn btn-primary btn-lg btn-block','div'=>false)); ?>
</div>