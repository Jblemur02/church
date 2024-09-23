<?php require 'db_class.php';
$db = new sql_class();?>

<!DOCTYPE html>
<html>

<body>
    <div id="header">
        <h1>View/Edit Sermon</h1> 
    </div>

    <section>
    <?php 
        if(isset($_GET['id'])) {
        $sermon_id = $_GET['id'];
        $sermon = $db->execute("SELECT * FROM sermons WHERE id = $sermon_id");
        if($sermon) {
            echo "<h2>".$sermon[0]['name']."</h2>";
            echo "<p>Preached By: ".$sermon[0]['preacher']."</p>";
            $temptime = $sermon[0]['time'];
            $time = date("h:i A", strtotime($temptime));
            echo "<p>Preached on: ".cleanUpDate($sermon[0]['date'])," at ",$time."</p>";
            echo '<iframe width="560" height="315" src="' .convertToEmbedLink($sermon[0]['link']). '" frameborder="0" allowfullscreen></iframe>'; 
        }
    }
    ?>
    </section>

</body>
</html>