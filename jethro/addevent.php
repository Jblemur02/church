<?php
require 'db_class.php';
$db = new sql_class();
$result = $db->execute("SELECT event_type FROM event");
$calculate = $db->execute("SELECT count(*) FROM event");
$howmany = $calculate[0]["count(*)"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add events</title>
    <link rel="stylesheet" href="./styles/portal.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#event-date').datepicker();
    });
    </script>

</head>

<body>
    <header>
        <h1>Add Event</h1>
        <div id="evenbut">
            <button id="backToEvent" onclick="window.location.href='eventscheck.php'">Back to Events</button>
            <button id="eventSubjects" onclick="window.location.href='viewsubjects.php'">Event Types</button>
        </div>
    </header>

    <section>
        <form id="event-form" method="post" enctype="multipart/form-data">
            <label for="event-date">Date of Event:</label>
            <input type="text" id="event-date" name="event_date">
            <br>
            <label for="event-title">Event Title:</label>
            <input type="text" id="event-title" name="event_title">
            <br>
            <label for="event-type">Event Type:</label>
            <select name="event-type" id="event_type">
            <?php
                for($i = 0; $i < $howmany; $i++){
                    echo "<option value='".$result[$i]['event_type']."'>".$result[$i]['event_type']."</option>";
                }
            ?>
            </select>
            <br>
            <label for="event-video">Video link:</label>
            <input type="text" id="event-video" name="event_video">
            <br>
            <!-- Add other event input fields here -->
            <button type="submit">Submit</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tempdate = validate_input($_POST["event_date"]);
            $date = date("Y-m-d", strtotime($tempdate));
            $title = validate_input($_POST["event_title"]);
            $type = $_POST["event_type"];
            $videolink = validate_input($_POST["event_video"]);
            $sql = "INSERT INTO events(date, title, type,videolink) 
                    VALUES ('$date', '$title', '$type','$videolink')";

            $db->execute($sql);
            echo "<p>Event Added <img style='width: 1em; height: 1em;display: inline-block;
            vertical-align: middle;' src='./pictures/checkmark.avif'></p>";
        }
        ?>