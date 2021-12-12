<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="shortcut icon" href="../resources/favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="../styles/style.css">

<style type="text/css">
	.error {
	font-size: 15px;
	color: red;
	}
</style>

<?php
require(__DIR__ . '/../util/db.connect.php');
$query1 = "SELECT satellite_name FROM Satellites WHERE type = 'Pending' AND company_id = ".$_COOKIE["cid"];
$result1 = $mysqli->query($query1);
$query2 = "SELECT satellite_name FROM Satellites WHERE type = 'In-Orbit' AND company_id = ".$_COOKIE["cid"];
$result2 = $mysqli->query($query2);
?>

<title>Satellite Tracker</title>
</head>
<body>

<div class="container">
	<header>
	<a href="../index.php" class="logo">
		<i class="fas fa-satellite"></i>
		<h1>Satellite Tracker</h1>
	</a>
	<nav>
	<?php
		if(isset($_COOKIE["cid"])) {
			$nameSql = "SELECT company_name FROM Companies WHERE company_id = '".$_COOKIE["cid"]."'";

			if ($result = $mysqli->query($nameSql)) {
				$name = $result->fetch_object()->company_name;
				echo '<p>Welcome, ' . $name . '</p>';
				echo '<a href="./insertSatellite.php">Add New Satellite</a>';
				echo '<a href="./updateSatellite.php">Update Satellite</a>';
				echo '<a href="?logout">Logout</a>';
			} 

			if(isset($_GET['logout'])) {
				unset($_COOKIE['cid']); 
				setcookie('cid', "", time()-3600, '/'); 
				header("Location: ../index.php");
			}
		} else {
			header("Location: ../login/login.php");
		}
	?>
	</nav>
	</header>

	<main>

