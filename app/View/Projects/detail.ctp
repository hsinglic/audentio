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
  </div>
</div>

<section class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php 
            if($role==1){
            echo $this->Form->create('Project', array('class'=>'form-inline', 'role'=>'form')); ?>
        
        <?php echo $this->Form->input('state', array(
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
</section>

<?php //echo $this->element('sql_dump'); ?>
