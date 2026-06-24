<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete participant</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
include 'dbconnect.php';

try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$database",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare("DELETE FROM participant WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Deleted!',
                text: 'Participant deleted successfully.',
                icon: 'success'
            }).then(() => {
                window.location.href='view_participants_edit_delete.php';
            });
        </script>";

        header("refresh:2;url=view_participants_edit_delete.php");
    }
    else{
        echo "No participant ID provided.";
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>


</body>
</html>