<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="./resources/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/home.css">

    <title>Satellite Tracker</title>

    
    <script src="./scripts/libraries/p5.min.js" type="text/javascript"></script>
    <script src="./scripts/libraries/mappa.js" type="text/javascript"></script>

    <script src="./scripts/sketch.js" type="text/javascript"></script>
</head>
<body>
    <?php
        require('./util/DotEnv.php');

        (new DotEnv(__DIR__ . '/.env'))->load();

        $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
    ?>
    <div class="container">
        <header>
            <a href="./index.php" class="logo">
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
            <h1>Space X</h1>
            <div id="map"></div>
            <div id="info">
                <table style="width: 100%; border-spacing: 0px;">
                <table id="launch-table">
                    <tr>
                        <th>Pending Launch Date</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Color</th>
                        <th>Display</th>
                    </tr>
                    <tr>
                        <td>10/2/2022</td>
                        <td>10</td>
                        <td>30</td>
                        <td class="map-label"><span class="site-color"></td>
                        <td><input type="checkbox" checked>
                    </tr>
                    <tr>
                        <td>5/30/2024</td>
                        <td>37.09</td>
                        <td>-40.92</td>
                        <td class="map-label"><span class="site-color"></td>
                        <td><input type="checkbox" checked>
                    </tr>
                </table>
            </div>
        </main>

        <footer>
            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
        </footer>
    </div>
</body>
</html>