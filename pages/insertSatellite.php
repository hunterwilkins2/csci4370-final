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
    
    <div class="container">
      <header>
        <a href="../index.php" class="logo">
          <i class="fas fa-satellite"></i>
          <h1>Satellite Tracker</h1>
        </a>
        <nav>
          <a href="#">Add New Satellite</a>
          <a href="#">Update Satellite</a>
          <a href="#">Login</a>
        </nav>
      </header>

      <main>

	<!-- Insert Launch Pending Satellite -->
        <div class="formOne">
	  
	  <form action="addSatellitePending.php" method="post">

	    <div>
	      <h2>Insert Launch Pending Satellite</h2>
	      
	      <div/>
	      <div>
		<label>Satellite Model:</label>
		<input type="text" name="Model" placeholder="Satellite Model" required>
	      </div>
	      
	      <div>
		<label>Satellite Name:</label>
		<input type="text" name="Name" placeholder="Satellite Name" required>
	      </div>
	      <div>
		<label>Launch Latitude:</label>
		<input type="number" name="Lati" placeholder="Satellite Latitiude" required>
	      </div>
	      <div>
		<label>Launch Longitude:</label>
		<input type="number" name="Longi" placeholder="Satellite Longitude" required>
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

	  <!-- Insert Launched Satellite -->
	  <div class="formTwo">
	    <form action="addSatelliteLaunched.php" method="post" class="formTwo">


	      <div>
		<h2>Insert Launched Satellite</h2>


		<div>
		  <label>Satellite Model:</label>
		  <input type="text" name="Model" placeholder="Satellite Model" required>
		</div>

		<div>
		  <label>Satellite Name:</label>
		  <input type="text" name="Name" placeholder="Satellite Name" required>
		</div>
		<div>
		  <label>Launch Latitude:</label>
		  <input type="number"  name="Lati" placeholder="Satellite Latitude" required>
		</div>
		<div>
		  <label>Launch Longitude:</label>
		  <input type="number" name="Longi" placeholder="Satellite Longitude" required>
		</div>
		<div>
		  <label>Launched Date:</label>
		  <input name="Date" placeholder="Launched Date" type="date">
		</div>
		<div>
		  <label>Altitude:</label>
		  <input name="Alt" type="number" placeholder="Altitiude" required>
		</div>
		<div>
		  <label>Inclination:</label>
		  <input  placeholder="Inclination" name="Incl" type="number" required>
		</div>


		<div>
		  <button>Submit</button>
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
      </div>
</form>

</main>

<footer>
  <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
</footer>
</div>
</body>
</html>
