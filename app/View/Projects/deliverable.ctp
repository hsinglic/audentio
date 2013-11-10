<?php echo $this->Html->link("Go back to deliverables", array('controller'=>'projects','action'=>'deliverables', $projectid));
echo "Download: ".$this->Html->link($deliverable['Deliverable']['title'], array('action'=>'download', $deliverable['Deliverable']['deliverableid']));
if($role<3){
echo $this->Form->create('Deliverable'); ?>
<p>Approve deliverable?</p>
<?php
echo $this->Form->input('approved', array('multiple' => 'checkbox', 'options' => $approve, 'selected' => $selected));

echo $this->Form->end('Update');
}
?>
<ul class="list-group projects-list">
<?php
foreach($messages as $message){ ?>
    <li class="list-group-item">
        

        <p>
        <?php echo $message['MessageDeliverable']['message']; ?></p><br />
        Posted by <?php echo $message['User']['username']; ?> <br /> Date: <?php echo $message['MessageDeliverable']['created']; ?>
        
    </li>
<?php }
 ?>
</ul>
<div class="proyects form">
<?php echo $this->Form->create('Comment'); ?>
    <fieldset>
        <legend><?php echo __('Comment Deliverable'); ?></legend>
        <?php //echo $this->Form->input('title');
       //echo $this->Form->input('File', array('type' => 'file'));
		echo $this->Form->textarea('comment');

    ?>
    </fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>