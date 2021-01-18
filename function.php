function insert(){
			include "config.php";
			$shop = $_COOKIE["shop"];
			//删除以前的历史记录
			$sql = "delete from $shift_table where shop='$shop'";
			$result = $mysqli->query($sql) or die($mysqli->error);
			$tim = $_POST["tim"];
			$m = 0;
			for($i=0 ; $i<count($tim) ; $i++)
			{
				switch((i+1)%9){
					case 1:
						$start_time = $tim[i];
						break;
					case 2:
						$end_time = $tim[i];
						break;
					case 3:
						$mon = $tim[i];
						break;
					case 4:
						$tue = $tim[i];
						break;
					case 5:
						$wed = $tim[i];
						break;
					case 6:
						$thu = $tim[i];
						break;
					case 7:
						$fri = $tim[i];
						break;
					case 8:
						$sat = $tim[i];
						break;
					default:
						$sun=$tim[i];
						$sql = "INSERT INTO $shift_table(start_time,end_time,mon,tue,wed,thu,fri,sat,sun,shop) VALUES('$start_time','$end_time','$mon','$tue','$wed','$thu','$fri','$sat','$sun','$shop')";
						$result = $mysqli->query($sql) or die($mysqli->error);
						break;
				}
				
			}
		}