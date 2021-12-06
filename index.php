<?php 
    require(__DIR__ . '/util/db.connect.php');
?>

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
    <div class="container">
        <header>
            <a href="./index.php" class="logo">
                <i class="fas fa-satellite"></i>
                <h1>Satellite Tracker</h1>
            </a>
            <nav>
                <?php
                    if(isset($_COOKIE["cid"])) {
                        $nameSql = "SELECT company_name FROM Companies WHERE company_id = '".$_COOKIE["cid"]."'";

                        if ($result = $mysqli->query($nameSql)) {
                            $name = $result->fetch_object()->company_name;
                            echo '<p>Welcome, ' . $name . '</p>';
                            echo '<a href="./pages/insertSatellite.php">Add New Satellite</a>';
                            echo '<a href="./pages/updateSatellite.php">Update Satellite</a>';
                            echo '<a href="?logout">Logout</a>';
                        } 

                        if(isset($_GET['logout'])) {
                            unset($_COOKIE['cid']); 
                            setcookie('cid', "", time()-3600, '/'); 
                            header("Location: ./index.php");
                        }
                    } else {
                        echo '<a href="./login/login.php">Login</a>';
                    }
                ?>
            </nav>
        </header>

        <main>
            <div class="company-select">
                <?php
                    $sql = 'SELECT * FROM Companies';
                    error_reporting(E_ERROR | E_PARSE);

                    if ($result = $mysqli->query($sql)) {
                        while ($data = $result->fetch_object()) {
                            $companies[] = $data;
                        }
                    }

                    if(!isset($_GET['company'])) {
                        $_GET['company'] = $companies[0]->company_name;
                    }

                    echo '<h1>' . $_GET['company'] . '</h1>';
                ?>
                <form method="get">
                    <select name="company" id="company" onchange="this.form.submit()">
                        <?php
                            foreach($companies as $company) {
                                if($company->company_name == $_GET['company']) {
                                    echo '<option value="'.$company->company_name.'" selected>'.$company->company_name.'</option>';

                                } else {
                                    echo '<option value="'.$company->company_name.'">'.$company->company_name.'</option>';
                                }
                            }
                        ?>
                    </select>
                </form>
            </div>
            <div id="map"></div>
            <div id="info">
                <div>
                    <h2>Satellites in orbit</h2>
                    <table id="orbit-table">
                        <tr>
                            <th>Satellite Name</th>
                            <th>Model</th>
                            <th>Launch Date</th>
                            <th>Launch Site Latitude</th>
                            <th>Launch Site Longitude</th>
                            <th>Altitude</th>
                            <th>Inclination</th>
                            <th>Color</th>
                            <th>Display</th>
                        </tr>
                        <?php
                            $launched_sql = "SELECT * FROM `In-Orbit` O
                            INNER JOIN Satellites S ON S.satellite_id = O.satellite_id 
                            INNER JOIN (SELECT * FROM Companies WHERE company_name = '".addslashes(trim($_GET['company']))."') C 
                            ON S.company_id = C.company_id";

                            if ($result = $mysqli->query($launched_sql)) {
                                while ($data = $result->fetch_object()) {
                                    $launched[] = $data;
                                }
                            }

                            foreach($launched as $launch) {
                                echo '<tr>';
                                echo '<td>'.$launch->satellite_name.'</td>';
                                echo '<td>'.$launch->model.'</td>';
                                echo '<td>'.$launch->launch_date.'</td>';
                                echo '<td>'.$launch->launch_latitude.'</td>';
                                echo '<td>'.$launch->launch_longitude.'</td>';
                                echo '<td>'.$launch->altitude.'</td>';
                                echo '<td>'.$launch->inclination.'</td>';
                                echo '<td class="map-label"><span class="orbit-color"></td>';
                                echo '<td><input type="checkbox" checked>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>

                <div>
                    <h2>Satellites waiting to be launched</h2>
                    <table id="launch-table">
                        <tr>
                            <th>Satellite Name</th>
                            <th>Model</th>
                            <th>Pending Launch Date</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Color</th>
                            <th>Display</th>
                        </tr>
                        <?php
                            $pending_sql = "SELECT * FROM Pending P 
                                INNER JOIN Satellites S ON S.satellite_id = P.satellite_id 
                                INNER JOIN (SELECT * FROM Companies WHERE company_name = '".addslashes(trim($_GET['company']))."') C 
                                ON S.company_id = C.company_id";

                            if ($result = $mysqli->query($pending_sql)) {
                                while ($data = $result->fetch_object()) {
                                    $pendings[] = $data;
                                }
                            }
                            
                            foreach($pendings as $pending) {
                                echo '<tr>';
                                echo '<td>'.$pending->satellite_name.'</td>';
                                echo '<td>'.$pending->model.'</td>';
                                echo '<td>'.$pending->pending_date.'</td>';
                                echo '<td>'.$pending->pending_latitude.'</td>';
                                echo '<td>'.$pending->pending_longitude.'</td>';
                                echo '<td class="map-label"><span class="site-color"></td>';
                                echo '<td><input type="checkbox" checked>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>
            </div>
        </main>

        <footer>
            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
        </footer>
    </div>
</body>
</html>
