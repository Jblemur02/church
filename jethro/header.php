<!DOCTYPE html>
<style>
    nav {
        height: auto;
        list-style-type: none;
        text-align: center;
        border-radius: 2deg;
        width: 100%;
        margin: 0 auto;
    }

    nav ul {
        width: 80%;
        padding: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-bottom: white solid 1px;
        backdrop-filter: blur(1px);
        background-color: transparent;
        margin: 0 auto;
    }

    nav ul li {
        display: inline;
    }

    nav ul li a {
        color: #f3da8c;
        text-align: center;
        font-size: 1.2rem;
        text-decoration: none;
        padding: 1%;
        border-radius: 20px;
        position: relative;
    }

    nav ul li a:active,
    nav ul li a.active {
        font-weight: bold;
    }

    nav ul li a:active::after,
    nav ul li a.active::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 1px;
        background-color: wheat;
        bottom: 0;
        left: 0;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    nav ul li a:hover::after,
    nav ul li a.active::after {
        transform: scaleX(1);
    }

    @media screen and (max-width: 600px) {
        nav ul {
            width: 100%;
            padding: 5px;
        }
    }
</style>

<html>
<nav id="navbar">
    <ul>
        <li><a href="index.php" <?php if ($currentPage === 'home') echo 'class="active"'; ?>>Home</a></li>
        <li><a href="events.php" <?php if ($currentPage === 'events') echo 'class="active"'; ?>>Events</a></li>
        <li><a href="sermons.php" <?php if ($currentPage === 'sermons') echo 'class="active"'; ?>>Sermons</a></li>
        <li><a href="about.php" <?php if ($currentPage === 'about') echo 'class="active"'; ?>>About</a></li>
        <li><a href="contact.php" <?php if ($currentPage === 'contact') echo 'class="active"'; ?>>Contact</a></li>
    </ul>
</nav>

</html>