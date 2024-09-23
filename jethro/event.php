<?php
require 'head.php';
require 'db_class.php';
$db = new sql_class;
$currentPage = 'events';
?>

<style>
    h2{
        text-align: center;
    }
    p{
        text-indent: 0%;
        text-align: center;
    }
</style>

<html>

    <body>

        <header>
            <div id="banner">
                <?php include 'header.php'; ?>
            </div>
        </header>

        <section>
        <?php 
        if(isset($_GET['id'])) {
        $event_id = $_GET['id'];
        $event = $db->execute("SELECT * FROM events WHERE id = $event_id");
        if($event) {
            echo "<h2>".$event[0]['title']."</h2>";
            echo "<p>".$event[0]['event_type']." on ".cleanUpDate($event[0]['date'])."</p>";
            echo '<iframe width="560" height="315" src="' .convertToEmbedLink($event[0]['videolink']). '" frameborder="0" allowfullscreen></iframe>';
        }
    }
    ?>
        </section>

        <footer>
            <? include 'footer.php';?>    
        </footer>

    </body>

</html>