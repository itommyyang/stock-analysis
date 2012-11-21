<?php
//retrieve related news from yahoo
function getNews($ticker) {
	$request_url = "http://finance.yahoo.com/rss/headline?s=".$ticker;
	$xml = simplexml_load_file($request_url) or die("feed not loaded");
	$titleArray = array();
		
	foreach($xml->channel->item as $item) {
		$title = $item->title;	
				
		if(avoidRedundancy($title, $titleArray)=="go"){
			$tempTitles .= $title.",tom,";
			$titleArray = explode(",tom,", $tempTitles);
			
			echo "<div class='newstitle'><a href=" . $item->link ." target='_blank'>" . $item->title . "</a></div>";
			echo "<div class='newsdate'>" . trimDate($item->pubDate) . "</div><hr class='divider'>";
		}else{
		}		
	}
}

//trim the Date to desired format
function trimDate($orgDate) {
	$Po = strpos($orgDate, '201');
	return substr($orgDate,0,$Po+5);
}

//redundancy removal function
function avoidRedundancy($title, $titleArray) {
	if(!in_array($title, $titleArray)){
		return "go";
	}else{
		return "stop";}
	}

//output the chart html code
function getChart($ticker, $range, $width) {
	if(empty($range)){
		$range = "1d";
	}
	$chart_url = "http://ichart.yahoo.com/z?s=".$ticker."&t=".$range."&q=c&l=on&z=l";
	echo '<img id="beChanged" src="'.$chart_url.'" style="width:'.$width.'px">';
	}

//old output the chart range menu
function oldchartRangeMenu($ticker){
	echo 	
	'<a class="home" href="finance.php?ticker='.$ticker.'&range=1d">1 day</a>
	<a class="home" href="finance.php?ticker='.$ticker.'&range=5d">5 days</a>
	<a class="home" href="finance.php?ticker='.$ticker.'&range=3m">3 months</a>
	<a class="home" href="finance.php?ticker='.$ticker.'&range=6m">6 months</a>
	<a class="home" href="finance.php?ticker='.$ticker.'&range=1y">1 year</a>
	<a class="home" href="finance.php?ticker='.$ticker.'&range=2y">2 years</a>
	<a class="home" href="finance.php?ticker='.$ticker.'&range=5y">5 years</a>';
	}

//output the chart range menu
function chartRangeMenu($ticker){
	echo 	
	'<button class="range" value="1d">1 day</button>
	<button class="range" value="5d">5 days</button>
	<button class="range" value="3m">3 months</button>
	<button class="range" value="6m">6 months</button>
	<button class="range" value="2y">2 years</button>
	<button class="range" value="5y">5 years</button>';
}

// ticker validation
function validateTicker($ticker){
	if(empty($ticker)){
		return false;
	}else{
		$url = "http://download.finance.yahoo.com/d/quotes.csv?s=".$ticker."&f=v&e=.csv";
		
		$file = fopen($url, "r");
		while(!feof($file)){
			$string = fgets($file, 50);
			}
		fclose($file);
			
		if(strpos($string,"N") === 0){
			return false;
		}else{
			return true;
		}
	}
}

//get company information - returning an array
function getComData($ticker,$param){
	$url = "http://download.finance.yahoo.com/d/quotes.csv?s=".$ticker."&f=".$param."&e=.csv";
	
	try{
		$file = fopen($url, "r");
		while(!feof($file)){
			$rawString = fgets($file, 1000);
			}
		fclose($file);		
		} 
	catch(exception $e){
		die('error');
		}
		
		//this should be updated to more efficient arraylist function
		$string = str_replace('"','',$rawString);
		return explode(",", $string);
}

//get return string reason by ticker param
function getReason($ticker){
	$q_reason = "SELECT reason FROM reason JOIN stock ON reason.stockID = stock.stockID WHERE stock.ticker='".$ticker."' LIMIT 1";
	$result = mysql_query($q_reason) or die('get reason error');
	$reason = mysql_result($result, 0);
	return $reason;	
}

//get my own stock to display on left_bar "your stock" section
function getMine($em){
	$q_mine = "select ticker from stock join reason on stock.stockID = reason.stockID join user on reason.userID = user.userID where user.email = '".$em."' limit 1";
	$result = mysql_query($q_mine) or die('get my own stock error');
	$mine = mysql_result($result, 0);
	return $mine;
}

//all stock info (ticker, last close, last change) for class report
function getAllStockInfo(){
	$array = array();
	$q_others = "select ticker, lclose, lchange from stock order by lchange desc";
	$result = mysql_query($q_others);
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    	$array[] = $row[0].",".$row[1].",".$row[2];
	}
	return $array;
}

//get dow jones industries
function getDow(){
	$query = "select dji, mID from market order by mID desc limit 1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	return $row[0];
}

//get all (tickers) in the class on left_bar "classmates'" section
function getOthers(){
	$array = array();
	$q_others = "select ticker from stock";
	$result = mysql_query($q_others);
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    	$array[] = $row[0];
	}
	return $array;
}

function getID($em){
	$id_query = "select userID from user where email = '".$em."' limit 1";	
	$id_result = mysql_query($id_query) or die('get id error');
	$uID = mysql_result($id_result, 0);
	return $uID;
}

function getMyName($em){
	$name_result = mysql_query("select fname from user where email = '".$em."' limit 1") or die ('get name error');
	$name = mysql_result($name_result, 0);
	return $name;
}

function updateReason($em, $input, $ticker){
	$userID = getID($em);
	
	//add to stock table and add reason
	$add_yuanyin = "insert into stock (ticker) values ('".$ticker."')";
	mysql_query($add_yuanyin) or die('error adding to stock table');
	
	$result = mysql_query("select stockID from stock where ticker = '".$ticker."'");
	$stockID = mysql_result($result,0);
	
	$rs_query = "insert into reason (stockID, userID, reason) 
				values ('".$stockID."','".$userID."','".$input."')";
	mysql_query($rs_query) or die('update reason erro');
}
?>	



