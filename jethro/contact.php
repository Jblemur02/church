<?php
include "head.php";
$currentPage = 'contact';
require 'db_class.php';
$db = new sql_class();
$result = $db->execute("SELECT subject_name FROM subjects");
$calculate = $db->execute("SELECT count(*) FROM subjects");
$howmany = $calculate[0]["count(*)"];
?>

<head>
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url('./pictures/contactBack.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            width: 80%;
            margin: 5% auto;
            background-color: white;
            padding: 1%;
            background-color: transparent;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background-image: linear-gradient(120deg, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.2));
        }

        #right,
        #left {
            width: 50%;
            text-align: center;
        }

        #left {
            color: white;
            font-size: 1.5rem;
        }

        #left h2 {
            border-bottom: 2px solid white;
            color: wheat;
        }

        #left a {
            color: wheat;
            transition: color 0.3s ease;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .inputArea {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .inputArea input[type="text"],
        .inputArea input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
            background-color: transparent;
            transition: border-color 0.5s ease;
        }

        .inputArea label {
            position: absolute;
            top: 0;
            left: 10px;
            transform: translateY(10px);
            font-size: 1rem;
            color: gray;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .inputArea input:focus {
            outline: none;
            border-color: wheat;
        }

        .inputArea input:focus+label,
        .inputArea input:not(:placeholder-shown)+label {
            transform: translateY(-20px);
            font-size: 0.85rem;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid black;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: gray;
        }

        @media screen and (max-width: 600px) {
            main {
                flex-direction: column;
            }

            form {
                margin-top: 20px;
            }

            #left,
            #right {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <div><?php include "header.php"; ?></div>
    </header>

    <main>

        <div id="left">
            <h2>Our info</h2>
            <p>Address: 123 Main St, City, State, Zip</p>
            <p>Phone: <a href="tel:555-555-0100">123-456-7890</a></p>
            <p>Email: <a href="mailto:info@example.com">info@example.com</a></p>
        </div>

        <div id="right">
            <form method="post">
                <div class="inputArea">
                    <input type="text" id="name" name="name" placeholder=" " required>
                    <label for="name">Name</label>
                </div>

                <div class="inputArea">
                    <input type="email" id="email" name="email" placeholder=" " required>
                    <label for="email">Email</label>
                </div>

                <div class="inputArea">
                    <input type="text" id="phone" name="phone" placeholder=" " required>
                    <label for="phone">Phone</label>
                </div>

                <textarea name="message" id="message" cols="30" rows="10" placeholder="Your Message" required></textarea>
                <input type="submit" value="Submit">
            </form>
        </div>
    </main>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = validate_input($_POST["name"]);
        $email = validate_input($_POST["email"]);
        $phone = validate_input($_POST["phone"]);
        $message = validate_input($_POST["message"]);
        date_default_timezone_set('America/New_York');
        $time = date("Y-m-d H:i:s");
        $sql = "INSERT INTO subs (name, email, phone , message, submission_time) VALUES ('$name', '$email', '$phone', '$message', '$time')";
        $db->execute($sql);
    }
    ?>
</body>