<div class="panel panel-primary">
    <div class="panel-heading">
        <h3><?php echo $project['Project']['title']?>
            <span class="badge"><?php echo $project['Project']['state'] ?></span>
        </h3>
    </div>
  <div class="panel-body">
      <small class="pull-right">Creted on <?php echo $project['Project']['created'] ?></small>
      <blockquote>
        <p><?php echo $project['Project']['description'] ?></p>
      </blockquote>
      <div class="row text-muted">
          <div class="col-md-4">
              <p>Check the deliverables for this project and approve them.</p>
			  <?php  echo $this->Html->link("Deliverables", array('action'=>'deliverables', $project['Project']['proyectoid']), array('class'=>'btn btn-default btn-lg', 'role'=>'button'));?>
          </div>
          <div class="col-md-4">
              <p>Discuss the project's features, issues, and send feedback or suggestions.</p>
              <div class="btn-group">
				  <?php  echo $this->Html->link("With Client", array('action'=>'chatClients', $project['Project']['proyectoid']), array('class'=>'btn btn-default btn-lg', 'role'=>'button'));?>
				  <?php if($role<>4){?>
				  <?php  echo $this->Html->link("With team", array('action'=>'chatTeam', $project['Project']['proyectoid']),array('class'=>'btn btn-default btn-lg', 'role'=>'button'));?>
				  <?php } ?>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <?php 
                  if($role==1){
                  echo $this->Form->create('Project', array('class'=>'form-inline', 'role'=>'form')); ?>
        
              <?php echo $this->Form->input('Project state', array(
                  'type'    => 'select',
                  'options' => $status,
                  'empty'   => false,
                  'class'=> 'form-control',
                  'div'=>false
              ));?>
              <?php echo $this->Form->end(array('label'=>'Submit','class'=>'btn btn-default'));
              }
              ?>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="form-group">
    
    <?php 
	  if($role==1){
	 echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> Assign members', array('controller'=>'users','action'=>'assign', $project['Project']['proyectoid']), array('escape'=>false, 'class'=>'btn btn-default')); }?>
	 <?php if($role==1 || $role==4){
	 echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> Payment records', array('action'=>'payment', $project['Project']['proyectoid']), array('escape'=>false, 'class'=>'btn btn-default')); }?>

</div>

<?php //echo $this->element('sql_dump'); ?>
