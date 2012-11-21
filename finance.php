<?php

//tommy's stocks
$tommys = array("amzn","sbux","aapl","cmg","fb","luv","jwn");



include("functions/getnews.php");

if(!empty($_POST['ticker'])){
	$ticker = trim($_POST['ticker']);
}elseif(!empty($_GET['ticker'])){
	$ticker = trim($_GET['ticker']);
}

if(!isset($ticker)){
	$proceed = false;
}else{
	$proceed = validateTicker($ticker);
}

?>

<?php include("pre.php"); ?>

<!-- header -->
<div id="header">
	<?php include("header.php") ?>
<hr class="blockdivider">
</div>
	
<!--mainbody -->
<div id="mainbody">
<div id="leftbar">
	<?php include("left_bar.php"); ?>
</div>

<?php

if($proceed){

?>
<div id="middlebar">
	<!-- basic info include inormation process-->
	<?php include("basic.php"); ?>
		
	<!-- chart mod javascript-->
	<?php include("chart.php"); ?>
	
	<!-- opinion -->
	<?php include("opinion.php"); ?>
	
	<!-- comment -->
	<?php 
		//include("comment.php"); 
	?>
</div><!-- end middle column -->

<div id="rightbar">
	<!-- news mododule -->
	<?php include("news.php"); ?>
</div><!-- end right column -->

</div><!-- end mainbody -->

<?php include("footer.php"); ?>
<?php
}else{
		echo '<div id="middlebar">
		<div class="content">
		<div class="blocktitle">'.$ticker.' is an invalid symbol :(</div>
		<div class="blockcontent">
			<p>please enter a valid stock symbol.<br>
			use <a href="http://finance.google.com" target="_blank">google finance</a> to look up symbols.</p>
		</div></div></div>';
}
?>
</body>
</html>