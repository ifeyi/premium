<?php

// SERVER CONFIGURATIONS
class CamerticConfig {
	var $user = 'root';
	var $pass = '';

	//var $library = 'C:\wamp\www\pagify\lib\library.php';
	var $dbtype = 'mysql';
	var $host = '';
	var $dbname = 'premium';
	var $port = 3306;
	var $appfolder = '';
	var $traceSQL = false; // Indique si on doit faire des tracing des requetes sql
	var $traceActions = false; // Indique si on doit faire tracings des actions des utilisateurs
	var $logType = 'sql'; // Le log type precise la facon dont les logs sont enregistre. valeurs possibles : 'sql' = dans la BD, ou 'file' = dans un fichier
	
	var $dsn = "";
	
	public function __construct($libfile = null) {
		@session_start();
		$this->dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname";
		@define("DS", DIRECTORY_SEPARATOR);
		if(is_null($libfile))
			$path_to_file = '.' . DS . 'lib' . DS . 'library.php';
		else
			$path_to_file = $libfile;
	//	var_dump($path_to_file);
		$real_path = realpath($path_to_file);
	//	var_dump($real_path);
		@include_once($real_path);
		
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