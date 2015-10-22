<!DOCTYPE html>
<html>
<head>
<style>
table{border-collapse:collapse;}
table, tr, td{
	border:white 1px solid;
}
td{margin:10px;}
td p {
	width:300px;
	margin:10px;
}
label{margin:10px;}
input[type="text"] {margin:10px;
	 border-color: white;
	 background-color:#E8E8E8 ;
	 line-height:50px;
	 padding-left:15px;
	padding-right:15px;
	border:white 5px solid;}
.row1 {background-color:darkgreen;	
	color:white;}
td:not(.row1){
	background-color:#B8B8B8;
}
.error{color:red;}
</style>
</head>
<body>
<?
function processInput(&$invalue)
{
	trim($_POST['fullname']);
	$_POST['fullname'] = preg_replace( '/\s+/', ' ', $_POST['fullname']);
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	
	if (preg_match("/(Mrs|Mr).\s+\w+\s+\w+/", $_POST['fullname'])) {
	} 
	else {
		$errorList['fullname'] = "Fullname not entered correctly3";
		$nameError="error";
	}
	
	
	if(preg_match("/[0-9]{2,3}\s+\w+\s+(Street|Road)/", $_POST['street'])){
	}
	else{
		$errorList['street'] = "Street address not entered correctly";
		$streetError="error";
	}
	
	if(preg_match("/[d-km-x][d-km-x][1-9][ -]*[d-km-x][1-9][1-9]/", $_POST['postalcode'])){
	}
	else{
		$errorList['postalcode'] = "Invalid Phone Number";
		$postalcodeError="error";
	}
	
	if(preg_match("/\(*[0-9][0-9][0-9]\)*[. -]*[0-9][0-9][0-9][. -]*[0-9][0-9][0-9][0-9]/", $_POST['phone'])){
	}
	else{
		$errorList['phone'] = "Postal Code in wrong format";
		$phoneError="error";
	}
	
	if(preg_match("/\w{4,10}\.\w{4,10}\@mohawkcollege.(com|ca|org)/", $_POST['email'])){
	}
	else{
		$errorList['email'] = "Email is in wrong format!";
		$emailError="error";
	}
	
	if (isset($errorList))
	{
		echo "<ul>";
		foreach ($errorList as $val)
			echo "<li>$val</li>";
		echo "</ul>";
	}
	else 
	{
		$fp = fopen('myfile.txt', 'r') or die('No file!!!'); 
		fputcsv($fp, array('car','apple','plum'))
	}
}


?>
<form action="<?$_SERVER['PHP_SELF']?>" method = "POST">
	<table>
	<tr>
		<td class = "row1">
			<label for="fullname">Full Name:</label>
		</td>
		<td>
			<input type="text" name= "fullname" value="<?if (isset($_POST['fullname'])) echo $_POST['fullname'];?>" size = 40> 
		</td>
		<td class="<?echo $nameError;?>">
			<p>Salutation of Mr. or Mrs. followed by two text strings separated by any number of spaces.</p>
		</td>
	</tr>
	<tr>
		<td class = "row1">
			<label for="street">Street:</label>
		</td>
		<td>
		<input type="text" name= "street"  value="<?if (isset($_POST['street'])) echo $_POST['street'];?>" size = 40> 
		</td>
		<td class="<?echo $streetError;?>">
			<p>2 or 3 digit number followed by a text string ending with Street or Road separated by any number of spaces.</p>			
		</td>
	</tr>
	<tr>
		<td class = "row1">
			<label for="postalcode">Postal Code:</label>
		</td>
		<td>
			<input type="text" name= "postalcode" value="<?if (isset($_POST['postalcode'])) echo $_POST['postalcode'];?>" size = 40> 
		</td>
		<td class="<?echo $postalcodeError;?>">
		<p>Char Char Digit optional Hypen or space Char Digit Digit (abclyz and number 0 not allowed. Case insensitive.)</p>
		</td>
	</tr>
	<tr>
		<td class = "row1">
			<label for="phone">Phone:</label>
		</td>
		<td>
			<input type="text" name= "phone"  value="<?if (isset($_POST['phone'])) echo $_POST['phone'];?>" size = 40> 
		</td>
		<td class="<?echo $phoneError;?>">
			<p>10 Digits, first 3 digits have optional parentheses, either side of digits 456 are optional space, dot or hyphen.</p>
		</td>
	</tr>
	<tr>
		<td class = "row1">
			<label for="email">Email:</label>
		</td>
		<td>
			<input type="text" name= "email" value="<?if (isset($_POST['email'])) echo $_POST['email'];?>" size = 40> 
		</td>
		<td class="<?echo $emailError;?>">
			<p>firstname.lastname@mohawkcollege.domain (firstname and lastname must be 4-10 characters in length, domain may be either .com, .ca or .org)</p>
		</td>
	</tr>
	</table>
	<br>
	<input type="submit" value = "Submit me now!!!">

</form>
<?
echo "<pre>";print_r($_POST);echo "</pre>";
echo "<pre>";print_r($errorList);echo "</pre>";
?>
</body>
</html>