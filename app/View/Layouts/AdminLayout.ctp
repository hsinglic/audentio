<?php

$this->extend('/Layouts/loggedin');

$this->start('menu_lis');
?>
<li><?php echo $this->Html->link('Projects', array('controller' => 'projects', 'action' => 'index', 'full_base' => true)
    );?>
</li>

<?php $this->end(); 

echo $this->fetch('content');
?>

