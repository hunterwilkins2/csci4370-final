<?php

session_start();
require_once "config.php";

// if logged in, redirect to homepage
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}

$username = $cid = $password = "";
$username_err = $password_err = $login_err = "";

// process form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // check credentials
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT username, password FROM Users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);
            
            // execute prepared sql
            if($stmt->execute()){
                // if username exists, verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            
                            
                            
                            // to do: retrieve cid value from db and use it to set the cookie at login

                            
                            // cookie will expire when the browser close
                            setcookie("myCookie", $cid);

                            // login success, start a new session
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                            
                            
                            // redirect to homepage
                            header("location: ../index.php");
                        } else{
                            // incorrect password
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // username doesn't exist
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "There was an error."; // execute fail
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>
 
 <!-- login page -->
<!DOCTYPE html>
<html lang="en">
<title>Login</title>
<link rel="stylesheet" href="../styles/login.css">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="./resources/favicon.ico" type="image/x-icon">   
</head>

<header>
    <a href="../index.php" class="logo">
        <i class="fas fa-satellite"></i>            
        <h1>Satellite Tracker</h1>
    </a>
</header>

<body>
<h2>Login</h2>
    <div class="form-center">

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
    
    <div class="form-center">   
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label><br>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <label>Password</label><br>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="button" value="Login">
            </div>
            <br>
            <p>Register an account <a href="register.php">here</a>.</p>
        </form>
    </div>

    <footer>

            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>

        </footer>
</body>
</html>
