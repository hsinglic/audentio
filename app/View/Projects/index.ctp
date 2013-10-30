<h1>Assigned Proyects</h1>

<ul class="list-group projects-list">
<?php
foreach($projects as $project){ ?>
    <li class="list-group-item">
        <span class="badge"><?php echo $project['Project']['state']; ?></span>
        <h3><?php echo $this->Html->link(
                            $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-circle-arrow-right')), 
                            array('action' => 'detail', $project['Project']['proyectoid']),
                            array('escape'=>false));
            ?>
        
        <?php echo $this->Html->link($project['Project']['title'], array('action'=>'detail', $project['Project']['proyectoid']));?></h3><br />
        Created by <?php echo $project['User']['username']; ?>
    
    
        
    </li>
<?php } ?>
</ul>