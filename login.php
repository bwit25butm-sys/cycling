<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
    
</head>
<body>
    <?php
        
        include 'dbconnect.php';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Get login details
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                // Validation
                if (empty($username) || empty($password)) {

                    echo "
                    <script>
                    Swal.fire({
                        icon:'error',
                        title:'Error',
                        text:'Please enter both username and password.'
                    }).then(() => {
                        window.location='admin_login.html';
                    });
                    </script>";

                    exit();
                }

                // Check login
                $stmt = $conn->prepare("
                    SELECT *
                    FROM user
                    WHERE username = :username
                    AND password = :password
                ");

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);

                $stmt->execute();

                if ($stmt->rowCount() == 1) {

                    $_SESSION['admin'] = true;
                    $_SESSION['username'] = $username;

                    echo "
                    <script>
                    Swal.fire({
                        icon:'success',
                        title:'Login Successful',
                        text:'Welcome Admin!'
                    }).then(() => {
                        window.location='admin_menu.php';
                    });
                    </script>";

                } else {

                    echo "
                    <script>
                    Swal.fire({
                        icon:'error',
                        title:'Login Failed',
                        text:'Invalid username or password.'
                    }).then(() => {
                        window.location='admin_login.html';
                    });
                    </script>";

                }
                }
            catch(PDOException $e)
            {
                echo "
                <script>
                Swal.fire({
                    icon:'error',
                    title:'Database Error',
                    text:'".$e->getMessage()."'
                });
                </script>";

            }

            }
            else{

                echo "
                <script>
                Swal.fire({
                    icon:'warning',
                    title:'Access Denied',
                    text:'You are here by mistake.'
                }).then(() => {
                    window.location='admin_login.html';
                });
                </script>";

            }
        ?>
    </body>
</html>