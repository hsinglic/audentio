<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Audetio Design Panel');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('audentio');
        echo $this->Html->script('jquery2.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="user logged-in">
    <header>
        <nav class="navbar navbar-default" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <?php echo $this->Html->link('Audentio Design ', '/pages/home', array('class' => 'navbar-brand logo')); ?>
            
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
               <?php echo $this->fetch('menu_lis'); ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php echo $this->Html->link(
                        'Logout',
                        array('controller' => 'users', 'action' => 'logout', 'full_base' => true)
                    );?>
                </li>  
            </ul>
          </div><!-- /.navbar-collapse -->
        </nav>
    </header>
    
    <div class="container">
    		<?php echo $this->Session->flash(); ?>
    		<?php echo $this->fetch('content'); ?>
    </div>
	<footer>
        &copy; 2013 Audentio Design.
    </footer>
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
