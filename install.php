	<center>
	<?php
	header("content-type:text/html;charset=utf-8");
	if(!isset($_POST["user"]))
	{
		?>
		<table border=1>
		<form action="install.php" method="post">
		<tr>
		<td colspan="2" align="center">输入管理员信息</td>
		</tr>
		<tr>
		<td>输入管理员名称</td>
		<td><input type="text" name="user"></td>
		</tr>
		<tr>
		<td>输入管理员密码</td>
		<td><input type="password" name="pass"></td>
		</tr>
		<tr>
		<td colspan="2" align="center" ><input type="submit" value="开始安装"> </td>
		<td colspan="2" align="center" ><input type="submit" value="卸载"> </td>
		</tr>
		</form></table>
		<?php
	}
	else
	{
		include "config.php";	
//Create table for user information
		$sql1="create table $test_user(
		id int(6) not null auto_increment primary key,
		name varchar(12) not null default '',
		pass varchar(12) not null default '',
		tel varchar(12) not null default '',
		shop varchar(2) not null default '',
		partment varchar(12) not null default '',
		admin int(1) not null default 0
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		$step1=$mysqli->query($sql1) or die($mysqli->error);
//Create table for staffs' availible time
		$sql2="create table $test_table(
		content varchar(200) not null default '',
		uname varchar(12) not null default '',
		answer int(3) not null default 0,
		quan int(5) not null default 0,
		shop varchar(2) not null default ''
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		$step2=$mysqli->query($sql2) or die($mysqli->error);
//Create table for weekly shift 
		$sql3="create table $end_table(
		content varchar(200) not null default '',
		uname varchar(12) not null default '',
		answer int(3) not null default 0,
		quan int(5) not null default 0,
		shop varchar(2) not null default ''
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		$step3=$mysqli->query($sql3) or die($mysqli->error);
//Create table for weekly shift 
		$sql4="create table $shift_table(
		start_time TIME(6) not null default 0,
		end_time TIME(6) not null default 0,
		mon INT(8) not null default 0,
		tue INT(8) not null default 0,
		wed INT(8) not null default 0,
		thu INT(8) not null default 0,
		fri INT(8) not null default 0,
		sat INT(8) not null default 0,
		sun INT(8) not null default 0,
		shop varchar(2) not null default ''
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		$step4=$mysqli->query($sql4) or die($mysqli->error);

		$user=$_POST["user"];
		$pass=$_POST["pass"];
		$sql5="INSERT INTO $test_user(name,pass,admin) values('$user','$pass',1)";
		$step5=$mysqli->query($sql5) or die($mysqli->error);
		if($step1)
		{
			echo "user成功安装<p>";
		}
		if($step2)
		{
			echo "test_table成功安装<p>";
		}
		if($step3)
		{
			echo "end_table成功安装<p>";
		}
		if($step5)
		{
			alert("成功新增管理員");
		}
		if($step1 and $step2  and $step3 and $step5)
		{
			echo "成功安装<p>";
			echo "<a href='login.php'>点击进入系统 </a>";
		}
	}
	?>
