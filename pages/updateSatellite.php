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
	$query = "SELECT pid FROM Pending";
	$result = $mysqli->query($query);
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
	  <a href="./insertSatellite.php">Add New Satellite</a>
          <a href="./updateSatellite.php">Update Satellite</a>
          <a href="#">Login</a>
        </nav>
      </header>

      <main>

	<!-- This code updates satellites which are pending launch -->
	<div class="formOne">
	  
	  <form action="updateLaunch.php" method="post">
	    
	    <div>
	      <h2>Update Pending Satellite Launch</h2>	      
	      
	      <div/>	     
	      <div>
		<label>Satelite ID:</label>
		<select name="sid" id="sid">
			<?php
		    while ($row = $result->fetch_assoc()) {
			    echo '<option value="'.$row['name'].'">'.$row['name'].'</option> ';
		    }
			?>
		</select>
	      </div>
	      
	      <div>
		<label>Launch Location:</label>
		<input type="text" name="Location" placeholder="Satellite Location" required>
	      </div>

	      <div>
		<label>Pending Launch Date:</label>
		<input type="date" name="Date" placeholder="Pending Launch Date" required>
	      </div>	      	   

	      <div>
		<button type="submit" name="submit">Submit</button>
	      </div>

	  </form>
	  </div>

	  <!-- This code updates satellites which are in orbit -->
	  <div class="formTwo">
	    <form action="updateLocation.php" method="post">	
	      
	      <div>
		<h2>Update Satellite Location</h2>
		
		<div>
		<label>Satelite ID:</label>
		<select name="sid" id="sid">
            $query = "SELECT pid FROM Pending"
		    while ($row = $result->fetch_assoc()) {
			    <option value=".$row['name']">.$row['name']</option> ;
		    }
		</select>
	      </div>

		<div>
		  <label>Satelite New Longitude:</label>
		  <input type="text" name="New Longitude" placeholder="New Satellite Longitude" required>
		</div>
		
		<div>
		  <label>Satelite New Latitude:</label>
		  <input type="text" name="New Latitude" placeholder="New Satellite Latitude" required>
		</div>

		<div>
		  <label>Satelite New Altitude:</label>
		  <input type="text" name="New Altitude" placeholder="New Satellite Altitude" required>
		</div>
		
		<div>
		  <label>Satelite New Inclination:</label>
		  <input type="text" name="New Inclination" placeholder="New Satellite Inclination" required>
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
