<div class="row">

    <div class="col-md-4">
        <?php 
        echo $this->Html->link("<span class='glyphicon glyphicon-chevron-left'></span> Go back to project's index", array('controller'=>'projects','action'=>'detail', $id), array('class'=>'btn btn-default', 'escape'=>false)); ?>
    </div>
    <div class="col-md-8 well">
    
<?php echo $this->Form->create('User'); ?>
<?php
echo $this->Form->input('Team members', array('multiple' => 'checkbox', 'options' => $users, 'selected' => $selected));

?>
<?php echo $this->Form->end(array('label'=>'Finish','class'=>'btn btn-primary btn-lg btn-block','div'=>false)); ?>
    </div>
</div>