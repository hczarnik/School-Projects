<!-- This HTML code will create the table to display the information of users in a database table -->
<html>
	<head>
		<title>The users in the database:</title>
	</head>
	<h3> The users in the database:</h3>
	<body>
		<table border="1">
		<thread>
			<tr>
				<td>ID</td>
				<td>login ID</td>
				<td>password</td>
				<td>Name</td>
				<td>Role</td>
				<td>Address</td>
				<td>Zipcode</td>
				<td>State</td>
			</tr>
		</thread>
		<tbody>
		<?php
			include "dbconfig.php";						//Includes file with information regarding connection to database
			$con = mysqli_connect($server,$login,$password,$dbname);	//Establishes connecton to the database
			if(!$con){	//If the connection fails, display an error
				die(mysql_error());
			}
			
			//Connection to database is made, print out user information from database table
			//This query retrieves the ID, username, password, name, role, address, zipcode, and state for each user
			//A (SELECT *...) query would work, but the column names had to match both in the HTML and Database, which is why many 'as' statements were used in the below query
			$query="SELECT id as ID,login as 'login ID',password,concat(first_name, ' ' , last_name) as Name, role as Role, address as Address,  zipcode as Zipcode, state as State FROM Users";
			$result = mysqli_query($con,$query);	//Runs the above query
			if($result===FALSE){
				die("Er0ror");
			}
			while($row = mysqli_fetch_array($result)){	//For each row of results, data will be inputted in the HTML table
			?>
				<tr>	<!--In the below lines, data from the MySQL query results will be entered into each column for this HTML table -->
					<td><?php echo $row['ID']?></td>
					<td><?php echo $row['login ID']?></td>
					<td><?php echo $row['password']?></td>
					<td><?php echo $row['Name']?></td>
					<td><?php echo $row['Role']?></td>
					<td><?php echo $row['Address']?></td>
					<td><?php echo $row['Zipcode']?></td>
					<td><?php echo $row['State']?></td>
				</tr>

				<?php
				}
				?>
				</tbody>
				</table>
	</body>
</html>
