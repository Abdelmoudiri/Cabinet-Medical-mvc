<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	define('DBNAME', 'db_medical');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');
	
	define('ROOT', 'http://localhost/cabinet_medical_mvc/public');

}
define('APP_NAME', "My Webiste");
define('APP_DESC', "Best website on the planet");

/** true means show errors **/
define('DEBUG', true);
