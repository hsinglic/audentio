<?php 
echo $this->Html->link("<span class='glyphicon glyphicon-chevron-left'></span> Go back to project's index", array('controller'=>'projects','action'=>'detail', $id), array('class'=>'btn btn-default', 'escape'=>false)); ?>

<br />
<div class="row">
    <div class="col-md-4">
        <h2><?php echo $Project['Project']['title']?></h2>
        <h3>&raquo; <?php echo ($role==4) "" : "Client"?> Message board</h3>
    </div>
    <div class="col-md-8">
        <?php if(count($messages)>0){ ?>
            <ul class="list-group projects-list">
            <?php
            foreach($messages as $message){ ?>
                <li class="list-group-item">
                    <small class="text-muted pull-right">Date: <?php echo $message['MessageDeliverable']['created']; ?></small>
                    <strong> <?php echo $message['User']['username']; ?> </strong> said:
                    <p>
                        <?php echo $message['MessageDeliverable']['message']; ?>
                    </p>
                </li>
            <?php }
             ?>
            </ul>    
        <?php } else { ?>
            <em class="text-muted">There are no messages for this project. </em>
        <?php }?>
        <div class="projects form">
        <?php echo $this->Form->create('Comment'); ?>
            <fieldset>
                <legend><?php echo __('Comment Deliverable'); ?></legend>
                <?php //echo $this->Form->input('title');
               //echo $this->Form->input('File', array('type' => 'file'));
        		echo $this->Form->textarea('comment', array('class'=>'form-control'));

            ?><br />
            </fieldset>
        <?php echo $this->Form->end(array('label'=>'Comment', 'class'=>'btn btn-primary')); ?>
        </div>
    </div>
</div>