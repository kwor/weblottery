<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  
  Author: Version:1.0
  Date:2011-12-7
*/
//error_reporting(0);

if (!defined('ROOT_PATH'))
exit('invalid request');
if (!isset($_SESSION)) session_start();
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
//dump("aa");
include_once ROOT_PATH.'config/ConFinig.php';
include_once ROOT_PATH.'config/XHTML.php';
include_once ROOT_PATH.'classed/DeBe.php';
include_once ROOT_PATH.'classed/Pages.php';
include_once ROOT_PATH.'classed/Matches.php';
include_once ROOT_PATH.'classed/SumOunt.php';
include_once ROOT_PATH.'classed/SumOuntcq.php';
include_once ROOT_PATH.'classed/SumOuntpk.php';
include_once ROOT_PATH.'classed/AutoOdds.php';
include_once ROOT_PATH.'classed/AutoOddscq.php';
include_once ROOT_PATH.'classed/AutoOddspk.php';
include_once ROOT_PATH.'classed/GamInfo.php';
include_once ROOT_PATH.'classed/GamInfojx.php';
include_once ROOT_PATH.'classed/GamInfotj.php';
include_once ROOT_PATH.'classed/GamInfoxj.php';
include_once ROOT_PATH.'functioned/script.php';
include_once ROOT_PATH.'functioned/numberVal.php';
include_once ROOT_PATH.'functioned/parameter.php';
include_once ROOT_PATH.'functioned/pregMatch.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
include_once ROOT_PATH.'tools/IpApi/libs/Iplocation_Class.php';
include_once ROOT_PATH.'classed/check.classed.php';
//echo "bb";














?>