<!-- This code updates satellites which are pending launch -->
<div class="formOne">
<h2>Update Pending Satellite Launch</h2>	     
<form method="get" id="satelliteName">
		<select name="name" onchange="this.form.submit()">
		<?php
			while ($row = $result1->fetch_object()) {
				$names[] = $row;
			}

			if(!isset($_GET['name'])) {
				$_GET['name'] = $names[0]->satellite_name;
			}

			foreach($names as $name) {
				if($name->satellite_name == $_GET['name']) {
					echo '<option value="'.$name->satellite_name.'" selected>'.$name->satellite_name.'</option> ';
				} else {
					echo '<option value="'.$name->satellite_name.'">'.$name->satellite_name.'</option> ';
				}
			}

			while ($row = $result2->fetch_object()) {
				echo $row->satellite_name;
				$orbit_names[] = $row;
			}

			if(!isset($_GET['orbit_name'])) {
				$_GET['orbit_name'] = $orbit_names[0]->satellite_name;
			}
		?>
		</select>
		<?php
			echo '<input type="hidden" name="orbit_name" value="'. $_GET['orbit_name'] .'" />';
		?>
	</form>
	
	<form action="updateLaunch.php" method="post">
	<?php
		$details = "SELECT * FROM `Pending` P INNER JOIN (SELECT * FROM Satellites S WHERE S.satellite_name = '".$_GET['name']."') N ON N.satellite_id = P.satellite_id";
		if($details_result = $mysqli->query($details)) {
			while ($data = $details_result->fetch_object()) {
				$details_arr = $data;
			}
		}
		?>
	<div>
		
		<label>Satellite Name:</label>
		<?php
		echo '<input type="text" name="Name" value="'. $details_arr->satellite_name .'" pattern="[ a-zA-Z0-9\'._]*" title="Invalid name" readonly required>';
		?>
	</select>
		</div>
		
		<div>
	<label>Satellite Model:</label>
		<?php
		echo '<input type="text" name="Model" value="'. $details_arr->model .'" pattern="[ a-zA-Z0-9\'._]*" title="Invalid model" required>';
		?>
		</div> 

		<div>
	<label>Launch Latitude:</label>
		<?php
		echo '<input type="number" name="Lati" value="'. $details_arr->pending_latitude .'" min="-90" max="90" step="0.01" required>';
		?>
		</div>

		<div>
		<label>Launch Longitude:</label>
		<?php
		echo '<input type="number" name="Longi" value="'. $details_arr->pending_longitude .'" min="-180" max="180" step="0.01" required>';
		?>
		</div>

		<div>
	<label>Pending Launch Date:</label>
		<?php
		echo '<input type="date" name="Date" value="'. $details_arr->pending_date .'" required>';
		?>
		</div>	      
		<div>
	<br><button type="submit" name="submit">Submit</button>
		</div>

	</form>
	</div>

	<!-- This code updates satellites which are in orbit -->
	<div class="formTwo">
	<h2>Update Satellite Location</h2>
	<form method="get" id="satellite_orbit">
		<select name="orbit_name" onchange="this.form.submit()">
		<?php
			foreach($orbit_names as $name) {
				if($name->satellite_name == $_GET['orbit_name']) {
					echo '<option value="'.$name->satellite_name.'" selected>'.$name->satellite_name.'</option> ';
				} else {
					echo '<option value="'.$name->satellite_name.'">'.$name->satellite_name.'</option> ';
				}
			}
		?>
		</select>
		<?php
			echo '<input type="hidden" name="name" value="'. $_GET['name'] .'" />';
		?>
	</form>

	<form action="updateLocation.php" method="post">	
		<?php
		$details = "SELECT * FROM `In-Orbit` I INNER JOIN (SELECT * FROM Satellites S WHERE S.satellite_name = '".$_GET['orbit_name']."') N ON N.satellite_id = I.satellite_id";
		if($details_result = $mysqli->query($details)) {
			while ($data = $details_result->fetch_object()) {
				$details_arr = $data;
			}
		}
		?>
			<div>
		<label>Satellite Name:</label>
		<?php
		echo '<input type="text" name="Name" value="'. $details_arr->satellite_name .'" pattern="[ a-zA-Z0-9\'._]*" title="Invalid name" readonly required>'
		?>
		</div>
		<div>
	<label>Satellite Model:</label>
	<?php
	echo '<input type="text" name="Model" value="'. $details_arr->model .'" pattern="[ a-zA-Z0-9\'._]*" title="Invalid model" required>';
	?>
		</div>
	
	<div>
		<label>Satelite New Latitude:</label>
		<?php
		echo '<input type="number" name="Lati" id="lat" onchange="setMin()" value="'. $details_arr->launch_latitude.'" min="-90" max="90" step="0.01" required>'
		?>
	</div>

	<div>
		<label>Satelite New Longitude:</label>
		<?php
		echo '<input type="number" name="Longi" value="'. $details_arr->launch_longitude.'" min="-180" max="180" step="0.01" required>'
		?>
	</div>

	<div>
		<label>Satelite New Altitude:</label>
		<?php
		echo '<input type="number" name="Alt" value="'. $details_arr->altitude.'" min="250" max="2000" step="0.01" required>'
		?>
	</div>
	
	<div>
		<label>Satelite New Inclination:</label>
		<?php
		echo '<input type="number" id="incl" name="Incl" value="'. $details_arr->inclination.'" step="0.01" title="Cannot be less than than latitude" required>'
		?>
		<script>
			setMin();
			function setMin() {
				document.getElementById("incl").min = document.getElementById("lat").value;
			}
		</script>
	</div>

	<div>
		<br><button type="submit" name="submit">Submit</button>
	</div>

	</form>

	</div>	    

	<div class="success-msg">
		<?php
		if( $_GET['status'] == 'success'):
		echo 'Satellite Successfuly Entered';
		endif;
		?>
	</div>
	
	</main>
	
	<footer>
	<p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
	</footer>
	</div>
</body>
</html>
