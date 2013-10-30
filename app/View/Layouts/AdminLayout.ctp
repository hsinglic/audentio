<?php

$this->extend('/Layouts/loggedin');

$this->start('menu_lis');
?>

<?php
$currPage = array('controller'=>$this->params['controller'], 'action'=>$this->params['action']);
?>

<li><?php
    $projectsUrl =  array('controller' => 'projects', 'action' => 'index', 'full_base' => true);
    echo $this->Html->link('Projects',$projectsUrl, array('class'=>(count(array_diff($currPage, $projectsUrl))==0) ? 'active' :''));
    ?>
</li>

<?php $this->end(); 

echo $this->fetch('content');
?>

