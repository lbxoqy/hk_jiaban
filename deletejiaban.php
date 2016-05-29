<?php
include 'functions.php';

$jiabanid = $error = "";

if(isset($_GET['jiabanid']))
{
	$jiabanid = sanitizeString ( $_GET['jiabanid'] );
	
	if ($jiabanid == "") {
		$error = "没有获取到加班ID,删除失败！";
	} else {
		
		$query = " delete from jiaban where id = $jiabanid";

		if (mysql_num_rows ( queryMysql ( $query ) ) == 0) {
			$error = "删除失败！";
		} else {
			$error = "删除成功！";
		}
		redirect('jiabanlist.php?count=all');
	}
}

?>