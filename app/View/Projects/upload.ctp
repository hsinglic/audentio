
<div class="proyects form">
<?php echo $this->Form->create('Deliverable',array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Upload File'); ?></legend>
        <?php echo $this->Form->input('title');
       echo $this->Form->input('File', array('type' => 'file'));
		

    ?>
    </fieldset>
<?php echo $this->Form->end('Upload'); ?>
</div>