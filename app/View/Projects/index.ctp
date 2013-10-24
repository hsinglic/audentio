<h1>Assigned Proyects</h1>

<?php


echo $this->Html->link(
    'Request Proyect',
    array('controller' => 'projects', 'action' => 'request', 'full_base' => true)
);

echo $this->Html->link(
    'Logout',
    array('controller' => 'users', 'action' => 'logout', 'full_base' => true)
);
?>