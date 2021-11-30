<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../resources/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="../styles/style.css">

    <title>Satellite Tracker</title>
</head>
<body>
    <?php
        require('../util/DotEnv.php');

        (new DotEnv(__DIR__ . '/../.env'))->load();

        $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
    ?>
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
	  <form action="tut1.php" method="get">
	    	    
	    <div>
	      <h2>Update Pending Satellite Launch</h2>	      

	      <div/>	     
	      <div>
		<label>Satelite Name:</label>
		<input type="text" name="Name" placeholder="Satellite Name" requried>
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

	  <!-- This code updates satellites which are in orbit -->
	  <form action="tut1.php" method="get">	
	    
	    <div>
	      <h2>Update Satelite Location</h2>
	      
	      <div>
		<label>Satelite Current Location:</label>
		<input type="text" name="Current Location" placeholder="Current Satellite Location" required>
	      </div>
	      <div>
		<label>Satelite New Location:</label>
		<input type="text" name="New Location" placeholder="New Satellite Location" required>
	      </div>
	      
	      <div>
		<label>Satelite Name:</label>
		<input type="text" name="Name" placeholder="Satellite Name" requried>
	      </div>	      	      
	      <div>
		<button type="submit" name="submit">Submit</button>
	      </div>
	      
	  </form>
	  
        </main>
	
        <footer>
            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
        </footer>
    </div>
</body>
</html>
<div>
