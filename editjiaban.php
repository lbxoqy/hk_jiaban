<?php
include 'header.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">信息管理</li>
			  <li class="active"><a href="jiabanlist.php">考勤信息</a></li>
              <li><a href="userlist.php">用户信息</a></li>
			  
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;

$username = $expense = $error = $morningtime = $id = $hometime = "";

if (isset($_POST['morningtime']))
 {
	$morningtime = sanitizeString ($_POST ['morningtime']);
	$hometime = sanitizeString ($_POST ['hometime']);
	$expense = sanitizeString ($_POST ['expense']);
	$jiabanid = sanitizeString ($_POST ['jiabanid']);
	
	// 判断加班时间是否有值
	if (empty($hometime)){
		$hometime = date('Y-m-d H:i:s',time());
	}
	
	$comptime = (strtotime($hometime) - strtotime($morningtime))/86400*24;// 小时制
	if ($morningtime == "")
		$error = "早上打卡时间不能为空哦";
	else {
		//echo "jiabanid:".$jiabanid; 
		$update_sql = "update jiaban set morningtime='$morningtime',hometime='$hometime',expense=$expense,comptime=$comptime where id = $jiabanid";
		//$update_sql = "select * from jiaban";
		//echo $update_sql;
		queryMysql ($update_sql);
		$error = "考勤信息修改成功";
		echo "<script>alert('亲，记得打卡啊！！！')</script>";
		redirect('jiabanlist.php?count=all');
	}
}
else
{
	if(isset($_GET['jiabanid']))
	{
		$jiabanid = sanitizeString ( $_GET['jiabanid'] );
	
		if ($_GET['jiabanid'] == "") {
			$error = "加班记录id为空！";
		} else {
			
			$query = " select account,morningtime,hometime,expense from jiaban where id = $jiabanid";
			//echo $query;
	
			$result = queryMysql($query);
			if (mysql_num_rows($result))
			{
				$row  = mysql_fetch_row($result);
				$username = stripslashes($row[0]);
				$morningtime = stripslashes($row[1]);
				$hometime = stripslashes($row[2]);
				$expense = stripslashes($row[3]);
				//echo $morningtime;
				
			}else $error = "查询不到该考勤信息！";
	
		}
	}
}
		

echo <<<END

<script>
  function getCurrTime(){
     var date=new Date();
	 var weekArray=new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	 var str= date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()+" "+weekArray[date.getDay()];
	 var str1 = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
	 document.getElementById("showDate").innerHTML="可不填，默认当前时间：" + str1;
	 document.getElementById("showTime").innerHTML=str1;
  }
  setInterval("getCurrTime()",10);
</script>

<div class="well">

<form class="form-horizontal" action='editjiaban.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">修改加班记录</legend>
    </div>
    
	<div class="control-group">
      <!-- morningtime -->
      <label class="control-label"  for="jiabanid">考勤信息记录ID:</label>
      <div class="controls">
		<input type="text" readonly="readonly" id="jiabanid" name="jiabanid" value="$jiabanid" class="input-xlarge" />
      </div>
    </div>
	
    <div class="control-group">
      <!-- morningtime -->
      <label class="control-label"  for="morningtime">早上打卡时间:</label>
      <div class="controls">
		<input type="text" id="morningtime" name="morningtime" value="$morningtime" class="input-xlarge" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
        <p class="help-block">请输入早上打卡的时间</p>
      </div>
    </div>
	
	<div class="control-group">
      <!-- hometime-->
      <label class="control-label" for="hometime">下班打卡时间: </label>
	    <div class="controls">
		<input type="text" id="hometime" name="hometime" value="$hometime" class="input-xlarge" id="d413" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
        <p > <div id="showDate">默认时间:</div></p>
      </div>
	 </div>
 
	 <div class="control-group">
      <!-- expense-->
      <label class="control-label" for="expense">餐补: </label>
	    <div class="controls">
		<select id="expense" name="expense" class="input-xlarge" value="$expense">
            <option value="0">0</option>
            <option value="15">15</option>
        </select>
      </div>
	 </div>
	 				
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">保  存</button> &nbsp;&nbsp;
        <a class="btn" href='jiabanlist.php?count=all'>返 回</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>