<?php
include 'header.php';

echo <<<END
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">信息管理</li>
              <li><a href="jiabanlist.php?count=all">考勤信息</a></li>
              <li class="active"><a href="userlist.php">用户信息</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;

$username = $password = $name= $sex =$workid = $email = $id = $entrydate = $status= $remark = $error= "";

if (isset($_POST['username']))
 {
	$username = sanitizeString ( $_POST ['username'] );
	$password = sanitizeString ( $_POST ['password'] );
	$name = sanitizeString ( $_POST ['name'] );
	$sex = sanitizeString ($_POST['sex']);
	$email = sanitizeString ( $_POST ['email'] );
	$workid = sanitizeString ( $_POST ['workid'] );
	$entrydate = sanitizeString ( $_POST ['entrydate'] );
	$status = sanitizeString ( $_POST ['status'] );
	//$remark = sanitizeString ( $_POST ['remark'] );	
	
	if ($username == "" || $password == "" || $status == "")
		$error = "存在字段不能为空";
	else {
		queryMysql ( "update user set password = '$password',nickname = '$name',sex = '$sex', workid = '$workid',email='$email',status='$status' where account='$username' " );
		$error = "用户修改成功";
		redirect('userlist.php');
	}
}
else
{
	if(isset($_GET['id']))
	{
		$username = sanitizeString ( $_GET['id'] );
	
		if ($username == "") {
			$error = "姓名为空！";
		} else {
			$id = $_GET['id'];
			$query = " select account,password,nickname,sex,workid,entrydate,email,status from user where id = '$id'";
			//echo $query;
	
			$result = queryMysql($query);
			if (mysql_num_rows($result))
			{
				$row  = mysql_fetch_row($result);
				$username = stripslashes($row[0]);
				$password = stripslashes($row[1]);
				$name = stripslashes($row[2]);
				$sex = stripslashes($row[3]);
				$workid = stripslashes($row[4]);
				$entrydate = stripslashes($row[5]);
				$email =  stripslashes($row[6]);
				$stauts=  stripslashes($row[7]);
				//echo $entrydate;
				
			}else $error = "查询不到该用户！";
	
		}
	}
}
		

echo <<<END
<div class="well">
<form class="form-horizontal" action='edituser.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">修改用户</legend>
    </div>
	
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">用户名</label>
      <div class="controls">
        <input type="text" id="username" name="username" value="$username" placeholder="" class="input-xlarge"  required>
        <p class="help-block">请输入登录的用户名</p>
      </div>
    </div>
	
	<div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">密码</label>
      <div class="controls">
        <input type="password" id="password" name="password" value="$password" placeholder="" class="input-xlarge" required>
        <p class="help-block">请输入密码</p>
      </div>
    </div>
	
	<div class="control-group">
      <!-- name -->
      <label class="control-label"  for="name">姓名</label>
      <div class="controls">
        <input type="text" id="name" name="name" value="$name" placeholder="" class="input-xlarge"  required>
        <p class="help-block">请输入用户姓名</p>
      </div>
    </div>
	
	<div class="control-group">
      <!-- name -->
      <label class="control-label"  for="sex">性别</label>
      <div class="controls">
		<select id="sex" name="sex" class="input-xlarge">
            <option value="男">男</option>
            <option value="女">女</option>
        </select>
		<p class="help-block">请输入性别</p>
      </div>
    </div>

 
 	  <div class="control-group">
      <!--workid-->
      <label class="control-label" for="workid">工号</label>
      <div class="controls">
        <input id="workid" name="workid" value="$workid" placeholder="" class="input-xlarge">
        <p class="help-block">请输入工号</p>
      </div>
    </div>
	
	<div class="control-group">
      <!--entrydate-->
      <label class="control-label" for="entrydate">入职日期</label>
      <div class="controls">
		<input type="text" id="entrydate" name="entrydate" value="$entrydate" class="input-xlarge" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
        <p class="help-block">请输入入职日期</p>
      </div>
    </div>
	
	  <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">邮箱</label>
      <div class="controls">
        <input id="email" name="email" value="$email" placeholder="" class="input-xlarge" type="email">
        <p class="help-block">请输入邮箱</p>
      </div>
    </div>
    
	
    <div class="control-group">
		  <label class="control-label" for="status" >状态</label>
          <div class="controls">
            <select id="status" name="status" class="input-xlarge">
              <option value="1">启用</option>
              <option value="0">停用</option>
            </select>
          </div>
	</div>
	
			
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">保  存</button> &nbsp;&nbsp;
        <a class="btn" href='userlist.php'>返 回</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>