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
			include "dbconfig.php";
			$con = mysqli_connect($server,$login,$password,$dbname);
			if(!$con){
				die(mysql_error());
			}
			$query="SELECT id as ID,login as 'login ID',password,concat(first_name, ' ' , last_name) as Name, role as Role, address as Address,  zipcode as Zipcode, state as State FROM Users";
			$result = mysqli_query($con,$query);
			if($result===FALSE){
				die("Er0ror");
			}
			while($row = mysqli_fetch_array($result)){
			?>
				<tr>
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
