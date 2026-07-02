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
    <title>Register your interest</title>
    <link rel="stylesheet" href="./css/search_form.css">
</head>

<body>
    <a href="./admin_menu.php" class="back-btn">← Back to Dashboard</a>

<h1>Search Participants & Clubs</h1>

<div class="wrapper">

    <div class="card">

        <h2>🔍 Participant Search</h2>

        <form action="search_result.php" method="POST">

            <label>Name</label>

            <input
                type="text"
                name="firstname"
                placeholder="Enter first name or surname"
                required>

            <input type="hidden" name="participant" value="1">

            <button type="submit">
                Search Participant
            </button>

        </form>

    </div>


    <div class="card">

        <h2>🚴 Club Search</h2>

        <form action="search_result.php" method="POST">

            <label>Club Name</label>

            <input
                type="text"
                name="club"
                placeholder="Enter club name"
                required>

            <button type="submit">
                Search Club
            </button>

        </form>

    </div>

</div>
</body>
</html>