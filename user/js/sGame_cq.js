var setResultcq = new Array();
(function(){
	var _hiden, _endtime, _opentime, _refreshtime, _openNumber, _lock=false;			
	$(function(){
		$("#dp").attr("action","./inc/DataProcessingcq.php?idt="+encodeURI($("#tys").html()));
		_hiden = $("#hiden").val();
		_hiden = _hiden.replace("g","");
		loadGameInfo(false);
		loadDayInfo();
		setOpnumberTirem();
	});
	
	function loadGameInfo(bool){
		var number = $("#number");
		var sy = $("#sy");
		$.post("/AjaxAll/cqJson.php", { typeid : 1, mid : _hiden}, function(data){
			_Number (data.number, data.ballArr);
			openNumberCount(data, bool);
			sy.html((data.winMoney).toFixed(1));
		}, "json");
	}
	
	function loadDayInfo(){
		$.post("/AjaxAll/cqJson.php", { typeid : 2, mid : _hiden}, function(data){
			openNumber(data.Phases);
			opentimes(data.openTime);
			endtimes(data.endTime);
			refreshTimes(data.refreshTime);
			loadodds(data.oddslist, data.endTime, data.Phases);
			loadinput(data.endTime, _hiden);
		}, "json");
	}
	
	function loadinput(endtime, id){
		var loads = $(".loads");
		var count=lock1=lock2=lock3=lock4=lock5=0, s, n="封盤";
		loads.each(function(){
			if (endtime < 1){
				$(this).html(n);
			} else {
				count++;
				if (count<=14){
					lock1++;
					s = "Ball_"+id+"mah"+lock1;
				} else if (count >14 && count <22){
					lock2++;
					s = "Ball_6mbh"+lock2;
				} else if (count > 21 && count < 27){
					lock3++;
					s = "Ball_7mch"+lock3;
				} else if (count > 26 && count < 32){
					lock4++;
					s = "Ball_8mdh"+lock4;
				} else {
					lock5++;
					s = "Ball_9meh"+lock5;
				}
					n = "<input name=\""+s+"\" class=\"inp1\"  onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
				$(this).html(n);
			}
		});
	}
	
	function loadodds(oddslist, endtime, number){
		var a = ["a","b","c","d","e"];
		var odds, link, urls;
		if (oddslist == null || oddslist == "" || endtime <1) {
			$(".o").html("-");
			return false;
		}
		for (var n=0; n<oddslist.length; n++){
			for (var i in oddslist[n]){
				odds = oddslist[n][i];
				urls = "fn2.php?tid="+bc(a[n])+"&numberid="+number+"&hid="+a[n]+i;
				link = "<a href=\""+urls+"\"  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
				$("#"+a[n]+i).html(link);
			}
		}
	}
	
	function bc(str){
		switch (str){
			case "a" : return "Ball_"+_hiden;
			case "b" : return "Ball_6";
			case "c" : return "Ball_7";
			case "d" : return "Ball_8";
			case "e" : return "Ball_9";
		}
	}
	
	function openNumber(numberId){
		$("#o").html(numberId);
	}
	
	function opentimes(opentime){
		var openTime = $("#endTimes");
		_opentime = opentime;
		if (_opentime >1)
			openTime.html(settime(_opentime));
		var interval = setInterval(function(){
			if (_opentime <= 1) {
				clearInterval(interval);
				_lock = true;
				_refreshtime = 5;
				openTime.html("00:00");
				return false;
			}
			_opentime--;
			openTime.html(settime(_opentime));
		}, 1000);
	}
	
	function endtimes(endtime){
if(getCookie("soundbut")=="on" || getCookie("soundbut")==null || getCookie("soundbut")==""){
		SetCookie("soundbut","on");
		$("#soundbut").attr("value","on");
		$("#soundbut").attr("src","images/soundon.png");
		}else{
			$("#soundbut").attr("value","off");
		$("#soundbut").attr("src","images/soundoff.png");
			}
		var endTime = $("#endTime");
		_endtime = endtime;
		if (_endtime >1)
			endTime.html(settime(_endtime));
		var interval = setInterval(function(){
											if (_endtime<10&&_endtime>0){
												if($("#soundbut").attr("value")=="on"){
				$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/d.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");		}
						}	
			if (_endtime <= 1) {
				clearInterval(interval);
				endTime.html("00:00");
				loadodds(null, endtime, null);
				loadinput(-1, _hiden);
				return false;
			}
			_endtime--;
			endTime.html(settime(_endtime));
		}, 1000);
	}
	
	function refreshTimes(refreshtime){
		_refreshtime = refreshtime;
		var refreshTime = $("#endTimea");
		refreshTime.html(_refreshtime);
		var interval = setInterval(function(){
			if (_refreshtime <= 1) {
				refreshTime.html("加載中...");
				clearInterval(interval);
				$.post("/AjaxAll/cqJson.php", {typeid : 2, mid : _hiden}, function(data){
					if (_lock == true){
						endtimes(data.endTime);
						opentimes(data.openTime);
						loadinput(data.endTime, _hiden);
						 openNumber(data.Phases);
						 setOpnumberTirem();
						_lock = false;
					}
					 _endtime =data.endTime;
					 _opentime =data.openTime;
					 _refreshtime =data.refreshTime;
					 loadodds(data.oddslist, _endtime, data.Phases);
					 refreshTimes(_refreshtime);
				}, "json");
				return false;
			}
			_refreshtime--;
			refreshTime.html(_refreshtime);
		}, 1000);
	}
	
	function setOpnumberTirem(){
		var opnumber = $("#number").html();
		var nownumer = $("#o").html();
		if (opnumber != ""){
			var _nownumber = parseInt(nownumer);
			var sum = _nownumber -  parseInt(opnumber);
			if (sum == 2 || sum == 882) {
				var interval = setInterval(function(){
					$.post("/AjaxAll/cqJson.php", {typeid : 3}, function(data){
						var a = _nownumber - parseInt(data);
						if (a == 1 || a == 881){
							clearInterval(interval);
							loadGameInfo(true);
							return false;
						}
					}, "text");
				}, 2000);
			}
		} else {
			setTimeout(setOpnumberTirem, 1000);
		}
	}
	
	function _Number (number, ballArr) {
		var Clss = null;
		var idArr = ["#a","#b","#c","#d","#e","#f","#g","#h"];
		$("#number").html(number);
		for (var i = 0; i<ballArr.length; i++) {
			Clss = "No_cq"+ballArr[i];
		$(idArr[i]).removeClass().addClass(Clss);
		}
	}
	
	function openNumberCount(row, bool){
		var rowHtml1 = new Array();
		var rowHtml2 = new Array();
		var rowHtml3 = new Array();
		for (var i in row.row1){
			rowHtml1.push("<td>"+row.row1[i]+"</td>");
		}
		$("#su").html(rowHtml1.join(''));
		for (var k in row.row2){
			rowHtml2.push(row.row2[k]);
		}
		$("#z_cl").html(rowHtml2.join(''));
		$(".z_cl:even").addClass("hhg");
		if (row.row8 != ""){
			for (var key in row.row8){
				rowHtml3.push("<tr bgcolor=\"#fff\" height=\"20\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+key+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+row.row8[key]+" 期</td></tr>");
			}
			var cHtml = '<tr class="t_list_caption"><th colspan="2"><font color="#4A1A04">兩面長龍排行</font></th></tr>';
			$("#cl").html(cHtml+rowHtml3.join(""));
		}
		if (bool == true) {
	
			$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c1.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
	
		}
		setResultcq[0] = row.row2;
		setResultcq[1] = row.row3;
		setResultcq[2] = row.row4;
		setResultcq[3] = row.row5;
		setResultcq[4] = row.row6;
		setResultcq[5] = row.row7;
	}

	function settime(time){
		var MinutesRound = Math.floor(time / 60);
		var SecondsRound = Math.round(time - (60 * MinutesRound));
		var Minutes = MinutesRound.toString().length <= 1 ? "0"+MinutesRound : MinutesRound;
		var Seconds = SecondsRound.toString().length <= 1 ? "0"+SecondsRound : SecondsRound;
		var strtime = Minutes + ":" + Seconds;
		return strtime;
	}
})();

function getResult ($this){
	$(".nv_a").addClass("nv").removeClass("nv_a");
	$($this).removeClass("nv").addClass("nv_a");
	$(".nv_ab").removeClass("nv_ab");
	$($this).parent().addClass("nv_ab");
	var rowHtml = new Array();
	var data = stringByInt ($($this).html());
	for (var k in data){
		rowHtml.push(data[k]);
	}
	$("#z_cl").html(rowHtml.join(''));
	$(".z_cl:even").addClass("hhg");
}

function stringByInt (str){
	if (str == "第1球" || str == "第2球" || str == "第3球" || str == "第4球" || str == "第5球")
		return setResultcq[0];
	switch (str){
		case "大小" : return setResultcq[1];
		case "單雙" : return setResultcq[2];
		case "總和大小" : return setResultcq[3];
		case "總和單雙" : return setResultcq[4];
		case "龍虎和" : return setResultcq[5];
	}
}

function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function submitforms(){
	var ss="", a = false, c= true, count = countmoney =0, names=[], value, s, z, o, n, m;
	var input = $("input.inp1");
	var mixmoney = parseInt($("#mix").val());
	$.ajax({type : "POST",data : {typeid : "sessionId"},url : "../AjaxAll/Default.ajax.php",dataType : "text",async : false,success:function(data){a = data == 1 ? true : false;}});
	input.each(function(){
		value = $(this).val();
		if (value != ""){
			value = parseInt(value);
			if (value < mixmoney) {c=false;return;}
			count++;
			countmoney += value;
			s = $(this).attr("name").split("m");
			ss += s+","+value+"|";
			z = nameformatcq(s[0]);
			if(s[1]=="ah1" || s[1]=="ah2" || s[1]=="ah3" || s[1]=="ah4" || s[1]=="ah5" || s[1]=="ah6" || s[1]=="ah7" || s[1]=="ah8" || s[1]=="ah9" || s[1]=="ah10"  ){
			var tt=s[1].substr(2);
			m=tt-1;
			}else{
			m= $("."+s[1]).html();
			}
			o = $("#"+s[1]+" a").html();
			if (z == "總和、龍虎和")
				n = m+" @ "+o+" x ￥"+value;
			else 
				n = z+"["+m+"] @ "+o+" x ￥"+value;
			names.push(n+"\n");
		}
	});

	if (count == 0){
		 
			var timer;
			var con = '請填寫下註金額!!!';

			if(con != ''){
				art.dialog({
					title: '警告',
					content: '<span style="font-size:15px">'+ con +'</span>',
					init: function () {
						var that = this, i = 10;
						var fn = function () {
							that.title('警告( ' + i + ' 秒后关闭)');
							!i && that.close();
							i --;
						};
						timer = setInterval(fn, 1000);
						fn();
					},
					close: function () {
						clearInterval(timer);
					},
					ok: function () {
					}
				}).show();
			}
 
		return;
	}
	
	
	if (c == false){ 
	 
			var timer;
			var con = "最低下註金額："+mixmoney+"￥";

			if(con != ''){
				art.dialog({
					title: '警告',
					content: '<span style="font-size:15px">'+ con +'</span>',
					init: function () {
						var that = this, i = 10;
						var fn = function () {
							that.title('警告( ' + i + ' 秒后关闭)');
							!i && that.close();
							i --;
						};
						timer = setInterval(fn, 1000);
						fn();
					},
					close: function () {
						clearInterval(timer);
					},
					ok: function () {
					}
				}).show();
			}
 
	    return; 
	}		
	
	var confrims = "共 ￥"+countmoney+" / "+count+"筆，確定下註嗎？\n\n下註明細如下：\n\n";
	confrims +=names.join('');
	
	
	/*if (confirm(confrims)){
		input.val("");
		var number = $("#o").html();
		var s_type = '<input type="hidden" name="s_cq" value="'+ss+'"><input type="hidden" name="s_number" value="'+number+'">';
		$(".actiionn").html(s_type);
		return a;
	}
	return false;*/
	
    art.dialog({
        title: "下註提醒",
        content: confrims,
        //以“skins/icons/”目录下的图标名作为参数名（不包含后缀名）
        icon: "question",
        lock: true,//是否锁定屏幕，默认是false
        fixed: true,//静止在浏览器某个地方不动，不受滚动条拖动影响
        //time: 3,//如果有cancel方法的话会调用cancel方法
        okVal: "确认",
        ok: function () { 
			input.val("");
			var number = $("#o").html();
			var s_type = '<input type="hidden" name="s_cq" value="'+ss+'"><input type="hidden" name="s_number" value="'+number+'">';
			$(".actiionn").html(s_type);
			$("#dp").submit();
			 
		},
        cancelVal: "取消",
        cancel: function () {}
    }); 	
	
	
	
}

function nameformatcq(str){
	switch(str){
		case "Ball_1" : return "第一球";
		case "Ball_2" : return "第二球";
		case "Ball_3" : return "第三球";
		case "Ball_4" : return "第四球";
		case "Ball_5" : return "第五球";
		case "Ball_6" : return "總和、龍虎和";
		case "Ball_7" : return "前三";
		case "Ball_8" : return "中三";
		case "Ball_9" : return "后三";
	}
}



