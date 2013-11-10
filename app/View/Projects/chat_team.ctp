<?php echo $this->Html->link("Go back to project's index", array('controller'=>'projects','action'=>'detail', $id));
?>
    <div class="panel-heading">
        <h3><?php echo $Project['Project']['title']?> &raquo; Message board for the team
        </h3>
    </div>
<ul class="list-group projects-list">
<?php
foreach($messages as $message){ ?>
    <li class="list-group-item">
        

        <p>
        <?php echo $message['MessageProject']['message']; ?></p><br />
        Posted by <?php echo $message['User']['username']; ?> <br /> Date: <?php echo $message['MessageProject']['created']; ?>
        
    </li>
<?php }
 ?>
</ul>
<div class="projects form">
<?php echo $this->Form->create('Comment'); ?>
    <fieldset>
        <legend><?php echo __('Comment Project'); ?></legend>
        <?php //echo $this->Form->input('title');
		echo $this->Form->textarea('comment');

    ?>
    </fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>