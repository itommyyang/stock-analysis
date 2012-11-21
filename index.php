<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head profile="http://www.w3.org/2005/10/profile">
	<link rel="icon" type="image/jpg" href="../images/favicon.jpg">
	<title>t.finance - jtyang</title>
	<link rel="stylesheet" href="css/index.css" type="text/css">
</head>

<body OnLoad="document.login.email.focus();">
	<div id="form-content">
		<p>	
		t.finance - jtyang
		</p>
	
		<!--log in form-->
		<form method="POST" action="finance.php" name="login">
		<fieldset>
			<label>stock ticker:</label>
			<input type="text" class="ticker" name="ticker" size="10" value="amzn" style="color:#888888;" onclick="this.value='';this.onclick='';this.style.color='#000';"/>
			<input type="submit" class="submit" value="log in"/>
		</fieldset>
		</form>

		<div id="footer">
			<p>powered by jarvis &copy; 2010-2012</p>
		</div>
	</div>		

<div id="bg">
	<img src="images/background.jpg">
</div>
	
</body>
</html>