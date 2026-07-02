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
    include 'dbconnect.php';

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $firstname = trim($_POST['firstname']);
                    $surname   = trim($_POST['surname']);
                    $email     = trim($_POST['email']);
                    $terms     = isset($_POST['terms']) ? 1 : 0;
                    
        /*Required Validation*/
        if (empty($firstname) || empty($surname) || empty($email) || !$terms) 
        {

            echo "
            <script>
            Swal.fire({
                icon:'error',
                title:'Missing Information',
                text:'Please complete all fields and accept the terms.'
            }).then(()=>{
                window.location='register_form.html';
            });
            </script>";
            exit();
        }

        /* Email Validation */

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            echo "
            <script>
            Swal.fire({
                icon:'error',
                title:'Invalid Email',
                text:'Please enter a valid email address.'
            }).then(()=>{
                window.location='register_form.html';
            });
            </script>";
            exit();
        }

        /* Duplicate Email Check */

        $check = $conn->prepare("SELECT id FROM interest WHERE email = :email");
        $check->bindParam(':email', $email);
        $check->execute();

        if ($check->rowCount() > 0) {

            echo "
            <script>
            Swal.fire({
                icon:'warning',
                title:'Email Already Registered',
                text:'This email has already been used to register.'
            }).then(()=>{
                window.location='register_form.html';
            });
            </script>";
            exit();
        }

        /* Insert Data */

        $stmt = $conn->prepare("INSERT INTO interest(firstname, surname, email, terms)VALUES(:firstname, :surname, :email, :terms)");

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
        }).then(()=>{
            window.location='index.html';
        });
        </script>";

    }

} catch(PDOException $e) {

    echo "
    <script>
    Swal.fire({
        icon:'error',
        title:'Database Error',
        text:'Something went wrong while saving your information.'
    }).then(()=>{
        window.location='register_form.html';
    });
    </script>";
}
?>
</body>
</html>