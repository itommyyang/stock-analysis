
<?php
/*
<html>
<body>
<form method="post" action="http://www.lecturesmart.com/42/functions/read_discussion.php">
<input type="text" name="mid">
<input type="submit" value="submit">
</form>
</body>
</html>
*/
?>

<?php
function alphaID($in, $to_num = false, $pad_up = false, $passKey = null)
{
	$index = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	if ($passKey !== null) {
		// Although this function's purpose is to just make the
		// ID short - and not so much secure,
		// with this patch by Simon Franz (http://blog.snaky.org/)
		// you can optionally supply a password to make it harder
		// to calculate the corresponding numeric ID

		for ($n = 0; $n<strlen($index); $n++) {
			$i[] = substr( $index,$n ,1);
		}

		$passhash = hash('sha256',$passKey);
		$passhash = (strlen($passhash) < strlen($index))
			? hash('sha512',$passKey)
			: $passhash;

		for ($n=0; $n < strlen($index); $n++) {
			$p[] =  substr($passhash, $n ,1);
		}

		array_multisort($p,  SORT_DESC, $i);
		$index = implode($i);
	}

	$base  = strlen($index);

	if ($to_num) {
		// Digital number  <<--  alphabet letter code
		$in  = strrev($in);
		$out = 0;
		$len = strlen($in) - 1;
		for ($t = 0; $t <= $len; $t++) {
			$bcpow = bcpow($base, $len - $t);
			$out   = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
		}

		if (is_numeric($pad_up)) {
			$pad_up--;
			if ($pad_up > 0) {
				$out -= pow($base, $pad_up);
			}
		}
		$out = sprintf('%F', $out);
		$out = substr($out, 0, strpos($out, '.'));
	} else {
		// Digital number  -->>  alphabet letter code
		if (is_numeric($pad_up)) {
			$pad_up--;
			if ($pad_up > 0) {
				$in += pow($base, $pad_up);
			}
		}

		$out = "";
		for ($t = floor(log($in, $base)); $t >= 0; $t--) {
			$bcp = bcpow($base, $t);
			$a   = floor($in / $bcp) % $base;
			$out = $out . substr($index, $a, 1);
			$in  = $in - ($a * $bcp);
		}
		$out = strrev($out); // reverse
	}

	return $out;
}


$num_in = time();
$alpha_in = 'LddVD4ksAx';


$num_out_1 = alphaID($num_in, true);
$alpha_out_2 = alphaID($num_in, false, 10);

echo $num_out_1.'<br>'.$alpha_out_2.'<br>end<br><br>';

?>