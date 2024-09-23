<?php require 'db_class.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header('Location: adminLogin.php');
    exit(); // Prevent further execution of the script
}

$db = new sql_class();
?>

<style>
    #developer {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
        height: 100%;
        border-radius: 20px;
        box-shadow: var(--shadow);
        background-color: var(--mini-background);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #buttons {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    #logs {
        width: 100%;
        max-height: 60vh;
        overflow-y: scroll;
        border-radius: 10px;
        padding: 10px;
        margin-top: 20px;
        box-shadow: var(--shadow);
        height: 100%;
    }
</style>

<div id="developer">
    <h1>Update Logs</h1>
    <div id="buttons">
        <a>Request Feature</a>
        <a>Add Log</a>
        <a>Report Bug</a>
    </div>

    <div id="logs">

    </div>
</div>