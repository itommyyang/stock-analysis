<?php
function registration(){
	$fn = mysql_real_escape_string($_POST['fname']);
	$ln = mysql_real_escape_string($_POST['lname']);
	$em = mysql_real_escape_string($_POST['email']);
	$pw = mysql_real_escape_string($_POST['pw']);
	
	$email_query = "select email from user";
	$email_result = mysql_query($email_query) or die ('email query wrong');
	
	//check email uniqueness
	while ($row = mysql_fetch_array($email_result, MYSQL_NUM)) {
		if($row[0] == $em){
			return false;
		}
	}
	
	//validate email address
	if(validate_email($em)){
		//write into user table
		$create_query = "insert into user (email, pw, fname, lname) 
		values ('".$em."', '".$pw."', '".$fn."', '".$ln."')";
		mysql_query($create_query) or die ('create user failed');
		return true;
	}else{
		return false;
	}
}

function verifyUser(){
	$em = mysql_real_escape_string($_POST['email']);
	$pw = mysql_real_escape_string($_POST['pw']);
	$unpw_query = "select userID from user where email='".$em."' and pw='".$pw."'";
	$unpw_result = mysql_query($unpw_query) or die ('please check ur username and password');
	$unpw = mysql_fetch_row($unpw_result);
	
	if($unpw == null){
		return false;
	}else{
		return true;
	}	
}

function validate_email($mail) {
	//process the email address
	$tom_at_po = strripos($mail, "@");
	$tom_edu_str = substr($mail, $tom_at_po+1);
	$tom_valid_email = "greenriver.edu";
	
	if($tom_edu_str == $tom_valid_email){
		return true;
	}else{
		return false;
	}
}
?>