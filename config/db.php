<?php
/*	
	Database Configuratons 
	Requires 'consts.php' to be includeds
*/
define(	'HOST',		'localhost');
define( 'USERNAME',	'root');
define( 'PASSWORD',	'treasherlocked');
define( 'DATABASE',	'treasherlocked');

require( DOCUMENT_ROOT . 'classes/Database.php'	);
$db = new Database( HOST, USERNAME, PASSWORD, DATABASE );
?>