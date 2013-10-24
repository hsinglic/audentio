
<div class="proyects form">
<?php echo $this->Form->create('Project'); ?>
    <fieldset>
        <legend><?php echo __('Request Project'); ?></legend>
        <?php echo $this->Form->input('title');
        echo $this->Form->textarea('description');
		
//        echo $this->Form->input('role', array(
//            'options' => $roles
//        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>