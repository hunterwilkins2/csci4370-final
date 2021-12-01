<?php

require_once "config.php";
$username = $cid = $password = $confirm_password = "";
$username_err = $cid_err = $password_err = $confirm_password_err = "";
 
// process form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // set up username
   if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        $sql = "SELECT username FROM Users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "There was an error."; // execute fail
            }
            unset($stmt);
        }
    }
    
    // set up password
   if(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // set up confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords did not match.";
        }
    }

    // set up cid
    if(empty(trim($_POST["cid"]))){
        $cid_err = "Please enter your cid.";  
    } else {
        $sql = "SELECT cid FROM Users WHERE cid = :cid";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":cid", $param_cid, PDO::PARAM_STR);
            $param_cid = trim($_POST["cid"]);
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $cid_err = "This cid is already registered.";
                } else {
                    $cid = trim($_POST["cid"]);
                }
            }
        } else {
            echo "There was an error."; // execute fail
        }
        unset($stmt);
    }
    
    // check input errors again then insert in Satellite.sql
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($cid_err)){
        $sql = "INSERT INTO Users (username, password, cid) VALUES (:username, :password, :cid)";
         
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":cid", $param_cid, PDO::PARAM_STR);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_cid = $cid;
            
            // execute prepared sql
            if($stmt->execute()){
                setcookie("cookie", $cid); // cookie will expire when browser closes
               
                //header("Location: login.php");
            } else {
                echo "There was an error."; // execute fail
            }
            unset($stmt); // close
        }
    }
    unset($pdo); // close
}
?>
 
 <!-- registration page -->
<!DOCTYPE html>
<html lang="en">
<title>Register</title>
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
<h2>Register an Account</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Username</label><br>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                <br><br>
                <label>Company Identification Number</label><br>
                <input type="text" name="cid" class="form-control <?php echo (!empty($cid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cid; ?>">
                <span class="invalid-feedback"><?php echo $cid_err; ?></span>
                <br><br>
                <label>Password</label><br>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                <br><br>
                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                <br><br>
                <input type="submit" class="button" value="Create account"> 
                <br><br>
            </div>
            <p>Login to your account <a href="login.php">here</a>.</p>
        </form>  
        
        <footer>

            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>

        </footer>
</body>
</html>