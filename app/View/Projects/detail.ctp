<h1>Projecto MAgnifico</h1>
<?php print_r($project);
if($role==1){
echo $this->Form->create('Project'); 
echo $this->Form->input('state', array(
    'type'    => 'select',
    'options' => $status,
    'empty'   => false
));
echo $this->Form->end(__('Submit'));
}
?>
<?php //echo $this->element('sql_dump'); ?>
