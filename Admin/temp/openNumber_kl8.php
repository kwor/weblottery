<?php 
define('Copyright', 'Lottery');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'classed/SumOuntkl8.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
global $Users, $ConfigModel;
if ($Users[0]['g_login_id'] != 89) exit;
$lm = 'kl8';
if (isset($Users[0]['g_lock_1_5'])){
	if ($Users[0]['g_lock_1_5'] !=1) 
		exit(back('您的權限不足！'));
}
markPos("后台-快乐8开奖");
$numberList = numberList(8, true);
$page = $numberList['page'];

function isNumbers($arr){
	foreach ($arr as $value) {
		if ($value >80) return false;
	}
	return true;
}
$db = new DB();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (!empty($_POST['s_num1'])&&!empty($_POST['s_num2'])&&!empty($_POST['s_num3'])&&
		  !empty($_POST['s_num4'])&&!empty($_POST['s_num5'])&&!empty($_POST['s_num6'])&&
		  !empty($_POST['s_num7'])&&!empty($_POST['s_num8'])&&
		  !empty($_POST['s_num9'])&&!empty($_POST['s_num10'])&&!empty($_POST['s_num11'])&&!empty($_POST['s_num12'])&&!empty($_POST['s_num13'])&&
		  !empty($_POST['s_num14'])&&!empty($_POST['s_num15'])&&!empty($_POST['s_num16'])&&
		  !empty($_POST['s_num17'])&&!empty($_POST['s_num18'])&&
		  !empty($_POST['s_num19'])&&!empty($_POST['s_num20'])){
		  	if (!Matchs::isNumber($_POST['s_num1'])||!Matchs::isNumber($_POST['s_num2'])||
		  		  !Matchs::isNumber($_POST['s_num3'])||!Matchs::isNumber($_POST['s_num4'])||
		  		  !Matchs::isNumber($_POST['s_num5'])||!Matchs::isNumber($_POST['s_num6'])||
		  		  !Matchs::isNumber($_POST['s_num7'])||!Matchs::isNumber($_POST['s_num8'])||
		  		  !Matchs::isNumber($_POST['s_num9'])||!Matchs::isNumber($_POST['s_num10'])||
				  !Matchs::isNumber($_POST['s_num11'])||!Matchs::isNumber($_POST['s_num12'])||
		  		  !Matchs::isNumber($_POST['s_num13'])||!Matchs::isNumber($_POST['s_num14'])||
		  		  !Matchs::isNumber($_POST['s_num15'])||!Matchs::isNumber($_POST['s_num16'])||
		  		  !Matchs::isNumber($_POST['s_num17'])||!Matchs::isNumber($_POST['s_num18'])||
		  		  !Matchs::isNumber($_POST['s_num19'])||!Matchs::isNumber($_POST['s_num20'])){
		  		  	exit(back('開獎期數格式錯誤1！'));
		  	}
			for($i=1;$i<=20;$i++)
				$carr['g_ball_'.$i] = $_POST['s_num'.$i];
			
			$carr = array_unique($carr);
			if (!isNumbers($carr)){
				exit(back('開獎期數格式錯誤2！'));
			}
			$carr['g_date'] = $_POST['openDate'];
			if ($db->query("SELECT g_id FROM g_history8 WHERE g_id = '{$_GET['UpNumcid']}' LIMIT 1", 0)){
				$sql = "UPDATE g_history8 SET 
				g_date = '{$_POST['openDate']}',
				g_ball_1='{$_POST['s_num1']}',
				g_ball_2='{$_POST['s_num2']}',
				g_ball_3='{$_POST['s_num3']}',
				g_ball_4='{$_POST['s_num4']}',
				g_ball_5='{$_POST['s_num5']}',
				g_ball_6='{$_POST['s_num6']}',
				g_ball_7='{$_POST['s_num7']}',
				g_ball_8='{$_POST['s_num8']}',
				g_ball_9='{$_POST['s_num9']}',
				g_ball_10='{$_POST['s_num10']}',
				g_ball_11='{$_POST['s_num11']}',
				g_ball_12='{$_POST['s_num12']}',
				g_ball_13='{$_POST['s_num13']}',
				g_ball_14='{$_POST['s_num14']}',
				g_ball_15='{$_POST['s_num15']}',
				g_ball_16='{$_POST['s_num16']}',
				g_ball_17='{$_POST['s_num17']}',
				g_ball_18='{$_POST['s_num18']}',
				g_ball_19='{$_POST['s_num19']}',
				g_ball_20='{$_POST['s_num20']}'
				WHERE g_id = '{$_GET['UpNumcid']}' LIMIT 1";
				$db->query($sql, 2);
				exit(alert_href('更變成功。', 'openNumber_kl8.php'));
			}
	} else {
		if (!Matchs::isNumber($_POST['number'],6,6)) 
			if (!Matchs::isNumber($_POST['number'],7,7))  exit(back('開獎期數格式錯誤3！'));

		for ($i=1; $i<=20; $i++) {
			if ($_POST['num'.$i]== null) exit(back('開獎號碼選擇錯誤！'));
		}
		$arr['g_qishu'] = $_POST['number'];
		$arr['cry'] = $_POST['cry'];
		$arr['g_date'] = $_POST['openDate'];
		for($i=1;$i<=20;$i++)
			$carr['g_ball_'.$i] = $_POST['num1'.$i];

		$arr = array_unique($arr);
		
		$sql ="SELECT g_id FROM g_history8 WHERE g_qishu = '{$arr['g_qishu']}'  AND g_ball_1 is not null LIMIT 1";
		if ($db->query($sql, 0)){
			exit(back('第 '.$arr['g_qishu'].' 已經存在！'));
		} else {
			$sql = "INSERT INTO g_history8 (g_qishu, g_date, g_game_id, g_ball_1,g_ball_2,g_ball_3,g_ball_4,g_ball_5,g_ball_6,g_ball_7,g_ball_8,g_ball_9,g_ball_10,g_ball_11,g_ball_12,g_ball_13,g_ball_14,g_ball_15,g_ball_16,g_ball_17,g_ball_18,g_ball_19,g_ball_20) VALUES 
			(
				'{$arr['g_qishu']}',
				'{$arr['g_date']}',
				'8',
				'{$_POST['num1']}',
				'{$_POST['num2']}',
				'{$_POST['num3']}',
				'{$_POST['num4']}',
				'{$_POST['num5']}',
				'{$_POST['num6']}',
				'{$_POST['num7']}',
				'{$_POST['num8']}',
				'{$_POST['num9']}',
				'{$_POST['num10']}',
				'{$_POST['num11']}',
				'{$_POST['num12']}',
				'{$_POST['num13']}',
				'{$_POST['num14']}',
				'{$_POST['num15']}',
				'{$_POST['num16']}',
				'{$_POST['num17']}',
				'{$_POST['num18']}',
				'{$_POST['num19']}',
				'{$_POST['num20']}')";
			if ($db->query($sql, 2)){
				if ($_POST['cry'] == 1||$_POST['cry'] == 'on'){
					$SumAmount = new SumAmount($arr['g_qishu']);
					$SumAmount->ResultAmount();
				}
				exit(back('第 '.$arr['g_qishu'].' 寫入成功。'));
			}
		}
	}
}
else if (isset($_GET['startId']) && $_GET['startId'] == 1)
{
	//執行結算
	$numberId = $_GET['numId'];
	$sql ="SELECT g_id FROM g_history8 WHERE g_qishu = '{$numberId}' AND g_game_id =8 AND g_ball_1 is not null LIMIT 1";
	if ($db->query($sql, 0)){
		$SumAmount = new SumAmountkl8($numberId);
		$Result = $SumAmount->ResultAmount();
		if (is_array($Result)){
			exit(back('第 '.$numberId.' 結算完成，請查詢報表。'));
		} else {
			exit(back('第 '.$numberId.' 結算失敗！'));
		}
	} else {
		exit(back('第 '.$numberId.' 不存在列表中，請聯繫上級處理！'));
	}
}
else if (isset($_GET['numDelid']) || isset($_GET['Numdelid']))
{
	if (isset($_GET['numDelid'])){
		$numDelid = $_GET['numDelid'].' 24:00:00';
		$sql = "DELETE FROM g_history8 WHERE g_date < '{$numDelid}' ";
	} else {
		$numDelid = $_GET['Numdelid'];
		$sql = "DELETE FROM g_history8 WHERE g_id = '{$numDelid}' ";
	}
	$db->query($sql, 2);
	exit(back('刪除成功。'));
}
else if (isset($_GET['UpNumcid']))
{
	$UpNumcid = $_GET['UpNumcid'];
	$sql = "SELECT * FROM g_history8 WHERE g_id = '{$UpNumcid}' AND g_game_id = 8 LIMIT 1";
	$UpNums = $db->query($sql, 1);
}
else 
{
	for ($i=0; $i<10; $i++){$arr[$i] = $i+1;}
	//取出最近179期未結算注單
	$sql = "SELECT g_qishu FROM g_history8 WHERE g_game_id = 8 ORDER BY g_date DESC LIMIT 179";

	$Number = $db->query($sql, 1);
	$NumberArr = array();
	if ($Number){
		for ($i=0; $i<count($Number); $i++){
			$sql = "SELECT g_jiner, g_mingxi_1_str FROM g_zhudan WHERE g_qishu ='{$Number[$i]['g_qishu']}' AND g_win is null ";
			$result = $db->query($sql, 1);
			if ($result){
				$m = array('g_id'=>0, 'g_jiner'=>0);
				for ($n=0; $n<count($result); $n++){
					$m['g_qishu'] = $Number[$i]['g_qishu'];
					if ($result[$n]['g_mingxi_1_str'] == null){
						$m['g_jiner'] += $result[$n]['g_jiner'];
					}else {
						$m['g_jiner'] += $result[$n]['g_jiner'] * $result[$n]['g_mingxi_1_str'];
					}
				}
				$m['g_id'] += count($result);
				$NumberArr[] = $m;
			}
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<link href="/css/kl8.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script  type="text/javascript" src="/js/jquery.js"></script>
<script  type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
<title></title>
<script type="text/javascript">
<!--
	$(function(){
		var NumberList = $("#NumberList");
		var btns = $("#btns");
		if (location.href.indexOf("page")>0){
			NumberList.css("display", "");
			btns.val("關閉號碼");
		}
	});
	function isSumAmount(){
		var cry = document.getElementById("cry");
		var number = document.getElementById("number");
		if (number.value == "" || !(number.value.length == 6 || number.value.length == 7)){alert("開獎期數格式錯誤！");return false;}
		if(cry.checked){
			if (confirm("系統將會自動結算 "+number.value+" 期所有未結算注單，確認嗎？")){
				return true;
			}
			return false;
		}
	}

	function showNumber($this){
		var NumberList = $("#NumberList");
		if (NumberList.css("display") == "none"){
			NumberList.css("display", "");
			$this.value = "關閉號碼";
		} else {
			NumberList.css("display", "none");
			$this.value = "展開號碼";
		}
	}

	function delNums(){
		var NumList = $("#NumList").val();
		if (confirm(NumList+"之前的開獎記錄將被刪除，確定嗎？")){
			var href;
			if (location.href.indexOf("?")>0){
				href = location.href + "&numDelid="+NumList;
			} else {
				href = location.href + "?numDelid="+NumList;
			}
			location.href = href;
		}
	}

	function crySum(url){
		if (confirm("確定結算嗎？")){
			location.href=url;
		}
	}
	
	function numberUp(){
		var num = $("#numUp").val();
		if (num == "") {alert("請輸入期數"); return;}
		if (num.length != 6) {alert("請輸期數格式錯誤！"); return;}
		if(confirm("確定恢復 第 "+num+" 期 注單嗎？")){
			$.post("/AjaxAll/numberUp.php", {mid : 1, num : num, type : 6}, function(data){
				if(data != 1){
					alert("第 "+num+" 期不存在列表中或未結算，無法恢復。");
					return;
				} else {
					alert("第 "+num+" 期注單恢復完成");
				}
				location.href=location.href;
			}, "text");
		}
	}
-->
</script>
</head>
<body>
<form action="" method="post" onsubmit="return isSumAmount()">
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td><font style="font-weight:bold" color="#344B50">&nbsp;開獎管理--快樂8(雙盤)</font></td>
                            		<td>
                            		批量操作：<input class='textb' style="width:70px;text-align:center" id="NumList" name="NumList" value='<?php echo date("Y-m-d", mktime(0,0,0,date('m'),date('d')-7,date('Y')))?>' onfocus="WdatePicker({el:'NumList'})" />&nbsp;&nbsp;
                            		<input type="button" class="inputs" onclick="delNums()" value="確認刪除" />&nbsp;&nbsp;<span class="odds">注：系統將保留選定日期后的開獎記錄。</span>
                             		</td>
									<td align="right" width="100">
									<? include "openNumber_select.php";?>                   		
									</td>								
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                            		<?php if (!$UpNumcid){?><td width="60">結算</td><?php }?>
                                	<td width="110">開獎期數</td>
                                	<td width="140">開獎時間</td>
                                    <td>第1球</td>
                                    <td>第2球</td>
                                    <td>第3球</td>
                                    <td>第4球</td>
                                    <td>第5球</td>
                                    <td>第6球</td>
                                    <td>第7球</td>
                                    <td>第8球</td>
									<td>第9球</td>
									<td>第10球</td>
                                    <td>第11球</td>
                                    <td>第12球</td>
                                    <td>第13球</td>
                                    <td>第14球</td>
                                    <td>第15球</td>
                                    <td>第16球</td>
                                    <td>第17球</td>
                                    <td>第18球</td>
									<td>第19球</td>
									<td>第20球</td>
                                </tr>
                                <tr style="height:30px" align="center">
                                	<?php if (!$UpNumcid){?><td><input type="checkbox" id="cry" name="cry"  /></td><?php }?>
                                	<td>
                                	<?php if (!$UpNumcid){?>
                                	<input type="text" name="number" id="number" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' style="width:100px" />
                                	<?php } else { echo $UpNums[0]['g_qishu'];}?>
                                	</td>
                                    <td><input onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' style="width:130px;text-align:center" id="openDate" name="openDate" value='<?php if(!$UpNumcid){echo date('Y-m-d H:i:s');}else{echo $UpNums[0]['g_date'];} ?>' 
                                	/></td>
                                    <?php
                                    for($i=1;$i<=20;$i++)
									{
										echo "<td>\r\n";
										if (!$UpNumcid)
											echo '<input type="text" name="num'.$i.'" style="width:30px;" onfocus="this.className=\'inp1mMM\'" onblur="this.className=\'inp1MM\'" class=\'inp1MM\' value="'.$UpNums[0]['g_ball_'.$i].'" />';
										else
											echo '<input type="text" name="s_num'.$i.'" style="width:30px;" onfocus="this.className=\'inp1mMM\'" onblur="this.className=\'inp1MM\'" class=\'inp1MM\' value="'.$UpNums[0]['g_ball_'.$i].'" />';
										echo "</td>\r\n";		
									}
									?>
									<tr>
									                        <td colspan="23" class="f" align="center">
                        	<input type="submit" class="inputs" value="確認提交" />&nbsp;&nbsp;
                        	<input type="button" class="inputs" id="btns" onclick="showNumber(this)" value="展開號碼" />
                        </td>								
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" class="contergd"  style="width:900px" id="NumberList" align="center">
                            	<tr class="tr_top">
                            		<td width="100">開獎期數</td>
                                    <td width="120">開獎時間</td>
                                    <td colspan="20"><b>開出號碼</b></td>
                                    <td width="100">基本操作</td>
                            	</tr>
                            	<?php if (!$numberList){?><tr><td colspan="20" align="center">暫無記錄</td></tr><?php }else {?>
                                <?php for ($i=0; $i<count($numberList)-1; $i++){?>
                            	<tr align="center">
                            		<td><?php echo $numberList[$i][1]?>期</td>
                                    <td><?php echo $numberList[$i][2]?></td>
                                    <?php echo $numberList[$i][3] ?>
                                    <td>
										<table border="0" cellspacing="0" cellpadding="0">
			                                 <tr>
				                                 <td class="nones" width="14" height="18"><img src="/Admin/temp/images/edt.gif"/></td>
				                                  <td class="nones" width="30"><a href="openNumber_kl8.php?UpNumcid=<?php echo $numberList[$i][0]?>">修改</a></td>
				                                  <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
				                                  <td class="nones" width="30"><a onmousemove="status=''" href="javascript:if(confirm('確定刪除嗎？')){location.href= 'openNumber_kl8.php?Numdelid=<?php echo $numberList[$i][0]?>'}">刪除</a></td>
			                               </tr>
                           				</table>
									</td>
                            	</tr>
                            	<?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
					                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
									                        <td class="f" align="right">
<?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;期記錄</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>														
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
				 <br />
                <table border="0" cellspacing="0" class="conter" style="width:40%; margin:0 auto">
                	<tr>
                		<td style="height:30px; padding-left:5px;text-align:center">
	                		期數：<input id="numUp" type="text" class="text" />&nbsp;&nbsp;
	                		<input type="button" value="恢復未結算狀態" onclick="numberUp()" />
                		</td>
                	</tr>
                </table>
                <br />
                <table border="0" cellspacing="0" class="conter" style="width:40%; margin:0 auto">
                    <tr class="tr_top">
                        <td width="20%">期數</td>
                        <td>筆數</td>
                        <td>未結算金額</td>
                        <td width="15%">狀態</td>
                        <td width="15%">基本操作</td>
                    </tr>
                    <?php if(!$NumberArr){echo '<td colspan="5" align="center">暫無記錄</td>';}else{
                    	for ($i=0; $i<count($NumberArr); $i++){
                    	?>
                     <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                        <td><?php echo $NumberArr[$i]['g_qishu']?></td>
                        <td><?php echo $NumberArr[$i]['g_id']?></td>
                        <td class="red"><?php echo $NumberArr[$i]['g_jiner']?></td>
                        <td class="odds">待結算</td>
                        <td width="15%">
							<table border="0" cellspacing="0" cellpadding="0">
                                 <tr>     
                                    <td class="nones" width="16"><img src="/Admin/temp/images/55.gif" /></td>
                                    <td class="nones" width="30"><a href="javascript:void(0)" onclick="crySum('openNumber_kl8.php?startId=1&numId=<?php echo $NumberArr[$i]['g_qishu']?>')">結算</a></td>
                                 </tr>
                           </table>
						</td>
                    </tr>
                    <?php }}?>
				</table>
            <td width="5" bgcolor="#4F4F4F"></td>
					</td>
        </tr>
        <tr>
        	<td height="5" bgcolor="#4F4F4F"></td>
            <td bgcolor="#4F4F4F"></td>
            <td height="5" bgcolor="#4F4F4F"></td>
        </tr>
    </table>
    </form>
</body>
</html>