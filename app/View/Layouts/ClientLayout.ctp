<?php

$this->extend('/Layouts/loggedin');

$this->start('menu_lis');

?>

<li><?php
    $projectsUrl =  array('controller' => 'projects', 'action' => 'index', 'full_base' => true);

    echo $this->Html->link('Projects',$projectsUrl);?>
</li>
<li>
<?php
echo $this->Html->link(
    'Request Project',
    array('controller' => 'projects', 'action' => 'request', 'full_base' => true)
);
?></li>
<?php $this->end(); 

echo $this->fetch('content');
?>

