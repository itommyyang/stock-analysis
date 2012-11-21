<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head profile="http://www.w3.org/2005/10/profile">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<link rel="icon" 
      type="image/jpg" 
      href="images/uw.jpg">
<title>t.finance - jtyang</title>
<link rel="stylesheet" href="css/tfinance.css" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
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
</head>

<body OnLoad="document.check.ticker.focus();">