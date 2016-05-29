<?php
include 'functions.php';

$id =$error= "";

if(isset($_GET['id']))
{
	$id = sanitizeString ( $_GET['id'] );

	if ($id == "") {
		$error = "姓名ID为空！";
	} else {
		$query = " delete from user where id = '$id'";

		if (mysql_num_rows ( queryMysql ( $query ) ) == 0) {
			$error = "删除失败！";
		} else {
			$error = "删除成功！";
		}
		redirect('userlist.php');
	}
}

?>