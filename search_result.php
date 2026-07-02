<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="./css/view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<a href="admin_menu.php" class="back-btn">
    <i class="fa-solid fa-arrow-left-long"></i>
    Back to Dashboard
</a>

<?php

include 'dbconnect.php';

try{

    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['participant']) && $_POST['participant']=="1"){

        $name = trim($_POST['firstname']);
        $stmt=$conn->prepare("
            SELECT *
            FROM participant
            WHERE firstname LIKE :name
            OR surname LIKE :name
        ");
        $search="%".$name."%";
        $stmt->bindParam(":name",$search);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h1>Participant Search Results</h1>";
        if(count($result)>0){
            echo "<table>";
            echo "<tr>
                    <th>S.N.</th>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Power Output</th>
                    <th>Distance</th>
                    <th>Club ID</th>
                  </tr>";

            $sn = 1;
            foreach($result as $row){

                echo "<tr>";
                    echo "<td>".$sn++."</td>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['surname']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['power_output']."</td>";
                    echo "<td>".$row['distance']."</td>";
                    echo "<td>".$row['club_id']."</td>";
                echo "</tr>";

            }
            echo "</table>";
        }else{
            echo "<h3>No participant found.</h3>";
        }
    }

    else{
        $club=trim($_POST['club']);
        $stmt=$conn->prepare("
            SELECT
                participant.*,
                club.name
            FROM participant
            INNER JOIN club
            ON participant.club_id=club.id
            WHERE club.name LIKE :club
        ");
        $search="%".$club."%";
        $stmt->bindParam(":club",$search);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<h1>Club Search Results</h1>";

        if(count($result)>0){
            $totalPower=0;
            $totalDistance=0;
            echo "<h3>Club : ".$result[0]['name']."</h3>";
            echo "<table>";
            echo "<tr>
                    <th>S.N.</th>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Power Output</th>
                    <th>Distance</th>
                  </tr>";
            
            $sn = 1;
            foreach($result as $row){
                $totalPower += $row['power_output'];
                $totalDistance += $row['distance'];

                echo "<tr>";
                    echo "<td>".$sn++."</td>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['surname']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['power_output']."</td>";
                    echo "<td>".$row['distance']."</td>";
                echo "</tr>";

            }

            echo "</table>";
            $count=count($result);
            echo "<div class='stats'>";
                echo "<p><strong>Total Power Output:</strong> ".$totalPower."</p>";
                echo "<p><strong>Total Distance:</strong> ".$totalDistance."</p>";
                echo "<p><strong>Average Power Output:</strong> ".number_format($totalPower/$count,2)."</p>";
                echo "<p><strong>Average Distance:</strong> ".number_format($totalDistance/$count,2)."</p>";
            echo "</div>";
        }
        else{
            echo "<h3>No club found.</h3>";
        }
    }
}
catch(PDOException $e){

    echo $e->getMessage();

}

?>

</body>
</html>