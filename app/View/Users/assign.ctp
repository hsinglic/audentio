<div class="users form">
<?php 
echo $this->Html->link("Go back to project's index", array('controller'=>'projects','action'=>'detail', $id));
echo $this->Form->create('User'); ?>
<?php
echo $this->Form->input('Team members', array('multiple' => 'checkbox', 'options' => $users, 'selected' => $selected));

?>
<?php echo $this->Form->end(array('label'=>'Finish','class'=>'btn btn-primary btn-lg btn-block','div'=>false)); ?>

</div>