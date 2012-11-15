<?php

$dbname = "writedb";
$dbuser = "write_user";
$dbpass = "write_pass";
$host = "localhost";




$connect = mysql_connect($host,$dbuser,$dbpass);

if (!$connect)
  echo "Couldn't connect!";
  
mysql_select_db($dbname, $connect);    

mysql_query("CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;");

?>