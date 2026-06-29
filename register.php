<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $firstname = trim($_POST['firstname']);
                    $surname = trim($_POST['surname']);
                    $email = trim($_POST['email']);
                    $terms = isset($_POST['terms']) ? 1 : 0;
                    // $firstname = $_POST['firstname'];
                    // $surname = $_POST['surname'];
                    // $email = $_POST['email'];
                    // $power_output = $_POST['power_output'];
                    // $distance = $_POST['distance'];

                    // Server-side validation
                    if (
                        empty($firstname) ||
                        empty($surname) ||
                        empty($email) ||
                        $terms == 0
                    ) {

                        echo "
                        <script>
                        Swal.fire({
                            icon:'error',
                            title:'Error',
                            text:'Please complete all fields and accept the terms.'
                        }).then(() => {
                            window.location='register_form.html';
                        });
                        </script>";

                        exit();
                    }

                    // Validate email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                        echo "
                        <script>
                        Swal.fire({
                            icon:'error',
                            title:'Invalid Email',
                            text:'Please enter a valid email address.'
                        }).then(() => {
                            window.location='register_form.html';
                        });
                        </script>";

                        exit();
                    }
                    // $stmt = $conn->prepare("INSERT INTO participant (firstname, surname, email, power_output, distance) VALUES (:firstname, :surname, :email, :power_output, :distance)");
                    // $stmt->bindParam(':firstname', $firstname);
                    // $stmt->bindParam(':surname', $surname);
                    // $stmt->bindParam(':email', $email);
                    // $stmt->bindParam(':power_output', $power_output);
                    // $stmt->bindParam(':distance', $distance);
                    // $stmt->execute();
                    $stmt = $conn->prepare("
                        INSERT INTO interest (firstname, surname, email, terms)
                        VALUES (:firstname, :surname, :email, :terms)
                    ");
                    $stmt->bindParam(':firstname', $firstname);
                    $stmt->bindParam(':surname', $surname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':terms', $terms);

                    $stmt->execute();

                    echo "
                    <script>
                    Swal.fire({
                        icon:'success',
                        title:'Registration Successful',
                        text:'Thank you for registering your interest!'
                    }).then(() => {
                        window.location='index.html';
                    });
                    </script>";

                }

            }
            catch(PDOException $e){

                echo "
                <script>
                Swal.fire({
                    icon:'error',
                    title:'Database Error',
                    text:'".$e->getMessage()."'
                });
                </script>";
                }
            catch(PDOException $e)
                {
                echo $e->getMessage(); //If we are not successful we will see an error

                }


























                //made you look
        
        
        ?>


</body>
</html>