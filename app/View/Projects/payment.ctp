<?php 
echo $this->Html->link("<span class='glyphicon glyphicon-chevron-left'></span> Go back to project's index", array('controller'=>'projects','action'=>'detail', $id), array('class'=>'btn btn-default', 'escape'=>false)); ?>

<h1>Payment records</h1>
<?php
    
    
    
    
?>
<div class="well">
<h3>Total paid: </b> $<?php echo $total;?></h3>
<h4>Project's cost:</b> $<?php echo $project['Project']['cost'];?></h4>
</div>
<div class="row">
    <div class="col-md-8">
        <ul class="list-group projects-list">
        <?php 
        foreach($payment as $pay){ ?>
            <li class="list-group-item">
                <small class="text-muted pull-right">Updated: <?php echo $pay['Payment']['updated']; ?></small>
                <strong>$<?php echo $pay['Payment']['payment'];?></strong>
        		<?php echo $pay['Payment']['description'];?><br/>
        
            </li>
        <?php }
         ?>
        </ul>
    </div>
    <div class="col-md-4">
        <?php if($role==1){ ?>
                <div class="projects form">
                <?php echo $this->Form->create('Payment'); ?>
                    <fieldset>
                        <legend><?php echo __('Submit payment'); ?></legend>
                        <?php 
        				echo $this->Form->input('Quantity', array('class'=> 'form-control', 'placeholder'=>'Payment amount', 'label'=>false)); ?><br />
        				<?php echo $this->Form->input('Description',array('class'=> 'form-control', 'placeholder'=>'Payment description', 'label'=>false)); ?><br />
        				<?php echo $this->Form->input('Update Cost',array('value'=>$project['Project']['cost'], 'class'=> 'form-control')); ?>
                    <br />
                    </fieldset>
                <?php echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-primary')); ?>
                </div>
        <?php } ?>
    </div>
</div>


