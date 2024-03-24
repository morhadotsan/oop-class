<?php

class cFunctionClass {
	public $proNum = 0;
	public $proArr = array();
	public $numRangeArr = array();
	public $apNum = 0;
	public $apSeries = array();
	
	public function cFuncSet($num){
		$nuNum = 0;
		if($num % 2 == 0){
			//even number
			$nuNum = $num / 2;
		}else{
			//odd number
			$nuNum = (3 * $num) + 1;
		}
		
		$this->proNum = $nuNum;
		return $this->proNum;
	}
	
	public function fsArrSet($num){
		$fstArr = array();
		while($num != 1){ // Terminate loop when $num reaches 1
			$fstArr[] = $num;
			if($num % 2 == 0){
				$num = $num / 2;
			} else {
				$num = (3 * $num) + 1;
			}
		}
		$fstArr[] = 1; // Include 1 in the array
		$this->proArr = $fstArr;
		return $this->proArr;
	}
	
	public function numRangeSet($start, $finish){
		$result = array();
		
		for($i = $start; $i <= $finish; $i++){
			$maxVal = 0;
			$calcArr = $this->fsArrSet($i);
			$arrIter = count($calcArr);
			$arrIter = $arrIter - 1;
			foreach($calcArr as $cA){if($maxVal < $cA){ $maxVal = $cA; }}
			
			$result[] = [
				"number" => $i, "max_value" => $maxVal, "iterations" => $arrIter
			];
		}
		$this->numRangeArr = $result;
		return $this->numRangeArr;
	}
	
	public function calcAP($fstTerm, $comDiff, $numbOfTerms){
		$sum = ($numbOfTerms / 2) * (2 * $fstTerm + ($numbOfTerms - 1) * $comDiff);
		$this->apNum = $sum;
		return $this->apNum;
	}
	
	public function showAPSeries($a, $d, $n){
		$series = array();
		$current_term = $a;
		
		for($i = 0; $i < $n; $i++){
			$series[] = $current_term;
			$current_term += $d;
		}
		
		$this->apSeries = $series;
		return $this->apSeries;
	}
}

class calcStats extends cFunctionClass {
	public function showHistogram($iterArr){
		$countIter = array_count_values($iterArr);
		return $countIter;
	}
}

?>