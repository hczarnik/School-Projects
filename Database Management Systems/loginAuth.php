<!--
	Hunter Czarnik
	Database Management Systems
	Spring 2017
-->
<?php
include "dbconfig.php";		//Includes file with information regarding connection to database
$busername=$_POST["username"];	//Retrieves username that user enters on login page
$bpassword=$_POST["password"];	//Retrieves password that user enters on login page

$con = mysqli_connect($server,$login,$password,$dbname);
$checkname = "SELECT id from CPS3740.Users where login = '$busername'";	//Query to get the ID for the user's entered name
$result1 = mysqli_query($con,$checkname);				//Query is run
$row1 = mysqli_fetch_array($result1);					//Array with results from the query is stored in variable
$count = mysqli_num_rows($result1);					//Number of rows from the query result is stored in variable

if($count == 0){	//If the number of rows is 0, no results were found, exit the program because the user does not exist
	print "<a href=\"http://(Website removed)/loginPage.php\">Return to Project 1 homepage</a>";	//Redirect user to homepage
	echo "<br>";
	die("Login ID " .$busername ." does not exist in the database.");
}

//Username exists, check if password matches for the verified username
$checkpassword = "SELECT id from CPS3740.Users where login = '$busername' and BINARY password = BINARY '$bpassword'";
$result2 =mysqli_query($con,$checkpassword);
$row2 = mysqli_fetch_array($result2);
$count2 = mysqli_num_rows($result2);

if($count2 == 0){	//If the number of rows is 0, no results were found, exit the program because the user does not exist
	print "<a href=\"http://(Website removed)/loginPage.php\">Return to Project 1 homepage</a>";	//Redirect user to homepage
	echo "<br>";
	die("User exists, but password does not match.");
}

//Username and password is now verified, print their IP, determine if they're at Kean University or not, then print the name, role and address from the user's credentials.
//This part of code retrieves and examines the client's IP address
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{ $ip = $_SERVER['HTTP_CLIENT_IP']; }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{ $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
else { $ip = $_SERVER['REMOTE_ADDR']; }
$IPv4= explode(".",$ip);
echo "<br>Your IP: $ip\n";	//Prints out the user's IP address

//If the user's IP address has certain prefixes, they are using Kean University's internet
if (($IPv4[0] == 10) or ($IPv4[0] . "." . $IPv4[1] == "131.125") )
{ echo "<br>You are from Kean University.\n"; }
//If the user's IP address does not have certain prefixes, they are not from Kean University
else { echo "<br>You are NOT from Kean University.\n"; }
echo "<br>";

//Gets user's first and last name, which is known from the username that was entered in the login page
$getname = "select concat(first_name,' ',last_name) as Name from CPS3740.Users where login = '$busername'";
$nameResult = mysqli_query($con,$getname);
if ($nameResult->num_rows > 0) {
    // output data of each row
    while($row3= $nameResult->fetch_assoc()) {
    	echo "Welcome user: " . $row3["Name"];
    }
}
echo "<br>";

//Gets user's role (can be Manager, Employee, etc.) and displays it on the website
$getrole = "select role from CPS3740.Users where login = '$busername'";
$roleResult = mysqli_query($con,$getrole);
if ($roleResult->num_rows > 0) {
    // output data of each row
    while($row4= $roleResult->fetch_assoc()) {
    	echo "Role: " . $row4["role"];
    }
}
echo "<br>";

//Gets user's address from the database and displays it on the website
$getaddress = "select concat(address, ', ', state, ', ', zipcode) as userAddress from Users where login= '$busername'";
$addressResult = mysqli_query($con,$getaddress);
if($addressResult->num_rows > 0){
	// output data of each row
	while($row5= $addressResult->fetch_assoc()){
		echo "Address: " . $row5["userAddress"];
	}
}
?>

//HTML code to create a table with customer data
<html>
	<head>
		<title></title>
	</head>
	<p>The customers are: </p>
	<body>
		<table border="1">
		<thread>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Balance</td>
				<td>Zipcode</td>
			</tr>
		</thread>
		<tbody>
		<?php
			$tableQuery="SELECT id as ID, name as Name, balance as Balance, zipcode as Zipcode from CPS3740_2017S.Customers_czarnikh";
			$tableresult = mysqli_query($con,$tableQuery);
			if($tableresult===FALSE){
				die("Er0ror");
			}
			while($tablerow = mysqli_fetch_array($tableresult)){
			?>
				<tr>
					<td><?php echo $tablerow['ID']?></td>
					<td><?php echo $tablerow['Name']?></td>
					<td><?php echo $tablerow['Balance']?></td>
					<td><?php echo $tablerow['Zipcode']?></td>
				</tr>

				<?php
				}
				?>
		</tbody>
		</table>
	</body>
	<?php
		$balanceQuery="select sum(balance) from CPS3740_2017S.Customers_czarnikh";
		$balanceResult = mysqli_query($con,$balanceQuery);
		if($balanceResult->num_rows > 0){
			// output data of each row
			while($row7= $balanceResult->fetch_assoc()){
				echo "Total balance: " . $row7['sum(balance)'];
	}
}
	?>
</html>
