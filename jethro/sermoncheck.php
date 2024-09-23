<?php
require 'db_class.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header('Location: adminLogin.php');
    exit();
}
$db = new sql_class;

// Handle deletion request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteSermon') {
    error_log("Delete sermon request received for ID: " . $_POST['id']);  // Debugging line

    $id = $_POST['id'];
    if (empty($id)) {
        echo "Error: Sermon ID is missing.";
        exit();
    }

    $delete = $db->execute("DELETE FROM sermons WHERE id = ?", [$id]);
    exit();
}



// Fetch sermons as usual
$sermons = $db->execute("SELECT * FROM sermons");
$result = $db->execute("SELECT Preacher_name FROM preacher");
$calculate = $db->execute("SELECT count(*) FROM preacher");
$howmany = $calculate[0]["count(*)"];
?>


<style>
    #sermons {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
        max-height: 100%;
        border-radius: 20px;
        box-shadow: var(--shadow);
        background-color: var(--mini-background);
    }

    #titles {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 2fr 1fr;
        border-bottom: 1px solid var(--underline);
        background-color: var(--mini-background);
        box-shadow: var(--shadow);
    }

    #header {
        grid-column: span 5;
        text-align: center;
        padding: 1%;
        border-radius: 20px;
    }

    .item {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 2fr 1fr;
        border-bottom: 1px solid var(--underline);
        align-items: center;
    }

    .name,
    .link,
    .preacher,
    .date,
    .action,
    #name,
    #link,
    #preacher,
    #date,
    #action {
        padding: 10px;
        text-align: left;
        display: flex;
        flex-direction: row;
    }

    .link a {
        height: 100%;
        width: 100%;
        display: block;
        color: inherit;
    }

    .actions {
        flex-direction: row;
        display: flex;
    }

    #body {
        overflow-y: scroll;
        height: 100%;
    }

    #add-btn {
        margin: 10px auto;
        padding: 10px 20px;
        border-radius: 20px;
        background-color: var(--primary);
        color: var(--text-color);
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        box-shadow: var(--shadow);
    }

    #add-btn:hover {
        background-color: var(--hover);
        box-shadow: var(--hshadow);
    }

    #actions {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 5%;
        flex-direction: row;
    }
</style>
<html>
<div id="sermons">
    <div id="header">
        <h1>Sermons</h1>
    </div>
    <a id="add-btn">Add Sermon</a>

    <div id="titles">
        <div id="name"><strong>Name</strong></div>
        <div id="preacher"><strong>Preacher</strong></div>
        <div id="date"><strong>Date</strong></div>
        <div id="link"><strong>Link</strong></div>
        <div id="action"><strong>Action</strong></div>
    </div>

    <div id="body">
        <?php foreach ($sermons as $sermon): ?>
            <div class="item">
                <div class="name"><?php echo $sermon['name']; ?></div>
                <div class="preacher"><?php echo $sermon['preacher']; ?></div>
                <div class="date"><?php echo cleanUpDate($sermon['date']); ?></div>
                <div class="link"><a href="<?php echo $sermon['link']; ?>" target="_blank">View Sermon</a></div>
                <div class="actions">
                    <span>
                        <a id="viewSermon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                            </svg>
                        </a>
                    </span>

                    <span>
                        <a id="delete-btn" data-id="<?php echo $sermon['id']; ?>" data-name="<?php echo $sermon['name']; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </a>
                    </span>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<dialog id="add-dialog">
    <div class="wrapper">
        <h1>Add Sermon</h1>

        <form id="sermon-form" method="post" enctype="multipart/form-data">
            <label for="sermon-date">Date Preached:</label>
            <input type="text" id="sermon-date" name="sermon_date">
            <br>
            <label for="time">Service: </label>
            <select name="time">
                <option value="morning">Morning</option>
                <option value="evening">Evening</option>
            </select>
            <br>
            <label for="sermon-title">Sermon Title:</label>
            <input type="text" id="sermon-title" name="sermon_title">
            <br>
            <label for="preacher">Sermon Preacher:</label>
            <select name="sermon-preacher" id="sermon_preacher">
                <?php
                for ($i = 0; $i < $howmany; $i++) {
                    echo "<option value='" . $result[$i]['Preacher_name'] . "'>" . $result[$i]['Preacher_name'] . "</option>";
                }
                ?>
            </select>
            <br>
            <label for="sermon-video">Sermon Video:</label>
            <input type="text" id="sermon-video" name="video">
            <br>
            <label for="audio">Sermon Audio</label>
            <input type="file" id="sermon-audio" name="audio" accept=".mp3">
            <br>
            <label for="file">Sermon Notes</label>
            <input type="file" id="notes-file" name="file" accept=".pdf">
            <br>
            <button type="submit">Submit</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["time"] === 'Morning') {
                $time = "12:00:00";
            } else {
                $time = "20:00:00";
            }
            $tempdate = validate_input($_POST["sermon_date"]);
            $date = date("Y-m-d", strtotime($tempdate));
            $name = validate_input($_POST["sermon_title"]);
            $preacher = validate_input($_POST["sermon-preacher"]);
            $link = validate_input($_POST["video"]);
            $file_destination = "./uploads/notes/" . basename($_FILES["file"]["name"]); // Adjust destination directory for notes
            $file = basename($_FILES["file"]["name"]);
            $audio_destination = "./uploads/audio/" . basename($_FILES["file"]["name"]); // Adjust destination directory for audio
            $audio = basename($_FILES["file"]["name"]);
            $sql = "INSERT INTO sermons (date, name, preacher, link, file,time) 
                    VALUES ('$date', '$name', '$preacher', '$link', '$file','$time')";
            $db->execute($sql);
            echo "<p>Sermon Added <img src='./pictures/checkmark.avif'></p>";
        }
        ?>
    </div>
</dialog>

<dialog id="delete-dialog">
    <div class="wrapper">
        <p id="delete-message"></p>
        <form id="delete-form">
            <input type="hidden" id="delete-id" name="id">
            <button type="button" id="confirm-delete">Delete</button>
            <button type="button" onclick="showDialog(deleteDialog, false)">Cancel</button>
        </form>
    </div>
</dialog>

<dialog id="edit-dialog">
    <form id="edit-form" method="post">
        <input type="hidden" id="edit-id" name="id">
        <label for="edit-name">Name:</label>
        <input type="text" id="edit-name" name="name"><br>
        <label for="edit-preacher">Preacher:</label>
        <input type="text" id="edit-preacher" name="preacher"><br>
        <label for="edit-date">Date:</label>
        <input type="date" id="edit-date" name="date"><br>
        <label for="edit-time">Time:</label>
        <input type="time" id="edit-time" name="time"><br>
        <label for="edit-link">Link:</label>
        <input type="text" id="edit-link" name="link"><br>
    </form>
</dialog>
</div>

<script>
    // Avoid redeclaration by using let/const and ensuring this script runs only once
    const addBtn = document.getElementById("add-btn");
    const addDialog = document.getElementById("add-dialog");
    const deleteBtn = document.getElementById("delete-btn");
    const deleteDialog = document.getElementById("delete-dialog");
    const editBtn = document.getElementById("edit-btn");
    const editDialog = document.getElementById("edit-dialog");

    function showDialog(dialog, show) {
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

    addBtn.addEventListener('click', () => {
        showDialog(addDialog, true);
    });

    deleteBtn.addEventListener('click', () => {
        showDialog(deleteDialog, true);
    });
</script>

</html>