<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'success',
            title: 'Logged Out',
            text: 'You have been logged out successfully.',
            showConfirmButton: false,
            timer: 500,
            timerProgressBar: true
        }).then(() => {
            window.location = 'admin_login.html';
        });
    </script>";
</body>
</html>