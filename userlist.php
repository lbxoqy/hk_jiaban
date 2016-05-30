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
if ($_SESSION['user'] == "admin" || $_SESSION['user'] == "administrator"){
	echo <<<END
	<div class="btn-toolbar">
    <a class="btn btn-primary" href="createuser.php" >新 建</a>
</div>
END;
}


echo <<<END
		
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>用户名</th>
          <th>姓名</th>
		  <th>邮件</th>
          <th>状态</th>
		  <th>修改</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
END;


$result = queryMysql(" select id,account,nickname,email,status from user ORDER BY account asc ");
$num    = mysql_num_rows($result);

for ($j = 0 ; $j < $num ; ++$j)
{
    $row = mysql_fetch_row($result);

    echo <<<END
       <tr>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
          <td>$row[4]</td>
  

END;
	if ($_SESSION['user']=="admin" || $_SESSION['user']=="administrator"){ // 只有管理员才可以和修改用户
		echo <<<END
			<td>
            <a href="edituser.php?id=$row[0]"><i class="icon-pencil"></i></a>
          	<a href="deleteuser.php?id=$row[0]"><i class="icon-remove"></i></a>
            <!--<a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>-->
          </td>
        </tr>

END;
	}else{
		echo <<<END
			<td>
            <p>无权限</p>
          </td>
        </tr>
END;
	}

    
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