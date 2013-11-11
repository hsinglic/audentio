
<?php 
echo $this->Html->link("<span class='glyphicon glyphicon-chevron-left'></span> Go back to deliverables", array('controller'=>'projects','action'=>'deliverables', $projectid), array('class'=>'btn btn-default', 'escape'=>false)); ?>

<br />
<div class="row">
    
    <div class="col-md-8">
    
        <h2>Download deliverable:</h2>
        <?php echo $this->Html->link("<span class='glyphicon glyphicon-cloud-download'></span> ".$deliverable['Deliverable']['title'], array('action'=>'download', $deliverable['Deliverable']['deliverableid']), array('class'=>'btn btn-info btn-lg', 'escape'=>false)); ?>
        <br />
        <?php if(count($messages)>0):?>
            <br />
            <legend>Discussion</legend>
        <?php endif;?>
        <ul class="list-group projects-list">
        <?php foreach($messages as $message) { ?>
            <li class="list-group-item">
                <small class="text-muted pull-right">Date: <?php echo $message['MessageDeliverable']['created']; ?></small>
                <strong> <?php echo $message['User']['username']; ?> </strong> said:
                <p>
                    <?php echo $message['MessageDeliverable']['message']; ?>
                </p>
            </li>
        <?php } ?>
        </ul>
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
    <?php if($role<3){ ?>
        <div class="col-md-4 approve-block">
            <?php echo $this->Form->create('Deliverable'); ?>
            <legend>Approve deliverable?</legend>
            <?php
            echo $this->Form->input('approved', array('multiple' => 'checkbox', 'options' => $approve, 'selected' => $selected)); ?>

            <?php echo $this->Form->end(array('label'=>'Update', 'class'=>'btn btn-default')); ?>
        </div>
    <?php } ?>
</div>