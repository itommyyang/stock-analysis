<!-- stock information processing -->
<?php
$allData = array();
$param = "k2k1j1kjrr5eds7hge9e7e8n";
$allData = getComData($ticker,$param);

//name processing
$rawName = $allData[15];
$po1 = strpos($rawName, 'Corporation');
$po2 = strpos($rawName, 'Corpora');
//try macy's and boeing .. more names need to be fixed
if(!empty($po1)){
	$name1 = $rawName;
	}elseif(empty($po2)){
	$name1 = $rawName;
	}else{
	$name1 = substr($rawName, 0, $po2-1) . " Corporation";
	}
$name = str_replace('Marke','Market',$name1);

//%change processing
$change = substr($allData[0], strpos($allData[0], ' - ')+3, 8);

//price procssing
$boldArray = array('<b>','</b>');
$aPrice = str_replace($boldArray,'',$allData[1]);
$price = '$'.substr($aPrice, strpos($aPrice, ' - ')+3, 8);

//mkt cap
$mktcap = $allData[2];
$high = $allData[3];
$low = $allData[4];
$pe = $allData[5];
$peg = $allData[6];
$eps = $allData[7];
$dividend = $allData[8];
$short = $allData[9];
$dayhigh = $allData[10];
$daylow = $allData[11];
$nextq = $allData[12];
$thisy = $allData[13];
$nexty = $allData[14];
?>

<!-- basic info -->
<div class="content">
	<div class="blocktitle">
		<div id="ticker">
			<?php 
				echo $name; 
			?>
		</div>
		<div id="price">
			<?php 
				echo $price." ".$change; 
			?>
		</div><br>
	</div>
	<div class="blockcontent">
	<? echo '<div class="twothirty">market cap: '.$mktcap.'<br>
				PE: '.$pe.'<br>
				PEG: '.$peg.'<br>
				EPS: '.$eps.'<br>
				target EPS next quarter: $'.$nextq.'<br>
				target EPS this year: $'.$thisy.'<br>
				target EPS next year: $'.$nexty.'<br></div>
				<div class="twothirty">dividend/share: '.$dividend.'<br>
				52-week high: $'.$high.'<br>
				52-week low: $'.$low.'<br>
				day high: $'.$dayhigh.'<br>
				day low: $'.$daylow.'<br>
				short ratio: '.$short.'</div>'; 
	?>
	</div>
</div>
<hr class="blockdivider">
