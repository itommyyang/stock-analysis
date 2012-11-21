
<div class="content">
	<div class="blocktitle">comments from classmates:</div>
	<div class="blockcontent">
<?php
//$comment = getComment($ticker);
if(!empty($comment)){
	echo $comment;
}
echo'
	<form method="post" action="finance.php?ticker='.$ticker.'">
		<textarea class="opinion" name="input_comment"></textarea>
		<input type="submit" class="submit" value="click here to submit your comment.">
	</form>';
	}	
?>
	</div>
</div>
<hr class="blockdivider">

