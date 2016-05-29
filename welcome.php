<?php
include 'header.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">信息管理</li>
              <li class="active"><a href="createuser.php">新建用户</a></li>
              <li><a href="userlist.php">用户信息</a></li>
			  <li><a href="jiabanlist.php?count=all">考勤信息</a></li>
            </ul>
          </div><!--/.well --> 
        </div><!--/span-->
        <div class="span10">

END;


echo <<<END
		<div class="jumbotron">
		<h1>Hello, world!</h1>
			<p>...</p>
			<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
			</div>
		<div class="well">
		<h3>欢迎您！系统正在建设中。。。</h3>
		</div>

END;



include 'bottom.php';
?>