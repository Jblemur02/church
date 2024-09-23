<?php
session_start();
require 'db_class.php';
$db = new sql_class;
$admins = $db->execute("SELECT * FROM admins");

function checkLogin($username, $password)
{
    global $admins;

    foreach ($admins as $admin) {
        if ($admin['username'] === $username && $admin['password'] === $password) {
            return $admin;
        }
    }
    return false;
}

$error = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Both username and password are required.';
    } else {
        $admin = checkLogin($username, $password);
        if (!$admin) {
            $error = 'Invalid username or password.';
        } else {
            $set = "UPDATE admins SET active = TRUE WHERE id = {$admin['id']}";
            $db->execute($set);
            $_SESSION['user'] = $admin;
            header('Location: mainportal.php');
            exit;
        }
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="./pictures/landingBack.png" type="image/x-icon">
    <link rel="shortcut icon" href="./pictures/landingBack.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
            background-color: black;
        }

        body {
            padding: 0;
            margin: 0;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url('./pictures/landingBack.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        main {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        #right,
        #left {
            height: 100%;
        }

        #left {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 20px 0 0 20px;
            width: 30%;
            box-sizing: border-box;
            background-color: transparent;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.2));
            border-radius: 0 20px 20px 0;
            color: white;
        }

        #right {
            width: 70%;
        }

        input {
            margin: 10px 0;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid white;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
        }

        input:focus {
            border-color: wheat;
        }

        .incorrect {
            color: red;
            border-color: red;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        form div {
            text-align: center;
            margin-bottom: 10px;
        }

        #errorMsg {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: red;
            font-weight: bold;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            background-color: white;
            color: black;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: wheat;
            color: white;
        }
    </style>
</head>

<body>
    <main>
        <div id="left">
            <h1>Login</h1>
            <?php if (isset($error)): ?>
                <p id="errorMsg"><?php echo $error; ?></p>
            <?php else: ?>
                <p id="errorMsg"></p>
            <?php endif; ?>

            <form id="form" method="POST" action="">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                </div>

                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>
                <input type="submit" value="Login">
            </form>
        </div>
        <div id="right"></div>
    </main>

    <script>
        localStorage.removeItem("lastPage");
        const errorMsg = document.getElementById('errorMsg');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const form = document.getElementById('form');

        form.addEventListener('submit', (e) => {
            let errors = [];
            // Reset error styles on each submit
            usernameInput.classList.remove('incorrect');
            passwordInput.classList.remove('incorrect');

            if (usernameInput.value.trim() === '') {
                errors.push('Username is required.');
                usernameInput.classList.add('incorrect');
            }
            if (passwordInput.value.trim() === '') {
                errors.push('Password is required.');
                passwordInput.classList.add('incorrect');
            }

            if (errors.length > 0) {
                errorMsg.innerHTML = errors.join('<br>');
                e.preventDefault(); // Prevent form submission
            }
        });

        // Attach the input event to remove 'incorrect' class when user starts typing
        const inputs = [usernameInput, passwordInput];
        inputs.forEach((input) => {
            input.addEventListener('input', () => {
                input.classList.remove('incorrect');
                errorMsg.innerHTML = ''; // Clear error message when user starts typing again
            });
        });
    </script>

</body>

</html>