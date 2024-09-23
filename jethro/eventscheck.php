<?php
require 'db_class.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header('Location: adminLogin.php');
    exit(); // Prevent further execution of the script
}

$user = $_SESSION['user'];
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 20px;
    }

    th,
    td {
        border: 2px solid var(--underline);
        padding: 8px;
        text-align: left;
    }
</style>

<body>
    <h1>Events</h1>

    <?php
    displayCalendar("viewevent");
    ?>

</body>