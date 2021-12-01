<?php
require(__DIR__ . '/../util/db.connect.php');

$register_err = "";

if(isset($_POST["username"]) && isset($_POST["address"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
    $username = addslashes(trim($_POST["username"]));
    $address = addslashes(trim($_POST["address"]));
    $passHash = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $insertSql = "INSERT INTO Companies (company_name, password, address) 
        VALUES ('". $username ."', '". $passHash ."', '". $address ."')";

    if($_POST["password"] == $_POST["confirm_password"] && $_POST["password"] != "") {
        if($mysqli->query($insertSql) === TRUE) {
            $cidSql = "SELECT company_id FROM Companies WHERE company_name = '". $username ."'";
            $result = $mysqli->query($cidSql);
            
            if (mysqli_num_rows($result) == 1) {
                $cid = $result->fetch_object()->company_id;

                setcookie("cid", $cid, 0, '/');

                header("Location: ../index.php");
            }
        } else {
            // Checks for duplicate email
            if($mysqli->errno == 1062) {
                $register_err = "That email has already been used.";
            } else {
                $register_err = "Could not create user.";
            }
        }                        
    } else {
        $register_err = "Passwords do not match.";
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

    <title>Register</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <header>
        <a href="../index.php" class="logo">
            <i class="fas fa-satellite"></i>            
            <h1>Satellite Tracker</h1>
        </a>
    </header>
    <h2>Register an Account</h2>
        <form method="post">
            <div>
                <?php
                    if(!empty($register_err)){
                        echo '<div class="alert alert-danger">' . $register_err . '</div>';
                    }    
                ?>
                <label>Company Name</label><br>
                <input type="text" name="username" class="form-control" pattern="[ a-zA-Z0-9'._]*" title="Invalid company name" required>
                <br><br>
                <label>Company Address</label><br>
                <input type="text" name="address" class="form-control" pattern="[ a-zA-Z0-9'._]*" title="Invalid address" required>
                <br><br>
                <label>Password</label><br>
                <input type="password" name="password" class="form-control" minlength="6" required>
                <br><br>
                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password" class="form-control" minlength="6" required>
                <br><br>
                <input type="submit" class="button" value="Create account"> 
                <br><br>
            </div>
            <p>Login to your account <a href="./login.php">here</a>.</p>
        </form>  
        
    <footer>
        <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
    </footer>
</body>
</html>
