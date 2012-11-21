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
	<?php include("modules/header.php") ?>
	<hr class="blockdivider">
</div>
	
<!--mainbody -->
<div id="mainbody">
<div id="leftbar">
	<?php include("modules/left_bar.php"); ?>
</div>

<?php

if($proceed){

?>
<div id="middlebar">
	<!-- basic info include inormation process-->
	<?php include("modules/basic.php"); ?>
		

	
	<!-- opinion -->
	<?php include("modules/opinion.php"); ?>
	
	<!-- comment -->
	<?php 
		//include("modules/comment.php"); 
	?>

	<!-- tweets from stocktwits -->	
	<div class="content">
		<div class="blocktitle">
			live tweets feed
		</div>
		<div class="blockcontent">
			<div id="stocktwits-widget-news" style="width:460px;margin:8px auto 0 auto;"></div>
		</div>
	</div>
	<hr class="blockdivider">
	
</div><!-- end middle column -->

<div id="rightbar">
	
	<!-- charts -->
	<?php include("modules/chart.php"); ?>
	
	<!-- news mododule -->
	<?php include("modules/news.php"); ?>
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


<!-- Placed at the end of the document so the pages load faster -->
<!-- bootstrap js -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
<!-- js for chart changing -->
	<script>
	var ticker = "<?= $ticker ?>";
	$(document).ready(function() {
	   $("button").click(
		function() {
			$("#beChanged").replaceWith("<img id='beChanged' class='chart_img' src='http://ichart.yahoo.com/z?s="+ticker+"&t="+$(this).val()+"&q=c&l=on&z=l'>");
			$("button").removeClass("on");
			$(this).addClass("on");
		}
	   );
	 });
	</script>
<!-- stocktwits js -->
    <script type="text/javascript" src="http://stocktwits.com/addon/widget/2/widget-loader.min.js"></script>
	<script type="text/javascript">
	STWT.Widget({container: 'stocktwits-widget-news', symbol: ticker, width: '460', height: '700', limit: '15', scrollbars: 'true', streaming: 'true', title: ticker+' ideas', style: {link_color: '4871a8', link_hover_color: '4871a8', header_text_color: '000000', border_color: 'cecece', divider_color: 'cecece', divider_color: 'cecece', divider_type: 'solid', box_color: 'f5f5f5', stream_color: 'ffffff', text_color: '000000', time_color: '999999'}});
	</script>
</body>
</html>