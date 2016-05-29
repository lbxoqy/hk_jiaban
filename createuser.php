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

$username = $workid = $name = $password = $sex= $entrydate = $email = $stauts = $remark = $error = "";

if (isset ( $_POST ['username'] ) && isset ( $_POST ['password']))
 {
	$username = sanitizeString ($_POST ['username']);
	$name = sanitizeString($_POST ['name']);
	$password = sanitizeString ($_POST ['password']);
	$sex = sanitizeString($_POST['sex']);
	$workid = sanitizeString ( $_POST ['workid'] );
	$entrydate = sanitizeString ( $_POST ['entrydate'] );
	$email = sanitizeString ( $_POST ['email'] );
	//$status = sanitizeString ( $_POST ['status'] );
	//$remark = sanitizeString ( $_POST ['remark'] );
	//echo "asdfasdf",$username,$password;
	if ($username == "" || $password == "")
		$error = "存在字段不能为空";
	else {
		if (mysql_num_rows ( queryMysql ( "SELECT * FROM user WHERE account='$username'" ) ))
			$error = "名称已经存在";
		else {
			queryMysql ( "INSERT INTO user(account,nickname,password,sex,workid,entrydate,email) VALUES('$username','$name','$password','$sex','$workid','$entrydate','$email')" );
			$error = "用户创建成功";
			redirect('userlist.php');
		}
	}
}
		
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='createuser.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">创建用户</legend>
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
		<input type="text" id="entrydate" name="entrydate" class="input-xlarge" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
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
    
	<!--
    <div class="control-group">
		  <label class="control-label" for="status" >状态</label>
          <div class="controls">
            <select id="status" name="status" class="input-xlarge">
              <option value="1">启用</option>
              <option value="0">停用</option>
            </select>
          </div>
	</div>
	-->
			
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