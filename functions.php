<?php // Example 21-1: functions.php
$dbhost  = 'localhost';    // Unlikely to require changing
$dbname  = 'mysms';       // Modify these...
$dbuser  = 'root';   // ...variables according
$dbpass  = 'hk@test';   // ...to your installation
$appname = "Bruce博客管理系统"; // ...and preference       

mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
mysql_query("set character set 'utf8'");//读库 
mysql_query("set names 'utf8'");//写库 

function createTable($name, $query) // 创建表
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br />";
}

function queryMysql($query) // 查询表数据
{
    $result = mysql_query($query) or die(mysql_error());
	 return $result;
}

function destroySession() // 关闭session
{
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var) // 不知道干啥的
{
    $var = strip_tags($var); // 去掉html标签
    $var = htmlentities($var); // 字符串转为html实体
    $var = stripslashes($var); //　删除反斜杠
    return mysql_real_escape_string($var);
}

function redirect($url) // 重定向到指定url
{
	echo "<script type=text/javascript>window.location.href='$url';</script>";
}


?>
