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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <a href="./admin_menu.php" class="back-btn">
        <i class="fa-solid fa-arrow-left-long"></i>
        Back to Dashboard
    </a>


    <h1>Search Participants & Clubs</h1>
    <div class="wrapper">
        <div class="card">
            <h2>
                <i class="fa-solid fa-user"></i>
                Participant Search
            </h2>

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
            <h2>
                <i class="fa-solid fa-people-group"></i>
                Club Search
            </h2>
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