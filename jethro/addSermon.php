<?php
require "db_class.php";
$db = new sql_class;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sermon_date = $_POST["sermon_date"];
    $sermon_title = $_POST["sermon_title"];
    $preacher = $_POST["sermon-preacher"];
    $time = ($_POST["time"] === "morning") ? "12:00:00" : "20:00:00";
    $video_link = $_POST["video"];

    // File handling
    $file_destination = '';
    $audio_destination = '';

    if (!empty($_FILES['file']['name'])) {
        $file_destination = "./uploads/notes/" . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_destination);
    }

    if (!empty($_FILES['audio']['name'])) {
        $audio_destination = "./uploads/audio/" . basename($_FILES["audio"]["name"]);
        move_uploaded_file($_FILES["audio"]["tmp_name"], $audio_destination);
    }

    $sql = "INSERT INTO sermons (date, name, preacher, link, file, time) 
            VALUES ('$sermon_date', '$sermon_title', '$preacher', '$video_link', '$file_destination', '$time')";

    $result = $db->execute($sql);

    // Return the new sermon data as JSON
    if ($result) {
        $new_sermon = [
            'name' => $sermon_title,
            'preacher' => $preacher,
            'date' => $sermon_date,
            'time' => ($time === "12:00:00") ? "Morning" : "Evening",
            'link' => $video_link,
            'id' => $db->lastInsertId()  // Assuming the SQL class has this method
        ];
        echo json_encode($new_sermon);
    } else {
        http_response_code(500);  // Internal Server Error
        echo json_encode(['error' => 'Failed to add sermon']);
    }
}
