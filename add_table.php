<?php
header("content-type:text/html;charset=utf-8");
if (!isset($_POST["sub"])) 
{
	
	function aweek($gdate = "", $first = 0){
		if(!$gdate) $gdate = date("Y-m-d");
		$w = date("w", strtotime($gdate));//取得一周的第幾天,星期天開始0-6
		$dn = $w ? $w - $first : 6;//要減去的天數
		//本周開始日期
		$st = date("Y-m-d", strtotime("$gdate -".$dn." days"));
		//本周結束日期
		$en = date("Y-m-d", strtotime("$st +6 days"));
		//上周開始日期
		$last_st = date('Y-m-d',strtotime("$st - 7 days"));
		//上周結束日期
		$last_en = date('Y-m-d',strtotime("$st - 1 days"));
		return array($st, $en,$last_st,$last_en);//返回開始和結束日期
	}
	
    echo "<center>";
	echo "提交班表<p>";
	$week_array = aweek();
	echo date('Y-m-d', time()-86400*date('w')+(date('w')>0?86400:-6*86400))." ~ ".date('Y-m-d', time()-86400*date('w')+(date('w')>0?86400*7:-6*86400*7));
    ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">tr,input{background: antiquewhite;}</style>
		 <style type="text/css">

		 	input{background:#c3dde0;}
		table.hovertable {
			font-family: verdana,arial,sans-serif;
			font-size:11px;
			color:#333333;
			border-width: 1px;
			border-color: #999999;
			border-collapse: collapse;
		}
		table.hovertable thead td{
			background-color:#CCE8EB;
			border-width: 1px;
			padding: 8px;
			border-style: solid;
			border-color: #F5FAFA;
		}
		table.hovertable tr:nth-child(odd) {
			background:#fff;
		}
		table.hovertable tr:nth-child(even) {
			background:#F5FAFA;
		}
		table.hovertable td {
			border-width: 1px;
			padding: 8px;
			border-style: solid;
			border-color: #c3dde0;
		}


        input[type=checkbox] {
            position: relative;
            width: 10px;
            height: 1px;
        }
        input[type=checkbox]::before{
            content:'';
            position: absolute;
            top: 0;
            left: 0;
            width: 22px;
            height: 22px;
            line-height:22px;
            text-align: center;
            color:white;
            font-size:16px;
            background-color:#999;
            border-radius: 4px;
        }
        input[type=checkbox]:checked::before {
            color:black;
            background-color:#F5FAFA;
            content: 'V';
        }
        .close{
			background-color: #f44336;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
			position:fixed;
			top:10px;
			right:5px;
		}

.close:hover {
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}


    </style>
	</head>
	<body>
		<form method="post" action="add_table.php" name="form1">
		<table border="1" width='600' height='400' class="hovertable">
			<thead>
			<tr>
				<td></td><td>MON</td><td>TUE</td><td>WED</td><td>THU</td><td>FRI</td><td>SAT</td><td>SUN</td>
			</tr>
			</thead>
			<tr onmouseover="this.style.backgroundColor='#B7D2FF';" onmouseout="this.style.backgroundColor='#fff';">
				<td>Day Shift</td>
	<?php
		//確認是否之前有新增過
		//include "check_admin.php";
		include "config.php";
		$uname = $_COOKIE["user"];
		$shop = $_COOKIE["shop"];
		$sql = "select * from $test_table where uname='$uname'";
		$result = $mysqli->query($sql);
		$num=$result->num_rows;
		if($num==0){
	?>
				<td><input type="checkbox" name="tim[]" value="1"></td>
				<td><input type="checkbox" name="tim[]" value="2"></td>
				<td><input type="checkbox" name="tim[]" value="3"></td>
				<td><input type="checkbox" name="tim[]" value="4"></td>
				<td><input type="checkbox" name="tim[]" value="5"></td>
				<td><input type="checkbox" name="tim[]" value="6"></td>
				<td><input type="checkbox" name="tim[]" value="7"></td>
			</tr>
			<tr onmouseover="this.style.backgroundColor='#B7D2FF';" onmouseout="this.style.backgroundColor='#F5FAFA';">
				<td>Night Shift</td>
				<td><input type="checkbox" name="tim[]" value="8"></td>
				<td><input type="checkbox" name="tim[]" value="9"></td>
				<td><input type="checkbox" name="tim[]" value="10"></td>
				<td><input type="checkbox" name="tim[]" value="11"></td>
				<td><input type="checkbox" name="tim[]" value="12"></td>
				<td><input type="checkbox" name="tim[]" value="13"></td>
				<td><input type="checkbox" name="tim[]" value="14"></td>
			</tr>
		</table>
	<?php
		}
		else
		{	
			include "config.php";
			$uname = $_COOKIE["user"];
			$shop = $_COOKIE["shop"];
			$sql = "select * from $test_table where uname='$uname'";
			$result = $mysqli->query($sql);
			$i = 0;
			while($row=$result->fetch_array())
			{
					if($i%7==0&&$i!=0){
				?>
						</tr>
						<tr onmouseover="this.style.backgroundColor='#B7D2FF';" onmouseout="this.style.backgroundColor='#F5FAFA';">
							<td>Night Shift</td>
				<?php
					}
				?>
					<td><input type="checkbox" name="tim[]" value= "<?php echo $i+1 ?>" <?php echo ($row["answer"]==1 ? 'checked' : '');?>></td>
					<script>
						
					</script>
	<?php
				$i++;
			}
	?>
			</tr>
			</table>
	<?php
		}	
	?>	
		<input type="submit" value="确认提交" name="sub"/>
		</form>
		<div class="footer">
				<div class="footer-inner" >
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Auto</span>
							arrange the schedua &copy; start 2020
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>
	</body>
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
</html>

<?php
}
else {
    function insert()
    {
		include "config.php";
		$uname = $_COOKIE["user"];
		$shop = $_COOKIE["shop"];
        //删除以前的历史记录
        $sql = "delete from $test_table where uname='$uname'";
        $result = $mysqli->query($sql) or die($mysqli->error);
		$tim = $_POST["tim"];
        $m = 0;
        for ($i = 1; $i <= 14; $i++) {
            //$checktim=$_POST["tim['$i']"];
			//$_POST["tim['$i']"]==1
			$quan =0;
            if ($tim[$m] == $i) {
				if($i%2==0){
					$quan = (intval(($i-1)/2)+1)*100+2;
					$sql = "INSERT INTO $test_table(content,uname,answer,quan,shop) VALUES('$i','$uname',1,'$quan','$shop')";
					$result = $mysqli->query($sql) or die($mysqli->error);
				}
				else{
					$quan = (intval(($i-1)/2)+1)*100+1;
					$sql = "INSERT INTO $test_table(content,uname,answer,quan,shop) VALUES('$i','$uname',1,'$quan','$shop')";
					$result = $mysqli->query($sql) or die($mysqli->error);
				}
                if ($m < count($tim) - 1) {
                    $m++;
                }
            } else {
				if($i%2==0){
					$quan = (intval(($i-1)/2)+1)*100+2;
					$sql = "INSERT INTO $test_table(content,uname,answer,quan,shop) VALUES('$i','$uname',0,'$quan','$shop')";
					$result = $mysqli->query($sql) or die($mysqli->error);
				}
				else{
					$quan = (intval(($i-1)/2)+1)*100+1;
					$sql = "INSERT INTO $test_table(content,uname,answer,quan,shop) VALUES('$i','$uname',0,'$quan','$shop')";
					$result = $mysqli->query($sql) or die($mysqli->error);
				}
            }
		}	
        return 0;
    }
    if (insert() == 0) {
    ?>
		<script type="text/javascript">
		alert("成功更新排班");
		alert($shop);
		function closeWin(){
			window.opener=null;
			window.open('','_self');
			window.close();
		}
		closeWin();

  		</script>

<?php
        header("refresh:2;url=add_table.php");
	} 
	else 
	{
?>
  	<script type="text/javascript">alert("排班提交出错");</script>
<?php
		header("refresh:0;url=add_table.php");

    }
}
echo "</center>";

