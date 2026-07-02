<?php

include 'dbconnect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Participant Scores</title>
    <link rel="icon" size="5x5" type="image/svg+xml" href="./resources/logo.png" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php

try{

    $conn = new PDO(
        "mysql:host=$servername;port=$port;dbname=$database",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $id = $_POST['id'];
        $power_output = trim($_POST['power_output']);
        $distance = trim($_POST['distance']);

        if(!is_numeric($power_output) || !is_numeric($distance)){

            echo "
            <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'error',
                title: 'Invalid Input',
                text: 'Power Output and Distance must be numeric.',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true
            }).then(() => {
                history.back();
            });
            </script>";
            exit();

        }

        $stmt = $conn->prepare("
            UPDATE participant
            SET
                power_output = :power_output,
                distance = :distance
            WHERE id = :id
        ");

        $stmt->bindParam(':power_output',$power_output);
        $stmt->bindParam(':distance',$distance);
        $stmt->bindParam(':id',$id);

        $stmt->execute();

        echo "
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: 'Updated!',
                text: 'Participant updated successfully.',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true
            }).then(() => {
                window.location='view_participants_edit_delete.php';
            });
            </script>";

    }

    else{
        if(!isset($_GET['id'])){
            die("Participant ID missing.");
        }
        $id = $_GET['id'];
        $stmt = $conn->prepare("
            SELECT *
            FROM participant
            WHERE id=:id
        ");

        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $participant = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$participant){

            die("Participant not found.");

        }

        $firstname = $participant['firstname'];
        $surname = $participant['surname'];
        $power_output = $participant['power_output'];
        $distance = $participant['distance'];

        include "edit_participant_form.php";

    }

}

catch(PDOException $e){

    echo $e->getMessage();

}

?>

</body>
</html>