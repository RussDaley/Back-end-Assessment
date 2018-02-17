<?php

	$link = mysqli_connect("localhost", "root", "root", "magsubs");

	if (mysqli_connect_error()) {
		die ("Connection has failed");
	}


// Store Address and Info
	if ($_POST['name'] == '' && $_POST['address'] == '' && $_POST['zipcode'] == '') {
		echo "<p>Please enter your info.</p>";
	} else {
		$query = "INSERT INTO `subscribers` (`id`, `name`, `address`, `zipcode`) VALUES(NULL, '".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['address'])."', '".mysqli_real_escape_string($link, $_POST['zipcode'])."')";
   	mysqli_query($link, $query);
	}


// Search
	if ($_POST['searchName'] != '' && $_POST['searchZip'] != '') {
		$query = "SELECT * FROM subscribers WHERE name LIKE '%".$_POST['searchName']."%' AND zipcode LIKE '%".$_POST['searchZip']."%'";
	} else if ($_POST['searchName'] != '') {
		$query = "SELECT * FROM subscribers WHERE name LIKE '%".$_POST['searchName']."%'";
	} else if ($_POST['searchZip'] != '') {
		$query = "SELECT * FROM subscribers WHERE zipcode LIKE '%".$_POST['searchZip']."%'";
	} else {
		$query = "SELECT * FROM subscribers";
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Setting up some sick back-end</title>
	<style type="text/css">
		.search h1 {
			display: inline-block;
		}
		.search form {
			display: inline-block;
		}
	</style>
</head>
<body>
	<div class="search">
		<h1>Search:</h1>
		<form method="post">
			<input type="text" name="searchName" placeholder="Name">
			<input type="number" name="searchZip" placeholder="ZipCode">
			<input type="submit" value="Search">
		</form>
	</div>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Address</th>
				<th>Zip Code</th>
			</tr>
		</thead>
		<tbody>
			<?php

				if($result = mysqli_query($link, $query)) {
					while ($row = mysqli_fetch_array($result)) {
						echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['address']."</td><td>".$row['zipcode']."</td></tr>";
					}
				}

			?>
		</tbody>
	</table>
	<form method="post">
		<input type="text" name="name" placeholder="Enter Name">
		<input type="text" name="address" placeholder="Enter Address">
		<input type="text" name="zipcode" placeholder="Enter Zipcode">
		<input type="submit" value="Sign up">
	</form>
</body>
</html>