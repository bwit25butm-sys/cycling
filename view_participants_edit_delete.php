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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View participants</title>
    <link rel="stylesheet" href="./css/view.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>View all of the participants for edit or delete</h1>
    <a href="./admin_menu.php" class="back-btn">
        ← Back to Dashboard
    </a>        
    <?php
        
    //including connection variables - remember to update these if you are using XAMPP    
    include 'dbconnect.php';
        
        try {
            $conn = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password); //building a new connection object
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //TODO SELECT - view the participants with links to edit or delete them. 
            $stmt=$conn->prepare("SELECT * FROM participant");
            $stmt->execute();
            $result=$stmt->fetchall(PDO::FETCH_ASSOC);

            if(count($result)){
                echo "<table border='1'>";
                echo "<tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Sur Name</th>
                        <th>Email</th>
                        <th>Power Output</th>
                        <th>Distance</th>
                        <th>Actions</th>
                    </tr>";

                foreach($result as $row){
                    echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['firstname']."</td>";
                        echo "<td>".$row['surname']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['power_output']."</td>";
                        echo "<td>".$row['distance']."</td>";
                        echo "<td class='actions'>
                        <a class='btn view' href='edit_participant.php?id=".$row['id']."'>View</a>
                        <a class='btn edit' href='edit_participant.php?id=".$row['id']."'>Edit</a>
                        <a class='btn delete' href='delete.php?id=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this participant?\")'>Delete</a>
                    </td>"; 
                    echo "</tr>";
                }
            }else{
                echo ("No Participant Found");
            }

            }
        catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        ?>


</body>
</html>