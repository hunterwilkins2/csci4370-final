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
  


        <div class="formOne">



  <form action="addSatellite.php" method="post">


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


















<div class="formTwo">
    <form action="tut1.php" method="get" class="formTwo">


<div>
<h2>Insert Launched Satellite</h2>


<div>
    <label>Satellite Model:</label>
     <input>
</div>

<div>
    <label>Satellite Name:</label>
     <input>
</div>
<div>
    <label>Launch Latitude:</label>
     <input>
</div>
<div>
    <label>Launch Longitude:</label>
     <input>
</div>
<div>
    <label>Launched Date:</label>
     <input type="date">
</div>
<div>
    <label>Orbital Location:</label>
     <input>
</div>


     <div>
    <button>Submit</button>
</div>
    </form>

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