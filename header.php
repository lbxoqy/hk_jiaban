<?php
session_start ();

include 'functions.php';

echo <<<END

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <title>考勤记录系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="logo.ico" />
	<script language="JavaScript" type="text/javascript" src="./My97DatePicker/WdatePicker.js"></script>
    
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
	  
	  .error{
	  color: Red;
	  font-size: 16px;
	  }
    </style>
    
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	  
    <![endif]-->
	
<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
		
  </head>

  <body>

END;

//echo $_SESSION['user'];

if (isset($_SESSION['user']))
{
	$user     = $_SESSION['user'];
	$loggedin = TRUE;
}
else $loggedin = FALSE;

if ($loggedin)
{
	echo  <<<END

	  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
		  
          <a class="brand" href="jiabanlist.php?count=all"><img src="./sourcefile/logo1.png"  alt="华康医疗" />  考勤记录系统</a>
			<div class="nav-collapse collapse">
		
			<p class="navbar-text pull-right">
              欢迎您， <a href="#" class="navbar-link">$user</a><a href="logout.php"><i class="icon-off"></i> 退出</a>
            </p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	
END;
	
}
else
{
	//die("您未登陆到系统，请重试！");
	redirect('login.php');
}

?>