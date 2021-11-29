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
                <a href="#">Add New Satellite</a>
                <a href="#">Update Satellite</a>
                <a href="#">Login</a>
            </nav>
        </header>

        <main>
        <!-- Insert code here -->
        </main>

        <footer>
            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
        </footer>
    </div>
</body>
</html>
<div>