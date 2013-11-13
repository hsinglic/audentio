
<div class="proyects form">
<?php echo $this->Form->create('Project'); ?>
    <fieldset>
        <legend><?php echo __('Request Project'); ?></legend>
        <?php echo $this->Form->input('title', array('class'=> 'form-control', 'placeholder'=>'Title', 'label'=>false)); ?>
        <?php echo $this->Form->textarea('description', array('class'=> 'form-control', 'placeholder'=>'Description', 'label'=>false));
		
//        echo $this->Form->input('role', array(
//            'options' => $roles
//        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(array('label'=>'Request project','class'=>'btn btn-primary')); ?>
</div>