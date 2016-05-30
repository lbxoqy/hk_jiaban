<?php
date_default_timezone_set('prc');
include 'header.php';
$datetime = date('Y-m-d H:i:s',time());

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">信息管理</li>
			  <li class="active"><a href="jiabanlist.php?count=all">考勤信息</a></li>
              <li><a href="userlist.php">用户信息</a></li>

            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;

$username = $expense = $error = $morningtime = $hometime ="";

if (isset( $_POST['morningtime'] ))
 {
	$username = sanitizeString ($_SESSION ['user']);
	$morningtime = sanitizeString ($_POST ['morningtime']);
<<<<<<< HEAD
	$hometime = sanitizeString($_POST['morningtime']);
=======
>>>>>>> da950c629c7ca9aebe122e5154d1ea3eb671261d
	
	// 判断加班时间是否有值
	if (empty($hometime)){
		$hometime = date('Y-m-d H:i:s',time());
<<<<<<< HEAD
		echo "自动填充时间";
=======
>>>>>>> da950c629c7ca9aebe122e5154d1ea3eb671261d
	}
	$comptime = (strtotime($hometime) - strtotime($morningtime))/86400*24 - 1.5;// 总工作时间小时制
	$expense = sanitizeString ( $_POST ['expense'] );
	
	// 计算加班时间
	if ($username == "" || $morningtime == "")
		$error = "存在字段不能为空";
	else {
				
			// queryMysql ( "INSERT INTO user(account,nickname,password,workid,entrydate,email) VALUES('$username','$name','$password','$workid','$entrydate','$email')" );
			$jiaban_sql = "INSERT INTO jiaban(account,morningtime,hometime,expense,comptime) VALUES ('$username','$morningtime','$hometime',$expense,$comptime)";
			//echo($jiaban_sql);
			queryMysql ($jiaban_sql);
			
			$error = "加班记录成功";
			echo "<script>alert('亲，记得打卡哦，不然你就白填了哦！！！')</script>";
			redirect('jiabanlist.php?count=all');
		
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
	 
  }
  setInterval("getCurrTime()",10);
</script>

<div class="well">

<form class="form-horizontal" action='createjiaban.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">新增加班记录</legend>
    </div>
         
    <div class="control-group">
      <!-- morningtime -->
      <label class="control-label"  for="morningtime">早上打卡时间:</label>
      <div class="controls">
		<input type="text" id="morningtime" name="morningtime" class="input-xlarge" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
       
      </div>
    </div>
	
	<div class="control-group">
      <!-- hometime-->
      <label class="control-label" for="hometime">下班打卡时间: </label>
	    <div class="controls">
		<input type="text" id="hometime" name="hometime" class="input-xlarge" id="d413" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
<<<<<<< HEAD
        <p > <div id="showDate">默认时间:</div></p>
=======
        <p > <div id="showDate">默认时间:$date</div></p>
>>>>>>> da950c629c7ca9aebe122e5154d1ea3eb671261d
      </div>
	 </div>
 
	 <div class="control-group">
      <!-- expense-->
      <label class="control-label" for="expense">餐补: </label>
	    <div class="controls">
		<select id="expense" name="expense" class="input-xlarge">
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