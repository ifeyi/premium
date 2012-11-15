<?php

// SERVER CONFIGURATIONS
class CamerticConfig {
	var $user = 'kiconnai';
	var $pass = '1exumsjmix';

	var $library = '/home/kiconnai/www/lib/library.php';
	var $dbtype = 'mysql';
	var $host = 'localhost';
	var $dbname = 'kiconnai';
	var $port = 3306;
	var $dsn = "";
	
	public function __construct() {
		@session_start();
		$this->dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname";
		@define("DS", DIRECTORY_SEPARATOR);
		$path_to_file = 'lib' . DS . 'library.php';
		$real_path = realpath($path_to_file);
		//die($real_path);
		include_once($this->library);
		
	}
	
	public function __invoke($debug) {
		echo "<pre>";
		$class = ReflectionClass('CamerticConfig');
		printf(
			"===> The %s%s%s %s '%s' [extends %s]\n" .
			" declared in %s\n" .
			" lines %d to %d\n" .
			" having the modifiers %d [%s]\n",
			$class->isInternal() ? 'internal' : 'user-defined',
			$class->isAbstract() ? ' abstract' : '',
			$class->isFinal() ? ' final' : '',
			$class->isInterface() ? 'interface' : 'class',
			$class->getName(), var_export($class->getParentClass(), 1),
			$class->getFileName(),
			$class->getStartLine(),
			$class->getEndline(),
			$class->getModifiers(), implode(' ', Reflection::getModifierNames($class->getModifiers())));
			// Print documentation comment
			printf("---> Documentation:\n %s\n", var_export($class->getDocComment(), 1));
			// Print which interfaces are implemented by this class
			printf("---> Implements:\n %s\n", var_export($class->getInterfaces(), 1));
			// Print class constants
			printf("---> Constants: %s\n", var_export($class->getConstants(), 1));
			// Print class properties
			printf("---> Properties: %s\n", var_export($class->getProperties(), 1));
			// Print class methods
			printf("---> Methods: %s\n",
			var_export($class->getMethods(), 1));
			// If this class is instantiable, create an instance
			if ($class->isInstantiable()) {
				$counter = $class->newInstance();
				echo '---> $counter is instance? ';
				echo $class->isInstance($counter) ? 'yes' : 'no';
				echo "\n---> new Object() is instance? ";
				echo $class->isInstance(new Object()) ? 'yes' : 'no';
			}
		echo "</pre>";
	}
	
	public function go($url) {
		header("location:$url"); //die;
	}

}
?>