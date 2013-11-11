
<div class="proyects form">
<?php echo $this->Form->create('Deliverable',array('type' => 'file', 'class'=>'form-inline')); ?>
    <fieldset>
        <legend><?php echo __('Upload File'); ?></legend>
        <div class="row">
            <div class="col-md-6">
        <?php echo $this->Form->input('title', array('class'=> 'form-control', 'placeholder'=>'Title', 'label'=>false)); ?>
            </div>
            <div class="col-md-6">
       <?php echo $this->Form->input('File', array('type' => 'file', 'label'=>false, 'title'=>'Select file'));?>
           </div>
       </div>
       <br />
    </fieldset>
<?php echo $this->Form->end(array('label'=>'Upload','class'=>'btn btn-primary')); ?>
</div>