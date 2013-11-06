<div class="panel panel-primary">
    <div class="panel-heading">
        <h3><?php echo $project['Project']['title']?>
            <span class="badge"><?php echo $project['Project']['state'] ?></span>
        </h3>
    </div>
  <div class="panel-body">
      <small class="pull-right">Creted on <?php echo $project['Project']['creationDate'] ?></small>
      <blockquote>
        <p><?php echo $project['Project']['description'] ?></p>
      </blockquote>
      <div class="row text-muted">
          <div class="col-md-4">
              <p>Check the deliverables for this project and approve them.</p>
              <a href="#" class="btn btn-default btn-lg " role="button">Deliverables</a>
          </div>
          <div class="col-md-4">
              <p>Discuss the project's features, issues, and send feedback or suggestions.</p>
              <div class="btn-group">
                  <a href="#" class="btn btn-default btn-lg " role="button">With Client</a>
                  <a href="#" class="btn btn-default btn-lg " role="button">With team</a>
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


<?php //echo $this->element('sql_dump'); ?>
