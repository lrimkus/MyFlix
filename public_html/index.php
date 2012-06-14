<?php 

	include '../config/config.php';
	
	function my_autoloader($class) {
	    include '../models/' . $class . '.php';
	}
	spl_autoload_register('my_autoloader');
	
	include '../controllers/main_controler.php';
	
	new main_controller($folders, $db_info, $is_live);

	//end of Index file