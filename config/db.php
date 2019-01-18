<?php
/*	
	Database Configuratons 
	Requires 'consts.php' to be includeds
*/
define(	'HOST',		'localhost');
define( 'USERNAME',	'root');
define( 'PASSWORD',	'403n-usmd-6r122g');
define( 'DATABASE',	'treasher_locked');

require( DOCUMENT_ROOT . 'classes/Database.php'	);
$db = new Database( HOST, USERNAME, PASSWORD, DATABASE );
?>