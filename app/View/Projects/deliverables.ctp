<?php 
echo $this->Html->link("<span class='glyphicon glyphicon-chevron-left'></span> Go back to project's index", array('controller'=>'projects','action'=>'detail', $id), array('class'=>'btn btn-default', 'escape'=>false)); ?>

<h1>List of deliverables <?php  echo ($role<>4)? $this->Html->link("<span class='glyphicon glyphicon-cloud-upload'></span> New deliverable", array('action'=>'upload', $id), array('class'=>'btn btn-primary', 'escape'=>false)):""; ?>
</h1>




<ul class="list-group projects-list">
<?php
foreach($deliverables as $deliverable){ ?>
    <li class="list-group-item">
        <span class="badge"><?php echo ($deliverable['Deliverable']['approved']==1)? "Approved": "Not approved"; ?></span>

        <h3>
        <?php echo $this->Html->link($deliverable['Deliverable']['title'], array('action'=>'deliverable', $deliverable['Deliverable']['deliverableid']));?></h3><br />
        Uploaded by <?php echo $deliverable['User']['username']; ?>
        
    </li>
<?php }
 ?>
</ul>
<?php // echo $this->element('sql_dump'); ?>