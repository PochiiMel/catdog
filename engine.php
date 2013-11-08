<?php
	session_start();
	define( "BUSINESS_MANAGER", true ); # aplicacion en produccion

	require_once('settings/settings.php');  # carga configuraciones
	require_once('scripts/encryption.php'); # funciones de proteccion de datos

	import('core.bm_engine'); 
	date_default_timezone_set(TIMEZONE);
	import('core.engine.database'); 
	import('core.engine.template'); 
	import('core.engine.page'); 
	import('core.engine.frontController'); 
	import('core.handler.http'); 
	import('core.handler.controller'); 
	import('core.handler.object'); 
	import('core.handler.extendedObject'); 
	import('core.handler.sessionHandler'); 
	import('core.handler.MysqliHandler');
	import('core.orm.helper');
	
	import('scripts.acceso');
	import('scripts.loghandler');
	import('scripts.pdf.fpdf');
	import('scripts.pdf.report');
	import('scripts.alias');
	
	import('mdl.error'); 

#####	configuraciones iniciales	#####

	BM::singleton()->storeObject('template','temp'); 
	BM::singleton()->storeObject('database','db');
	BM::singleton()->storeSetting('default', 'skin');
	BM::singleton()->getObject('temp')->getPage()->setJs('static/js/business.manager.1.0.js');
	BM::singleton()->getObject('temp')->getPage()->setJs('static/js/jquery.min.js');

	BM::singleton()->getObject('db')->newConnection(HOST,USER,PASSWORD,DATABASE);

#####	fin de configuraciones #####

	$front = new frontController(array()); # crear controlador 'front'
	$front->run(); # correr controlador 'front'
	exit();
?>
