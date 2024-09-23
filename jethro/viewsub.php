<?php require 'db_class.php';
$db = new sql_class(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submissions</title>
    <link rel="stylesheet" href="./styles/portal.css">
</head>

<dialog id="view-dialog">
    <div class="wrapper">
        <h1>Form Submission</h1>
        <?php
        $submission_id = $_GET['id'];
        $submission = $db->execute("SELECT * FROM subs WHERE id = $submission_id");
        echo "<h2>Submission Details</h2>";
        echo "<p>Name: " . $submission[0]['name'] . "</p>";
        echo "<p>Email: " . $submission[0]['email'] . "</p>";
        echo "<p>Phone: " . $submission[0]['phone'] . "</p>";
        $tempdate = $submission[0]['submission_time'];
        $datetime = new DateTime($tempdate);
        $date = $datetime->format("F j, Y g:i A");
        echo "<p>Submission Time: " . $date . "</p>";
        echo "<p>Message: " . $submission[0]['message'] . "</p>";
        ?>
    </div>
</dialog>

<script>
    function showDialog(dialog, show, id) {
        if (show) {

            dialog.showModal();
            const wrapper = dialog.querySelector('.wrapper');
            dialog.addEventListener('click', (e) => {
                if (!wrapper.contains(e.target)) {
                    showDialog(dialog, false);
                }
            });
        } else {
            dialog.close();
        }
    }

    viewBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const id = e.target.closest('.viewContact').dataset.id;
            showDialog(viewDialog, true, id);
        });
    });
</script>