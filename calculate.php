<!--每人最多一班-->
<?php
//手动排班的结果
header("content-type:text/html;charset=utf-8");
if(!isset($_COOKIE["user"]))
{
	?>
	<script type="text/javascript">
	alert("您没有登录");
	</script>
	 <?php
	//header("refresh:0;url=index.php");
}
else
{
	include "config.php";
	for($i=1;$i<=14;$i++)
	{
		$sql="select * from $test_table where quan ='$i' and answer =1 order by RAND() Limit 2 ";
		$result=$mysqli->query($sql) or die($mysqli->error);
		//$arrayName=array();
		//$num=$result->num_rows;
		$arrayxy=array();
		while($row=$result->fetch_array())
		{
			while($arrayxy <2){
				array_push($arrayxy,$row);
			}
		}
	}
	
?>
	<script type="text/javascript">
	alert("自动排班成功");
	</script>
	 <?php
	 header("refresh:0;url=end_print.php");
}
class min
{
		public $row=0, $col=0,$sum=0;
}
function digui($ij,$j,&$newarrayxy,&$newuser){
	$min=new min();
		$min->sum=$j+1;
		for($i=0;$i<$ij;$i++)//列
		{
			$sum=0;
			
			for($m=0;$m<$j;$m++)//行
			{
				$sum+=$newarrayxy[$m][$i];
				//if($sum==1){$temp1=$m;$temp2=$i;}
			}
			if($min->sum>$sum&&$sum>0)
			{
				$min->sum=$sum;
				for($x=0;$x<$j;$x++)
				{
					if($newarrayxy[$x][$i]==1)
					{
						$min->row=$x;$min->col=$i;
					}
				}
			}

		
		if($min->sum>=1&&$min->sum<=$j)
		{
			$newuser[$min->row][$min->col]=1;
			//$newarrayxy[$min->row()][$min->col()]=1;
			$temp1=0;$temp2=0;
			for($temp1=0;$temp1<$j;$temp1++)$newarrayxy[$temp1][$min->col]=0;
		    for($temp2=0;$temp2<$ij;$temp2++)$newarrayxy[$min->row][$temp2]=0;
		    	digui($ij,$j,$newarrayxy,$newuser);
		}
		else
			return 0;
}
}//function每人最多一班的排法






