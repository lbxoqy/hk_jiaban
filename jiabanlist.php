
<?php
include 'header.php';

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

<div class="btn-toolbar">
    <a id="newjiaban" class="btn btn-primary" href="createjiaban.php" >新 建</a>
	<a class="btn" href="jiabanlist.php?count=01" >一月</a>
	<a class="btn" href="jiabanlist.php?count=02" >二月</a>
	<a class="btn" href="jiabanlist.php?count=03" >三月</a>
	<a class="btn" href="jiabanlist.php?count=04" >四月</a>
	<a class="btn" href="jiabanlist.php?count=05" >五月</a>
	<a class="btn" href="jiabanlist.php?count=06" >六月</a>
	<a class="btn" href="jiabanlist.php?count=07" >七月</a>
	<a class="btn" href="jiabanlist.php?count=08" >八月</a>
	<a class="btn" href="jiabanlist.php?count=09" >九月</a>
	<a class="btn" href="jiabanlist.php?count=10" >十月</a>
	<a class="btn" href="jiabanlist.php?count=11" >十一月</a>
	<a class="btn" href="jiabanlist.php?count=12" >十二月</a>
</div>
<div><p><small>注：早上上班标准时间为9点整，下午下班标准时间为18点整，可弹性时长为30分钟， 晚上超过20点才算加班时间！</small></p></div>
END;

echo <<<END
		
<div class="well">
    <table class="table">
      <thead>
        <tr>
		  <th>序号</th>
          <th>姓名</th>
         
		  <th>工号</th>

		   
		  <th>上班时间</th>
		  <th>弹性时长</th>
		 
		  <th>下班时间</th>
		  <th>工作时长</th>
		  <th>加班时长</th>
		  <th>餐补</th>
		  <th>修改</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
END;

function check($count){
	$account = $_SESSION ['user'];
	$jiaban_sql = "";
	// 组装出日期，当前年月
	if ($count=="all"){
		$year_mon = date("Y-m"); 
	}else{
		$year_mon = date("Y")."-".$count;
	}
	$jiaban_year_mon = '%'.$year_mon.'%';
	if ($account=="admin" || $account=="administrator" ){
		$jiaban_sql = "select id,account,morningtime,hometime,comptime,expense from jiaban where morningtime like '$jiaban_year_mon' ORDER BY morningtime desc "; // 查询jiabab表的内容
		
	}else{
		$jiaban_sql = "select id,account,morningtime,hometime,comptime,expense from jiaban where morningtime like '$jiaban_year_mon' and account= '$account' ORDER BY morningtime desc "; // 查询jiabab表的内容
	}
	//echo $jiaban_sql;
	return $jiaban_sql;
	
}

$jiaban_sql = check($_GET['count']);


//echo ($jiaban_sql);
$jiaban_result = queryMysql($jiaban_sql);
$num  = mysql_num_rows($jiaban_result);

for ($j = 1 ; $j < $num + 1 ; ++$j)
{
	$jiaban_rows = mysql_fetch_row($jiaban_result);
	$account = $jiaban_rows[1];
	$user_sql = "select nickname,sex,workid,entrydate from user where account = '$account'";
		
	$user_result = queryMysql($user_sql);
	$user_rows = mysql_fetch_row($user_result);
	
	$morningtime = $jiaban_rows[2];
	//echo "morningtime ".$morningtime."<br>";
	$stdmorningtime = substr($morningtime,0,10); // 组装早上正常打卡时间
	$stdmorningtime = $stdmorningtime." 09:00:00";
	//echo $stdmorningtime.'<br>';
	
	$stdhometime = substr($morningtime,0,10); // 组装下班正常打卡时间
	$stdhometime = $stdhometime." 18:00:00";
	
	$stdjiabantime = substr($morningtime,0,10); // 组装加班正常打卡时间--大于20:00
	$stdjiabantime = $stdjiabantime." 18:00:00";
	
	$latetime = ceil((strtotime($morningtime) - strtotime($stdmorningtime))/60); // 迟到或早到时间（分钟）
	//echo "latetime ".$latetime.'<br>';
	
	$hometime = $jiaban_rows[3];
	//echo "hometime ".$hometime."<br>";
	$dayworktime = (strtotime($hometime) - strtotime($morningtime))/3600 - 1.5; // 一天的工作时长（小时）
	$dayworktime = round($dayworktime,2);
	//echo "dayworktime ".$dayworktime."<br>";
	
	$counttime = ""; // 加班时长
	$counttime = (strtotime($hometime) - strtotime($morningtime))/3600 - 7.5 - 1.5; // 总的时间减去7.5h必须的上班时间，1.5h的中午休息时间(公司不按照这个算法)
	$counttime = (strtotime($hometime) - strtotime($stdjiabantime))/3600; // 公司的算法，直接下班时间减去18点的时间
	$counttime = round($counttime,2);
	//echo "counttime ".$counttime."<br>";
	
	if (strtotime($hometime) > strtotime($stdjiabantime) && $counttime > 2){ // 时间大于20:00点，并且时间超过2个小时
		$counttime = round($counttime,2);
	}else{
		$counttime = 0;
	}
	
	//echo "counttime ".$counttime.'<br>';
	
    echo <<<END
       <tr>
		  <td>$j</td>
          <td>$user_rows[0]</td>
         
          <td>$user_rows[2]</td>
		  
		  
		  <td>$jiaban_rows[2]</td>
		  <td>$latetime(分钟)</td>
		 
		  <td>$jiaban_rows[3]</td>
		  <td>$dayworktime(小时)</td>  
		  <td>$counttime(小时)</td>
		  <td>$jiaban_rows[5]</td>
          <td>
              <a href="editjiaban.php?jiabanid=$jiaban_rows[0]"><i class="icon-pencil"></i></a>
          	  <a href="deletejiaban.php?jiabanid=$jiaban_rows[0]"><i class="icon-remove"></i></a>
              <!--<a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>-->
          </td>
        </tr>
END;
    
}

echo <<<END

      </tbody>
    </table>
</div>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">确认</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">您确认删除这个用户吗?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-danger" data-dismiss="modal">删除</button>
    </div>
</div>

END;

include 'bottom.php';
?>