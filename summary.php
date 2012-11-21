<div id="summary">
	<div class="content">
		<div class="blocktitle">
			market summary
		</div>
		<div class="blockcontent">
			<?php
				$width=520;
				$range="1d";
				getChart("^DJI",$range,$width);
				getChart("^IXIC",$range,$width);
				getChart("^GSPC",$range,$width);
			?>
		</div>
	</div>
	<hr class="blockdivider">
</div>

<div id="report">
	<div class="content">
		<div class="blocktitle">
			class report as of last trading day
		</div>
		
		
	<?php
		//data collection
		$clsrpt = getAllStockInfo();
	?>
		<div class="blockcontent">
			top 3 performers in your class: 
			<?php
				for($i=0; $i<3; $i++){
					$ar = explode(",", $clsrpt[$i]);
					if($ar[2][0]!='-'){
						$pstv = "+".$ar[2];
					}else{
						$pstv = $ar[2];
					}
					echo '<p class="hlight">'.$ar[0].': $'.$ar[1].' '.$pstv.'%</p>';
				}
			?>
		<hr class="divider">
			
				who have beat the market (s&p 500)?
				
			<?php
				foreach($clsrpt as $a){
					$ar = explode(",", $a);
					
					$dow = getDow();
				
					if($ar[2] > $dow){
						if($ar[2][0]!='-'){
							$pstv = "+".$ar[2];
						}else{
							$pstv = $ar[2];
						}
						echo '<p class="hlight">'.$ar[0].': $'.$ar[1].' '.$pstv.'%</p>';
					}
				}
				echo '<p class="hlight">s&p500 index: '.$dow.'%</p>';
			?>
		</div>
	</div>
	<hr class="blockdivider">
</div>