<?php
include("./class.php");

$fstArr1 = array(0);

if(isset($_GET["fstP_submit"]) && isset($_GET["fstP_num1"])){
	$fstP_num1 = abs(floatval($_GET["fstP_num1"]));
	if($fstP_num1 >= 1){
		$ouArr = new cFunctionClass();
		$ouArr->fsArrSet($fstP_num1);
		$fstArr1 = $ouArr->fsArrGet();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>3x+1 Problem</title>

<style>
.histogram {
	display: flex;
	align-items: flex-end;
	min-height: 100px;
}
.bar {
	background-color: navy;
	margin-right: 2px;
	color: white;
	padding: 15px 2px;
}
</style>
</head>
<body>

<h1><a href="./">The First Program</a></h1>

<form action="./index.php" method="GET">
	<input type="number" name="fstP_num1" placeholder="Add a Number Here" required />
	<input type="submit" name="fstP_submit" value="Submit" />
</form>

<p>
<?php
$maxNum = 0;
$arVal = "";
foreach($fstArr1 as $ar1){
	$arVal .= $ar1.", ";
	if($maxNum < $ar1){ $maxNum = $ar1; }
}

echo $arVal = rtrim($arVal, ", ");

$arrSize = count($fstArr1) - 1; //number of iterations

echo "<hr />";
if($maxNum >= 2){echo "Maximum Number is <b>".$maxNum."</b> and Number of Iterations is <b>".$arrSize."</b>";}
?>
</p>

<h1><a href="./">The Second Program</a></h1>

<form action="./index.php" method="GET">
	<input type="number" name="start_num1" placeholder="Start Number" required />
	<input type="number" name="end_num1" placeholder="Finish Number" required />
	<input type="submit" name="range_submit" value="Submit" />
</form>

<?php
if(isset($_GET["range_submit"]) && isset($_GET["start_num1"]) && isset($_GET["end_num1"])){
	$start_num1 = abs(floatval($_GET["start_num1"]));
	$end_num1 = abs(floatval($_GET["end_num1"]));
	
	if($start_num1 >= 1 || $end_num1 >= 1){
		if($end_num1 <= $start_num1){
			echo "<p>Please Enter a Proper Number Range!</p>";
		}else{
			
			$numRangeObj = new cFunctionClass();
			$resultArr = $numRangeObj->numRangeSet($start_num1, $end_num1);
			
			$hisDataArr = array();
			foreach($resultArr as $resArr){ $hisDataArr[] = $resArr["iterations"]; }
			
			$histObj = new calcStats();
			$histArr = $histObj->showHistogram($hisDataArr);
			ksort($histArr); //for sorting the array from lowest to highest
			
			/*
			echo "<br>";
			print_r($histArr); //Code for printing the array in a raw form
			*/
			
			echo "
				<h3>A Simple Histogram for the Iteration Statistics!</h3>
				<div class='histogram'>
			";
			foreach($histArr as $histIndex => $histValue){
				echo "<div class='bar' style='height: ".$histValue."0px;' title='x:".$histIndex.", y:".$histValue."'><small>".$histIndex.":".$histValue."</small></div>";
			}
			echo "</div><p>[x(iteration): y(frequency)]</p>";
			
			echo "
				<h3>Results:</h3>
				<table border='1'>
				<tr>
					<th>Number</th>
					<th>Maximum Value</th>
					<th>Iterations</th>
				</tr>
			";
			
			$maxIter = 0;
			foreach($resultArr as $resArr){
				$lpIter = $resArr["iterations"];
				if($maxIter < $lpIter){ $maxIter = $lpIter; }
				echo "
					<tr>
						<td>".$resArr["number"]."</td>
						<td>".$resArr["max_value"]."</td>
						<td>".$lpIter."</td>
					</tr>
				";
			}
			
			echo "
				</table>
				<hr />
			";
			
			$minIter = $maxIter;
			foreach($resultArr as $ressArr){
				$neuIter = $ressArr["iterations"];
				if($minIter > $neuIter){ $minIter = $neuIter; }
			}
			
			echo "
				<p>Maximum Iteration is $maxIter and Minimum Iteration is $minIter</p>
				<hr />
				<h3>Maximum Iteration Table:</h3>
				<table border='1'>
				<tr>
					<th>Number</th>
					<th>Maximum Value</th>
					<th>Iterations</th>
				</tr>
			";
			
			foreach($resultArr as $resArr){
				$lpIter = $resArr["iterations"];
				if($lpIter == $maxIter){
					echo "
						<tr>
							<td>".$resArr["number"]."</td>
							<td>".$resArr["max_value"]."</td>
							<td>".$lpIter."</td>
						</tr>
					";
				}
			}
			
			echo "
				</table>
				<hr />
				<h3>Minimum Iteration Table:</h3>
				<table border='1'>
				<tr>
					<th>Number</th>
					<th>Maximum Value</th>
					<th>Iterations</th>
				</tr>
			";
			
			foreach($resultArr as $resArr){
				$lpIter = $resArr["iterations"];
				if($lpIter == $minIter){
					echo "
						<tr>
							<td>".$resArr["number"]."</td>
							<td>".$resArr["max_value"]."</td>
							<td>".$lpIter."</td>
						</tr>
					";
				}
			}
			
			echo "</table>";
		}
	}else{ echo "<p>Please Enter Real Numbers in the Range!</p>"; }
}
?>

<br><hr />

<h1><a href="./">Calculate Arithmetic Progression</a></h1>

<form action="./index.php" method="GET">
	<input type="number" name="fstTerm" placeholder="First Term" required />
	<input type="number" name="comDiff" placeholder="Common Difference" required />
	<input type="number" name="numbTerm" placeholder="Number of Terms" required />
	<input type="submit" name="calculate_ap" value="Submit" />
</form>

<?php
if(isset($_GET["calculate_ap"]) && isset($_GET["fstTerm"]) && isset($_GET["comDiff"]) && isset($_GET["numbTerm"])){
	$fstTerm = $_GET["fstTerm"];
	$comDiff = $_GET["comDiff"];
	$numbTerm = abs(floatval($_GET["numbTerm"]));
	
	$sumObj = new cFunctionClass();
	$sumOfAP = $sumObj->calcAP($fstTerm, $comDiff, $numbTerm);
	
	$apSeriesArr = $sumObj->showAPSeries($fstTerm, $comDiff, $numbTerm);
	
	echo "<p>The Sum of the Arithmetic Progression is ".$sumOfAP."</p>";
	echo "<p>The Arithmetic Progression Series are: ".implode(", ", $apSeriesArr)."</p>";
}
?>

</body>
</html>