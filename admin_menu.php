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
    <title>Admin Dashboard | Cit-E Cycling</title>

    <link rel="icon" href="./resources/logo.png">
    <link rel="stylesheet" href="./css/admin_menu.css">
</head>

<body>

<div class="dashboard">

    <div class="header">

        <img src="./resources/logo.png" alt="Logo">

        <h1>Cit-E Cycling</h1>

        <p>
            Welcome to the administrator dashboard. From here you can manage
            participants, search for clubs and riders, update competition
            results, and maintain participant records.
        </p>

    </div>

    <div class="cards">

        <a href="search_form.php" class="card">

            <div class="icon">🔍</div>

            <h2>Search</h2>

            <p>
                Search for individual participants or cycling clubs and
                view competition statistics.
            </p>

        </a>

        <a href="view_participants_edit_delete.php" class="card">

            <div class="icon">🚴</div>

            <h2>Manage Participants</h2>

            <p>
                View all registered participants, update their performance,
                or remove participants from the competition.
            </p>

        </a>

        <a href="logout.php" class="card logout">

            <div class="icon">🚪</div>

            <h2>Logout</h2>

            <p>
                Securely end your administrator session.
            </p>

        </a>

    </div>

</div>

</body>
</html>