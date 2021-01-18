<?php
//检验该用户是否有历史交班记录
header("content-type:text/html;charset=utf-8");
echo "<center>";
//include "owntable.php";
echo "欢迎使用排班系统";
include "config.php";
$uname=$_COOKIE["user"];
$sql="select * from $test_table where uname='$uname'";
$result=$mysqli->query($sql);
$num=$result->num_rows;
if($num==0)
{
	echo "还没有历史提交排版记录";
	echo "<p><a href='add_table.php'>点击添加排班</a>";
}
else
{
	echo "下面为您提交的历史记录";
	echo "<table  width='600'>";
	?><style type="text/css">tr,input{background: #F5FAFA;}</style><?php
	echo "<tr bgcolor='#B7D2FF'><td></td><td>MON</td><td>TUE</td><td>WED</td><td>THU</td><td>FRI</td><td>SAT</td><td>SUN</td></tr>";
	$i=0;
	while($row=$result->fetch_array())
	{
		if($i%7==0&&$i!=0)
		{
			echo "</tr>";
		}
		if($i%7==0)
		{
			echo "<tr bgcolor='#F5FAFA'>";
			$x=$i/7+1;
			if($x ==1){
				echo "<td>Day Shift</td>";
			}
			else{
				echo "<td>Night Shift</td>";
			}
			
		}
		if($row["answer"]==1)
		{
				echo "<td bgcolor='#B7D2FF' align='center'>Availabe</td>";
		}
		else
		{
				echo "<td></td>";
		}
		$i++;
	//echo "<p><a href='add_table.php'>点击添加排班</a>";
	}
	echo "</tr>";
	echo "</table>";
	echo "<p><p>";
	echo "<a href='add_table.php'><input type='button' value='点击修改为新的排班';/></a>";

}
?><div class="footer">
				<div class="footer-inner" >
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Auto</span>
							arrange the schedua &copy; start 2019
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
			</div><?php


echo "</center>";
?>