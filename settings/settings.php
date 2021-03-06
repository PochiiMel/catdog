<?php
	
	$config_file = $_SERVER['DOCUMENT_ROOT']."/BM_CONFIG/options.conf";

	define('CONFIG_FILE',$config_file);

	function init_set(){
 		$archivo = file(CONFIG_FILE);
		foreach($archivo as $linea):
			if($contenido=strpos($linea,";")!=False):
				$line=substr($linea,0,$contenido); 
			endif;	
			if(strpos($linea,"=")!=False):
				list($variable,$valor)=explode("=",$linea); 
				define(trim($variable),trim($valor)); 
			endif;
		endforeach; 
		ini_set('include_path', APP_PATH); # change include path
	}


	# easy import
	function import($module){
		$module_name=str_replace('.','/',$module);
		if(!file_exists(APP_PATH."{$module_name}.php"))
			throw new InvalidArgumentException("Fatal error: No module named {$module} ");
		require_once "{$module_name}.php";

	}

	init_set();

	set_error_handler('error_handler');
	function error_handler($errno, $errstr, $errfile, $errline) {
		if (4096 == $errno) throw new Exception($errstr);
		return false;
	}
	
?>