<?php
require(__DIR__ . '/../util/db.connect.php');

$login_err = "";
if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = addslashes(trim($_POST["username"]));
    $cidSql = "SELECT company_id, password FROM Companies WHERE company_name = '". $username ."'";

    $result = $mysqli->query($cidSql);
    if (mysqli_num_rows($result) == 1) {
        $user = $result->fetch_object();
        $cid = $user->company_id;
        $hash = $user->password;

        if(password_verify(trim($_POST["password"]), $hash)) {
            setcookie("cid", $cid, 0, '/');

            header("Location: ../index.php");
        } else {
            $login_err = "Username or Password were incorrect.";
        }
    } else {
        $login_err = "Username or Password were incorrect.";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../resources/favicon.ico" type="image/x-icon">   

    <title>Login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <header>
        <a href="../index.php" class="logo">
            <i class="fas fa-satellite"></i>            
            <h1>Satellite Tracker</h1>
        </a>
    </header>
    <h2>Login</h2>
    <div class="form-center">

    <?php 
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }        
    ?>
    
    <div class="form-center">   
        <form method="post">
            <div class="form-group">
                <label>Company Name</label><br>
                <input type="text" name="username" class="form-control" pattern="[ a-zA-Z0-9'._]*" title="Invalid company name" required>
            </div>
            <br>
            <div class="form-group">
                <label>Password</label><br>
                <input type="password" name="password" class="form-control" minlength="6" required>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="button" value="Login">
            </div>
            <br>
            <p>Register an account <a href="./register.php">here</a>.</p>
        </form>
    </div>

    <footer>
        <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
    </footer>
</body>
</html>
