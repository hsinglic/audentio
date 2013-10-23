<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array('role'=>'form')); ?>
    <fieldset>
        <?php echo $this->Form->input('username', array('class'=> 'form-control', 'placeholder'=>'Username'));
        echo $this->Form->input('password', array('class'=> 'form-control', 'placeholder'=>'Password'));
    ?>
    </fieldset>
<?php echo $this->Form->end(array('lable'=>'Login','class'=>'btn','div'=>false)); ?>