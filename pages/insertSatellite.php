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

	<title>Satellite Tracker</title>
</head>

<body>
	<?php
	require(__DIR__ . '/../util/db.connect.php');
	?>
	<div class="container">
		<header>
			<a href="../index.php" class="logo">
				<i class="fas fa-satellite"></i>
				<h1>Satellite Tracker</h1>
			</a>
			<nav>
				<?php
					if (isset($_COOKIE["cid"])) {
						$nameSql = "SELECT company_name FROM Companies WHERE company_id = '" . $_COOKIE["cid"] . "'";

						if ($result = $mysqli->query($nameSql)) {
							$name = $result->fetch_object()->company_name;
							echo '<p>Welcome, ' . $name . '</p>';
							echo '<a href="./insertSatellite.php">Add New Satellite</a>';
							echo '<a href="./updateSatellite.php">Update Satellite</a>';
							echo '<a href="?logout">Logout</a>';
						}

						if (isset($_GET['logout'])) {
							unset($_COOKIE['cid']);
							setcookie('cid', "", time() - 3600, '/');
							header("Location: ../index.php");
						}
					} else {
						header("Location: ../login/login.php");
					}
				?>
			</nav>
		</header>

		<main>
			<!-- Insert Launch Pending Satellite -->
			<div class="formOne">
				<form action="addSatellitePending.php" method="post">
					<div>
						<h2>Insert Launch Pending Satellite</h2>

					</div>
					<div>
						<label>Satellite Model:</label>
						<input type="text" name="Model" placeholder="Satellite Model" pattern="[ a-zA-Z0-9'._]*" title="Invalid model" required>
					</div>

					<div>
						<label>Satellite Name:</label>
						<input type="text" name="Name" placeholder="Satellite Name" pattern="[ a-zA-Z0-9'._]*" title="Invalid name" required>
					</div>
					<div>
						<label>Launch Latitude:</label>
						<input type="number" name="Lati" placeholder="Satellite Latitiude" min="-90" max="90" step="0.01" required>
					</div>
					<div>
						<label>Launch Longitude:</label>
						<input type="number" name="Longi" placeholder="Satellite Longitude" min="-180" max="180" step="0.01" required>
					</div>
					<div>
						<label>Pending Launch Date:</label>
						<input type="date" name="Date" id="pending_date" placeholder="Pending Launch Date" required>
					</div>

					<div>
						<br><button type="submit" name="submit">Submit</button>
					</div>
				</form>
			</div>

			<!-- Insert Launched Satellite -->
			<div class="formTwo">
				<form action="addSatelliteLaunched.php" method="post" class="formTwo">
					<div>
						<h2>Insert Launched Satellite</h2>

						<div>
							<label>Satellite Model:</label>
							<input type="text" name="Model" placeholder="Satellite Model" pattern="[ a-zA-Z0-9'._]*" title="Invalid model" required>
						</div>

						<div>
							<label>Satellite Name:</label>
							<input type="text" name="Name" placeholder="Satellite Name" pattern="[ a-zA-Z0-9'._]*" title="Invalid name" required>
						</div>
						<div>
							<label>Launch Latitude:</label>
							<script>
								function setMin() {
									document.getElementById("Incl").min = document.getElementById("Lati").value;
								}
							</script>
							<input type="number" name="Lati" id="Lati" placeholder="Satellite Latitude" onchange="setMin()" min="-90" max="90" step="0.01" required>
						</div>
						<div>
							<label>Launch Longitude:</label>
							<input type="number" name="Longi" placeholder="Satellite Longitude" min="-180" max="180" step="0.01" required>
						</div>
						<div>
							<label>Launched Date:</label>
							<input name="Date" placeholder="Launched Date" id="launched_date" type="date">
						</div>
						<div>
							<label>Altitude:</label>
							<input name="Alt" type="number" placeholder="Altitiude" min="250" max="2000" step="0.01" required>
						</div>
						<div>
							<label>Inclination:</label>
							<input placeholder="Inclination" name="Incl" id="Incl" type="number" step="0.01" title="Cannot be less than than latitude" required>
						</div>

						<div>
							<br><button type="submit">Submit</button>
						</div>
						<script>
							const today = new Date().toLocaleDateString('en-ca');
							document.getElementById('pending_date').min = today;
							document.getElementById('launched_date').max = today;
						</script>
					</div>

					<div class="success-msg">
						<?php
							if ($_GET['status'] == 'success') :
								echo 'Satellite Successfuly Entered';
							endif;
						?>
					</div>
				</form>
			</div>
		</main>

		<footer>
			<p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
		</footer>
	</div>
</body>
</html>