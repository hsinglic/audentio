<h1>Payment records</h1>
<?php  
echo $this->Html->link("Go back to project's index", array('controller'=>'projects','action'=>'detail', $id));?>
<ul class="list-group projects-list">
<?php 
$total=0.00;
foreach($payment as $pay){ ?>
    <li class="list-group-item">
        <?php echo $pay['Payment']['payment']; $total+=$pay['Payment']['payment'];?>

        <br />
		<?php echo $pay['Payment']['description'];?><br/>
        Updated: <?php echo $pay['Payment']['updated']; ?>
        
    </li>
<?php }
 ?>
</ul>
<b>Total: </b> $<?php echo $total;?>
<b>Project's cost:</b> $<?php echo $project['Project']['cost'];?>
<?php if($role==1){ ?>
        <div class="projects form">
        <?php echo $this->Form->create('Payment'); ?>
            <fieldset>
                <legend><?php echo __('Submit payment'); ?></legend>
                <?php 
				echo $this->Form->input('Quantity');
               //echo $this->Form->input('File', array('type' => 'file'));
        		//echo $this->Form->textarea('comment', array('class'=>'form-control'));
				echo $this->Form->input('Description');
				echo $this->Form->input('Update Cost',array('value'=>$project['Project']['cost']));
            ?><br />
            </fieldset>
        <?php echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-primary')); ?>
        </div>
<?php } ?>