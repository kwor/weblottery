<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  
  Author: Version:1.0
  Date:2011-12-18
*/
if (!defined("Copyright"))
define('Copyright', 'Lottery');
if (!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'04:04:00';
global $stratGamexyft, $endGamexyft;
$_SESSION['cpopen'] = 4;
if (( strtotime($dateTime) < strtotime($stratGamexyft) &&  strtotime($dateTime) > strtotime($a)) || strtotime($dateTime) > strtotime($endGamexyft)){


//exit("$dateTime < $stratGametjssc || $dateTime > $endGametjssc");
markPos("前台-天津时时彩封盘页");
	header("Location: ./right.php"); exit;
}
?>