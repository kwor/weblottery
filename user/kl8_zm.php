﻿<?php
header("content-type:text/html;charset=utf-8");
if(!defined("ROOT_PATH"))
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');

include_once ROOT_PATH.'user/offGamekl8.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(href('repore.php'));
$ConfigModel = configModel("`g_kl8_game_lock`, `g_mix_money`");
if ($ConfigModel['g_kl8_game_lock'] !=1)exit(href('right.php'));

$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$db=new DB();
$sql="select * from g_history8 order by g_date desc limit 19";
$jqhj=$db->query($sql,1);
$_SESSION['gx'] = false;
$_SESSION['gd'] = false;
$_SESSION['sz'] = false;
$_SESSION['cq'] = false;
$_SESSION['pk'] = false;
$_SESSION['kl8'] = true;
markPos("前台-快樂8(雙盤)");
?>
<HTML>
<HEAD>
<SCRIPT type=text/javascript>
var gametype="zm";
</SCRIPT>
<link href="css/sGame.css" rel="stylesheet" type="text/css"/>
<LINK rel=stylesheet type=text/css href="css/main_n1.css">
<LINK rel=stylesheet type=text/css href="/css/kl8.css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<SCRIPT type=text/javascript src="js/Forbid.js"></SCRIPT>
<script type="text/javascript" src="./js/odds_sm_kl8.js"></script>
<script type="text/javascript" src="./js/plxz.js"></script>

<link href="/user/artDialog4.1.7/skins/aero.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="/user/artDialog4.1.7/artDialog.source.js?skin=aero"></script>
<script type="text/javascript" src="/user/artDialog4.1.7/plugins/iframeTools.source.js"></script>

