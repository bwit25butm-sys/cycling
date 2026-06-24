<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register your interest</title>
</head>
<body>
    <?php
    //including connection variables  
    include 'dbconnect.php';

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //TODO INSERT - complete the functionality
                if(isset($_POST['submit'])){
                    $firstname = $_POST['firstname'];
                    $surname = $_POST['surname'];
                    $email = $_POST['email'];
                    $power_output = $_POST['power_output'];
                    $distance = $_POST['distance'];

                    $stmt = $conn->prepare("INSERT INTO participant (firstname, surname, email, power_output, distance) VALUES (:firstname, :surname, :email, :power_output, :distance)");
                    $stmt->bindParam(':firstname', $firstname);
                    $stmt->bindParam(':surname', $surname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':power_output', $power_output);
                    $stmt->bindParam(':distance', $distance);
                    $stmt->execute();
                }
                }
            catch(PDOException $e)
                {
                echo $e->getMessage(); //If we are not successful we will see an error

                }


























                //made you look
        
        
        ?>


</body>
</html>