<!DOCTYPE html>
<html>
<head>
<!--I, Mike Zheng, 000348657 certify that this material is my original work.
No other person's work has been used without due acknowledgement. I have not 
made my work available to anyone else.-->
<style>
	body{
		width: 500px;
		text-align:center;
		}
	h1	{
		color:grey;
		}
	form{
		width:400px;
		margin-left:auto;
		margin-right:auto;
		text-align:center;
		background-color:grey;
		color:white;
		}
	table	{
			border: black solid 2px;
			margin:auto;
			}
	td	{
		padding:10px;
		}
	
	.highlight	{
				background-color:darkred;
				color:white;
				}
	.even	{
			background-color:darkgreen;
			color:white;
			}
	.odd	{
			background-color:lightgreen;
			color:white;
			}
	
</style>
</head>
<body>
<?	
	define('ROWDEFAULT', '10');
	define('COLDEFAULT', '10');
	define('HIGHLIGHTDEFAULT', '5');
	define('MAXDEFAULT', '15');
	$rowlen = ROWDEFAULT;
	$collen = COLDEFAULT;
	$highlight = HIGHLIGHTDEFAULT;
	$startnum = rand(0,100);
	$ticker = $startnum;
	$class = "";

	function checkInput($input, $default, $limit){
		if (is_numeric($input)){
			if ($input > $limit)
				$input = $limit;
		}
		else 
			$input = $default;
		return $input;
	}
?>
<header>
<h1>Table Generators</h1>
<a href="<?$_SERVER['PHP_SELF']?>">Refresh</a>
<br>
<br>
<form action="<? echo $_SERVER['PHP_SELF'];?>" method="post">
	<label for = "inrow">Rows:</label>
	<input type="text" name = "inrow"
			value = "<?	if ($_SERVER['REQUEST_METHOD'] == 'POST')
							$rowlen = checkInput($_POST['inrow'], COLDEFAULT, MAXDEFAULT); 
						echo $rowlen;?>" size = "3">
	<label for = "incol">Cols:</label>
	<input type="text" name = "incol"
			value = "<?	if ($_SERVER['REQUEST_METHOD'] == 'POST')
							$collen = checkInput($_POST['incol'], COLDEFAULT, MAXDEFAULT);  
						echo $collen;?>" size = "3">
	<label for = "highlight">Highlight:</label>
	<input type="text" name = "highlight"
			value = "<?	if ($_SERVER['REQUEST_METHOD'] == 'POST')
							$highlight = checkInput($_POST['highlight'], HIGHLIGHTDEFAULT, MAXDEFAULT);   
						echo $highlight;?>" size = "3">
	<br>
	<input type="submit" value="Generate Table with Form Values">
</form>
</header>
	<?
	if ($startnum % 2 == 0)
	{
		$class = "even";
	}
	else {
		$class = "odd";
	}
	echo "<p>First number is an <span class =\"$class\">$class</span> number</p>";
	echo "\n<table>\n";
	for ($row = 0; $row < $rowlen; $row++){
		echo "\t<tr>\n";
		
		for ($col = 0; $col < $collen; $col++)
		{
			$tempclass = $class;
			if ($ticker % $highlight == 0)
				$class = "highlight";
			echo "\t\t<td class='$class'>".$ticker."</td>\n";
			$ticker++;
			$class = $tempclass;
		}
		echo "\t</tr>\n";
		if ($class == "even")
		{
			$class = "odd";
		}
		else {
			$class = "even";
		}
	}
	echo "\n</table>";
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	?>
</body>
</html>