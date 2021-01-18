<?php
header("content-type:text/html;charset=utf-8");
if(!isset($_COOKIE["user"]) or $_COOKIE["user"]=="")
{
 	?>
	<script type="text/javascript">
	alert("您没有登录");
	</script>
	 <?php
	header("refresh:0;url=index.php");
}
else
{
	if(!isset($_POST["sub"]))
	{
		//include "kuangjia.php";
		echo "<center>";
		?>
		<meta charset="UTF-8">
		<style type="text/css">
			.btn-bubble {
			color: white;
			background-color: #77b11c;
			background-repeat: no-repeat;
			}
			.btn-bubble:hover, .btn-bubble:focus {
			-webkit-animation: bubbles 1s forwards ease-out;
					animation: bubbles 1s forwards ease-out;
			background: radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 90% 90% / 0.88em 0.88em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 23% 141% / 0.81em 0.81em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 17% 90% / 0.68em 0.68em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 15% 94% / 1.12em 1.12em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 42% 126% / 0.86em 0.86em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 102% 120% / 0.58em 0.58em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 12% 121% / 0.67em 0.67em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 69% 87% / 1.18em 1.18em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 32% 99% / 0.79em 0.79em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 84% 129% / 0.79em 0.79em, radial-gradient(circle at center, rgba(0, 0, 0, 0) 30%, #eeeeff 60%, #eeeeff 65%, rgba(0, 0, 0, 0) 70%) 40% 99% / 0.72em 0.72em;
			background-color: #77b11c;
			background-repeat: no-repeat;
			}

			@-webkit-keyframes bubbles {
			100% {
				background-position: 92% -220%, 31% -185%, 24% 6%, 16% -328%, 39% -366%, 110% -375%, 5% -60%, 59% -365%, 41% -363%, 82% -8%, 37% -224%;
				box-shadow: inset 0 -6.5em 0 #0072c4;
			}
			}

			@keyframes bubbles {
			100% {
				background-position: 92% -220%, 31% -185%, 24% 6%, 16% -328%, 39% -366%, 110% -375%, 5% -60%, 59% -365%, 41% -363%, 82% -8%, 37% -224%;
				box-shadow: inset 0 -6.5em 0 #0072c4;
			}
			}
			.btn {
			display: inline-block;
			text-decoration: none;
			padding: 1em 2em;
			}
			input{
				background:#c3dde0;
			}
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
			input[type=number]{
				width: 40px;
			} 
			.adjust {
			display: block;
			width: 5%;
			border: none;
			font-size: 32px;
			text-align: center;
			}
	</style>
		<form method="post" action="shoud.php" name="form1">
			<table class="hovertable" id="table1">
				<thead>
				<tr>
					<td></td>
					<td>Start Time</td><td>End Time</td>
					<td>MON</td><td>TUE</td><td>WED</td><td>THU</td><td>FRI</td><td>SAT</td><td>SUN</td>
				</tr>
				</thead>
	<?php
		include "config.php";
		$shop = $_COOKIE["shop"];
		$sql = "select * from $shift_table where shop='$shop'";
		$result = $mysqli->query($sql);
		$num=$result->num_rows;
		$i=0;
		if($num>0)
		{
			while($row=$result->fetch_array())
			{
				if(($i+1)%2 != 0)
				{
	?>
					<tr onmouseover="this.style.backgroundColor='#B7D2FF';" onmouseout="this.style.backgroundColor='#fff';" name="table[]">
	<?php		
				}
				else
				{
	?>
					<tr onmouseover="this.style.backgroundColor='#B7D2FF';" onmouseout="this.style.backgroundColor='#F5FAFA';" name="table[]">
	<?php
				}
	?>
					<td><input type="radio" name="radio"></td>
					<td><input type="time" value=<?php echo $row['start_time']?>></td>
					<td><input type="time" value=<?php echo $row['end_time']?>></td>
					<td><input type="number" name="tim[]" min="0" value=<?php echo $row['mon'] ?>></td>
					<td><input type="number" name="tim[]" min="0" value=<?php echo $row['tue'] ?>></td>
					<td><input type="number" name="tim[]" min="0" value=<?php echo $row['wed'] ?>></td>
					<td><input type="number" name="tim[]" min="0" value=<?php echo $row['thu'] ?>></td>
					<td><input type="number" name="tim[]" min="0" value=<?php echo $row['fri'] ?>></td>
					<td><input type="number" name="tim[]" min="0" value=<?php echo $row['sat'] ?>></td>
					<td><input type="number" name="tim[]" min="0" value=<?php echo $row['sun'] ?>></td>
				</tr>
	<?php
				$i++;
			}
	?>
				
	<?php
		}
	?>
			</table>
			<input type="button" value="add" onclick="addrow('table1')"/>
  				<input type="button" value="delete" onclick="deleterow('table1')"/>
				<script type="text/javascript" src="/jquery/jquery.js"></script>
				<script type="text/javascript">
					function addrow(id){
						const $large = "<tr>"
						+"<td><input type=\"radio\" name=\"radio\"></td>"
						+"<td><input type=\"time\"></td>"
						+"<td><input type=\"time\"></td>"
						+"<td><input type=\"number\" name=\"tim[]\" min=\"0\"></td>"
						+"<td><input type=\"number\" name=\"tim[]\" min=\"0\"></td>"
						+"<td><input type=\"number\" name=\"tim[]\" min=\"0\"></td>"
						+"<td><input type=\"number\" name=\"tim[]\" min=\"0\"></td>"
						+"<td><input type=\"number\" name=\"tim[]\" min=\"0\"></td>"
						+"<td><input type=\"number\" name=\"tim[]\" min=\"0\"></td>"
						+"<td><input type=\"number\" name=\"tim[]\" min=\"0\"></td>"
						+"</tr>"
						$("#"+id).append($large);
						Sequence();
					}
					function deleterow(id)
					{
						var tr=$("#"+id+" tr").find("input[name='radio']:checked");
						if(tr.val()=="on")
						{
							tr.parent().parent().remove();
							Sequence();
						}
						else
						{
							alert("請選擇要刪除的項");
						}
					}
					function Sequence()
					{
						var tr=$("#table1").find("tr").length;
						var xuhao=$("#table1").find("tr").find("td").eq("0");
						for(var i=0;i<tr;i++)
						{
							$("#table1").find("tr").eq(i).find("td").eq("0").text(i+1);
						}
					}
			</script>
			<br>
			<input type="submit" value="提交排班" name="sub" class="btn btn-bubble"/>
			<!--<input type="button" value="返回主界面" id="back1"/>-->
			</form>
			<script type="text/javascript">
			</script>		
						<!-- #section:basics/footer -->
						<div>
							<span class="bigger-120">
								<span class="blue bolder">Auto</span>
								arrange the schedua &copy; start 2019
							</span>
						</div>
							&nbsp; &nbsp;				
<?php
	}
	else{
		include('funtion.php');
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
		}
	}
	echo "<center>";
}
?>