<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
		s = s[s.length-1];
		if (s !== "left.php")
			window.parent.frames.leftFrame.location.href = "/user/left.php";
			
				function soundset(sod){
if(sod.value=="on"){
sod.src="images/soundoff.png";
sod.value="off";
}
else{
sod.src="images/soundon.png";
sod.value="on";
}
SetCookie("soundbut",sod.value);
}
</script>
</HEAD>
<BODY style="margin-left: 15px;" onselectstart="return false">
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
  <TBODY>
    <TR>
      <TD class=F_bold height=24 width="20%">快樂8(雙盤)(<font color=#0000ff id="pk"></font>)　</TD>
      <TD class="bolds" style="color:red"><SPAN style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">今天輸贏：</SPAN> <SPAN
				id="UserResult" class="shuyingjieguo2">0.0</SPAN></td>
      <TD width="50%" align=right><B class=font_b style="font-size:12px;">正碼</B></TD>
    </TR>
    <TR>
      <TD class=F_bold height=23 colspan="3">
      <TABLE border=0 width="700" cellSpacing=0 cellPadding=0>
          <TBODY>
            <TR>
              <TD height=25 width=140><B id=UP_LID class=Font_Y>-</B><B>期开奖</B></TD>
              <TD id=BaLL_No1 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No2 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No3 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No4 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No5 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No6 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No7 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No8 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No9 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No10 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No11 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No12 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No13 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No14 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No15 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No16 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No17 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No18 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No19 class="ballskl8 b01" width=27>&nbsp;</TD>
              <TD id=BaLL_No20 class="ballskl8 b01" width=27>&nbsp;</TD>
            </TR>
          </TBODY>
        </TABLE>
      </TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
  <TBODY>
    <TR>
      <TD height=24 width="28%"><span id="o" style=" color:#009900; font-weight:bold; font-size:12px;position:relative; top:0px"></span><B id=t_LID class=Font_G></B>期&nbsp;&nbsp;&nbsp;</TD>
      <TD width="25%" align=right>距離封盤：<SPAN id=hClockTime_C>加载中...</SPAN></TD>
      <TD width="25%" align=right>距離開獎：<SPAN id=hClockTime_O class=Font_R>加载中...</SPAN></TD>
      <TD width="23%" align=right><SPAN id=Update_Time>66</SPAN>&nbsp;秒</TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=700>
  <TBODY>
    <TR>
      <TD class="td_caption_1 F_bold">正碼</TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=700>
  <TBODY>
  <?php
  for($i=1;$i<=20;$i++)
  {
  ?>
    <TR class=Ball_tr_H>
      <TD style="width:40px" class="ballskl8 b<?php echo sprintf("%02d",$i)?>"></TD>
      <TD width=87 ><SPAN class=multiple_Red id="h<?php echo $i?>">-</SPAN></TD>
      <TD width=82 class="load">封盤</TD>
      <TD style="width:40px" class="ballskl8 b<?php echo sprintf("%02d",$i+20)?>"></TD>
      <TD width=87 ><SPAN class=multiple_Red id="h<?php echo $i+20?>">-</SPAN></TD>
      <TD width=82 class="load">封盤</TD>
      <TD style="width:40px" class="ballskl8 b<?php echo sprintf("%02d",$i+40)?>"></TD>
      <TD width=87 ><SPAN class=multiple_Red id="h<?php echo $i+40?>">-</SPAN></TD>
      <TD width=82 class="load">封盤</TD>
      <TD style="width:40px" class="ballskl8 b<?php echo sprintf("%02d",$i+60)?>"></TD>
      <TD width=87 ><SPAN class=multiple_Red id="h<?php echo $i+60?>">-</SPAN></TD>
      <TD width=82 class="load">封盤</TD>
    </TR>
   <?php
  }
   ?>
  </TBODY>
</TABLE>

<div style="display: none; position: absolute;" class=""><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div class="aui_title" style="cursor: move;"></div><a class="aui_close" href="javascript:/*artDialog*/;">×</a></div></td></tr><tr><td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: transparent none repeat scroll 0% 0%;"></div></td><td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 30px 145px;"></div></td></tr><tr><td colspan="2" class="aui_footer"><div class="aui_buttons"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td class="aui_se" style="cursor: se-resize;"></td></tr></tbody></table></div></div>

<FORM method=post name=M_JeuForm
	action=L_Confirm_Jeu.php target=leftFrame autocomplete="off" id="dp">
  <input type="hidden" name="actions" value="fnpk3" />
  <input type="hidden" name="gtypes" value="1" />
  <input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
  <BR>
  <TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
    <TBODY>
      <TR>
        <td align="center" ><input onClick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
          <a class="font_g F_bold" onFocus="this.blur()" title="快捷下註" onClick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26">快捷下注</a> <span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;
          <input type="button" onClick="Shortcut_hidden();reset();eliminate_jeu();" class="inputs ti" value="重填" />
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input onclick = "submitforms()" type="button" id="submits" class="inputs ti" name=confirm  value="下註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
        <td id="actiionn"></td>
      </TR>
    </TBODY>
  </TABLE>
</FORM>
<BR>
<table class="wq" border="0" style="margin-left:0px;border-collapse:inherit" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption" height="25">
        <td width="16%" class="nv_a"><a id="defLT" class="nv" <?php echo $onclick?>>總和數</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv' width="16%"><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv' width="16%"><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv' width="17%"><a class="nv" <?php echo $onclick?>>五行</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv' width="17%"><a class="nv" <?php echo $onclick?>>前後和</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>單雙和</a></td>
    </tr>
    <tr>
    	<td colspan="6" class="t_td_text" align="center">
        	<table class="hj" border="0" style="border-collapse:inherit" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table>
<DIV id=LSL_Http></DIV>
<DIV style="POSITION: absolute; DISPLAY: block; TOP: 11px; LEFT: 713px;"
	id=RR_DIV>
  
</DIV>
<div id="look" ></div>
<?php include_once 'inc/cl_file.php';?>
<DIV id=PLAY_Sound1></DIV>
<BR>
<SCRIPT language=JAVASCRIPT>
if (parent.frames["leftFrame"].location.toString().indexOf("left")==-1) 
	parent.frames["leftFrame"].location='left.php';
</SCRIPT>
</BODY>
</HTML>