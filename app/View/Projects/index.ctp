<?php
    $this->layout = "AdminLayout";
?>
<h1>Assigned Proyects</h1>

<?php

echo $this->Html->link(
    'Request Proyect',
    array('controller' => 'projects', 'action' => 'request', 'full_base' => true)
);


?>