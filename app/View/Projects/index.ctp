<h1>Assigned Proyects</h1>

<table>
	<tr>
		<th>Title</th>
		<th>Created by</th>
		<th>Status</th>
	</tr>
<?php
foreach($projects as $project){
	echo "<tr><td>".$project['Project']['title']."</td><td>".$project['User']['username']."</td><td>".$project['Project']['state']."</td><td>"
	.$this->Html->link('Detail', array('action' => 'detail', $project['Project']['proyectoid']))."</td></tr>";
	
	
}
?>
</table>


<?php

	// print_r($projects);

echo $this->Html->link(
    'Request Proyect',
    array('controller' => 'projects', 'action' => 'request', 'full_base' => true)
);

echo $this->Html->link(
    'Logout',
    array('controller' => 'users', 'action' => 'logout', 'full_base' => true)
);
?>