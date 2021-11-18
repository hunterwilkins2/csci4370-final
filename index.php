<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Satellite Tracker</title>
</head>
<body>
    <?php
        require('DotEnv.php');

        (new DotEnv(__DIR__ . '/.env'))->load();

        $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
    ?>
    <div class="container">
        <header>
            <nav>
                <a href="./login.php">Login</a>
            </nav>
        </header>

        <main>

        </main>

        <footer>
            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
        </footer>
    </div>
</body>
</html>