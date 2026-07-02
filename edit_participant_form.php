<?php
$firstname = $firstname ?? '';
$surname = $surname ?? '';
$power_output = $power_output ?? '';
$distance = $distance ?? '';
$id = $id ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Participant Scores</title>
    <link rel="stylesheet" href="./css/register_form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <!-- form container -->
    <div class="form-container">
        <a href="view_participants_edit_delete.php" class="back-link">
            <i class="fa-solid fa-arrow-left-long"></i>
            Back to Participants
        </a>

        <h1>Update Participant Scores</h1>
        <form action="edit_participant.php" method="POST">

            <div class="form-group">
                <label>Firstname</label>
                <input type="text"
                    value="<?php echo htmlspecialchars($firstname); ?>"
                    disabled>
            </div>

            <div class="form-group">
                <label>Surname</label>
                <input type="text"
                    value="<?php echo htmlspecialchars($surname); ?>"
                    disabled>
            </div>

            <div class="form-group">
                <label>Power Output (Watts)</label>
                <input
                    type="number"
                    name="power_output"
                    step="0.01"
                    min="0"
                    value="<?php echo htmlspecialchars($power_output); ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Distance (KM)</label>
                <input
                    type="number"
                    name="distance"
                    step="0.01"
                    min="0"
                    value="<?php echo htmlspecialchars($distance); ?>"
                    required>
            </div>

            <input
                type="hidden"
                name="id"
                value="<?php echo $id; ?>">

            <button class="submit-btn" type="submit">
                Update Participant
            </button>

        </form>

    </div>

</body>
</html>