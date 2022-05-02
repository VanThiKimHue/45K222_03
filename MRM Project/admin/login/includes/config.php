<?php
// HTTP
define('HTTP_SERVER', 'http://chothuexemaydt.site/');
// HTTPS
define('HTTPS_SERVER', 'https://chothuexemaydt.site/');

// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','nhchoepq_root');
define('DB_PASS','chothuexemaydt');
define('DB_NAME','nhchoepq_bikerental');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
