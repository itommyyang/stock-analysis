
<div class="content">
	<div class="blocktitle">
		check a stock
	</div>
	<div class="blockcontent">
		<form name="check" method="POST" action="finance.php" style="margin-bottom:3px;">
			<label class="hint">enter a valid symbol:</label>
			<input type="text" class="ticker" name="ticker">
			<input type="submit" class="btn" value="check">
		</form>
	</div>
</div>
<hr class="blockdivider">

<div class="content">
	<div class="blocktitle">
		your stock
	</div>
	<div class="blockcontent">
	<?php
		if(!empty($myStock)){
			echo '<a href="finance.php?ticker='.$myStock.'">'.$myStock.'</a>';
		}else{
			echo '<label class="hint">you haven\'t chosen <br> a stock yet.</label>';
		}
	?>
	</div>
</div>
<hr class="blockdivider">
<div class="content">
	<div class="blocktitle">
		tommy's
	</div>
	<?php
		foreach($tommys as $tic){
			echo'<p><a href="finance.php?ticker='.$tic.'">'.$tic.'</a></p>';
		}
	?>
</div>

<hr class="blockdivider">
