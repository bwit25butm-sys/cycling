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
    <link rel="stylesheet" href="./css/edit_participant_form.css">
</head>
<body>

<div class="form-container">

    <a href="view_participants_edit_delete.php" class="back-link">
        ← Back
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