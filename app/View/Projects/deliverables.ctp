<h1>List of deliverables</h1>
<?php  echo ($role<>4)? $this->Html->link("Upload", array('action'=>'upload', $id)):"";
echo $this->Html->link("Go back to project's index", array('controller'=>'projects','action'=>'detail', $id));?>
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