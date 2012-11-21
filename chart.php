<div class="content">
	<div class="blocktitle">
		chart: 
		<?php
			chartRangeMenu($ticker);
		?>
	</div>
	<div class="blockcontent">
		<?php
			$width = 460;
			getChart($ticker,$range,$width);
		?>
	</div>
</div>
<hr class="blockdivider">
