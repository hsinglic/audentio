<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array('role'=>'form', 'class'=>'login_form')); ?>
    <fieldset>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <?php echo $this->Form->input('username', array('class'=> 'form-control', 'placeholder'=>'Username', 'label'=>false));?>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <?php echo $this->Form->input('password', array('class'=> 'form-control', 'placeholder'=>'Password', 'label'=>false));?>
        </div>
    </fieldset>
    <div class="big_button">
        <span class="glyphicon glyphicon-log-in"></span>
        <?php echo $this->Form->end(array('label'=>'Login','class'=>'btn btn-primary btn-lg btn-block','div'=>false)); ?>
    </div>
    <div class="opc_box">
Don't have an account? <?php
    echo $this->Html->link(
    'Register',
    array('controller' => 'users', 'action' => 'register', 'full_base' => true), array('class'=>'btn btn-default')
);
?>
    </div>