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
    <link rel="icon" size="5x5" type="image/svg+xml" href="./resources/logo.png" />
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
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Logged out successfully',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true
                    }).then(() => {
                        window.location = 'admin_login.html';
                    });
                    </script>";

                    exit();
                }

                // Check login
                $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password ");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);

                $stmt->execute();

                if ($stmt->rowCount() == 1) {

                    $_SESSION['admin'] = true;
                    $_SESSION['username'] = $username;

                    echo "
                        <script>
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Login successful',
                            text: 'Welcome, Administrator!',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true
                        }).then(() => {
                            window.location = 'admin_menu.php';
                        });
                        </script>";
                } else {

                    echo "
                    <script>
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'warning',
                        title: 'Login Failed',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true
                    }).then(() => {
                        window.location = 'admin_login.html';
                    });
                    </script>";

                }
                }
            catch(PDOException $e)
            {
                echo "
                <script>
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Database Error',
                    text: 'Something went wrong in database.',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true
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
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true
                }).then(() => {
                    window.location='admin_login.html';
                });
                </script>";

            }
        ?>
    </body>
</html>