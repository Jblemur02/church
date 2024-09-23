<?php
require 'db_class.php';
session_start();
$user = $_SESSION['user'];

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header('Location: adminLogin.php');
    exit(); // Prevent further execution of the script
}
$db = new sql_class();
$subsQuery = "SELECT * FROM subs WHERE viewed = 0 ORDER BY submission_time DESC LIMIT 3";
$submissions = $db->execute($subsQuery);
$sermonsQuery = "SELECT * FROM sermons ORDER BY date DESC LIMIT 3";
$sermons = $db->execute($sermonsQuery);
?>


<style>
    h1 {
        text-align: center;
    }

    h1 span {
        color: var(--accent);
    }

    #boxes {
        display: grid;
        gap: 20px;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 40% 60%;
        grid-template-areas:
            "updates updates updates"
            "news contact sermons";
        height: 90%;
    }

    #boxes>div {
        padding: 5%;
        text-align: center;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-color: var(--mini-background);
        box-shadow: var(--shadow);
    }

    #boxes div a {
        color: var(--accent);
        padding: 10px;
        border-radius: 10px;
        box-shadow: var(--hshadow);
    }

    #boxes div a:hover {
        background-color: var(--hover);
    }

    #updates {
        grid-area: updates;
    }

    #news {
        grid-area: news;
    }

    #sermons {
        grid-area: sermons;
    }

    #contact {
        grid-area: contact;
    }

    .contact-form-item,
    .sermon-item,
    .news-item {
        margin-bottom: 10px;
        border: 1px solid var(--text-color);
        padding: 2%;
        border-radius: 20px;
        width: 100%;
        box-shadow: var(--shadow);
        box-sizing: border-box;
    }

    .incoming {
        margin-top: 20px;
        padding: 10px;
        border-radius: 5px;
        background-color: var(--mini-background);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
    }

    @media screen and (max-width: 800px) {
        #boxes {
            overflow-y: scroll;
            grid-template-columns: 1fr;
            grid-template-rows: auto;
            grid-template-areas:
                "updates"
                "news"
                "contact"
                "sermons";
        }

        #boxes>div {
            box-shadow: none;
        }
    }
</style>

<html>
<h1>
    Welcome back <span><?php echo $user['gender'] . ' ' . $user['firstname']; ?></span>
</h1>

<div id="boxes">
    <div id="updates">
        <h2>Updates</h2>
        <p>Stay tuned for the latest updates on our admin console. New features and updates will be added regularly.</p>
    </div>

    <div id="news">
        <h2>News</h2>
        <div class="incoming">
            <div class="news-item">
                <h3>Latest Update</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac neque nec urna fringilla tempor.</p>
                <a href="news.php?id=1">Read more</a>
            </div>

            <div class="news-item">
                <h3>System Announcement</h3>
                <p>Suspendisse potenti. Quisque scelerisque nulla at eros vulputate, vel pretium erat scelerisque.</p>
                <a href="news.php?id=2">Read more</a>
            </div>
        </div>
    </div>

    <div id="sermons">
        <h2>Sermons</h2>
        <div class="incoming">
            <?php if ($sermons): ?>
                <?php foreach ($sermons as $sermon): ?>
                    <div class="sermon-item">
                        <h3><?php echo $sermon['name']; ?></h3>
                        <p><strong>Date:</strong> <?php echo cleanUpDate($sermon['date']); ?></p>
                        <a href="sermon.php?id=<?php echo $sermon['id']; ?>">View sermon</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No sermons available.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="contact">
        <h2>Incoming Contact Forms</h2>
        <div class="incoming">
            <?php if ($submissions): ?>
                <?php foreach ($submissions as $submission): ?>
                    <div class="contact-form-item">
                        <h3>From "<?php echo $submission['name']; ?>"</h3>
                        <p><strong>Date:</strong> <?php echo cleanUpDate($submission['submission_time']); ?></p>
                        <a href="church.com">View submission</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No recent contact forms found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</html>