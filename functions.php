<?php

function cFunc($num){
	$nuNum = 0;
	if($num % 2 == 0){
		//even number
		$nuNum = $num / 2;
		return $nuNum;
	}else{
		//odd number
		$nuNum = (3 * $num) + 1;
		return $nuNum;
	}
}

function fsArr($num){
	$fstArr = array();
	$exitArr = false;
	
	while($exitArr !== true){
		$fstArr[] = $num;
		$chkNum = $num - 1;
		if($chkNum == 0){
			$exitArr = true;
			break;
		}
		
		$num = cFunc($num);
	}
	
	return $fstArr;
}

function calc_number_range($start, $finish){
    $result = array();
    
	for($i = $start; $i <= $finish; $i++){
        $maxVal = 0;
		$calcArr = fsArr($i);
		$arrIter = count($calcArr);
		$arrIter = $arrIter - 1;
		foreach($calcArr as $cA){if($maxVal < $cA){ $maxVal = $cA; }}
		
        $result[] = [
            "number" => $i, "max_value" => $maxVal, "iterations" => $arrIter
        ];
    }
	
    return $result;
}

?>