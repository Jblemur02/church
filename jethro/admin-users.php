<?php require "db_class.php";
$db = new sql_class;
$admins = $db->execute("SELECT * FROM admins");?>

<style>
    #title{
        color:black;
    }

    .whereto {
        display: flex;
        justify-content: center;
        align-items: center;
    }

   .whereto li {
        list-style-type: none;
        margin: 0 1%;
        padding: 10%;
    }

    .whereto li a:visited,
    .whereto li a{
        color:white;
        text-decoration: none;
    }

    .whereto li a{
        border: 2px cyan solid;
        background-color: #3295a8;
        display: block;
        padding: 10px;
    }

    form{
        margin: 0 auto;
        width: 20%;
        text-align: center;
    }

    .formbreak{
        margin-bottom: 20px;
    }
    h2{
        text-align: center;
    }
    .bacl{
        text-align: center;
    }
    .back:visited,
    .back{
        border: 2px cyan solid;
        background-color: #3295a8;
        color:white;
        text-decoration: none;
        padding: 1%;
        position: relative;
        top: 5%;
        left: 0;
    }
</style>

<html>
    <div id="content"> 
        <h1 id="title">View and add Users</h1>
        <div class="whereto">
            <li><a href="#" onclick="loadContent('view-users')">View Users</a></li>
            <li><a href="#" onclick="loadContent('add-users')">Add Users</a></li>
        </div>
    </div>
    <script>
        // Call the loadContent function with the 'default' contentId when the page loads
        window.onload = function() {
            loadContent('default');
        };

        function loadContent(contentId) {
            // Clear the existing content
            document.getElementById('content').innerHTML = '';

            // Load new content based on the clicked link
            if (contentId === 'view-users') {
                // Load view users content
                document.getElementById('content').innerHTML =`
                <a class="back" href="#" onclick="loadContent('default')">Back</a>
                <h2>View Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($admins as $admin) {
                            echo "<tr>";
                            echo "<td>".$admin['username']."</td>";
                            echo "<td>".$admin['firstname']."</td>";
                            echo "<td>".$admin['lastname']."</td>";
                            echo "<td>".$admin['email']."</td>";
                            echo "<td>";
                            echo "<a href='#' class=' nav-link' onclick='loadContent(\"viewadmin\")' data-page='viewadmin.php?id=".$admin['id']."'>";
                            echo "<img src='./pictures/view.png' alt='eye' style='width: 20px; height: auto; margin-right: 5px;'>";
                            echo "</a>";
                            echo "</td>";
                        }
                    ?>
                    </tbody>
                </table>
                `;
            } else if (contentId === 'add-users') {
                // Load add users content
                document.getElementById('content').innerHTML = `
                <a class="back" href="#" onclick="loadContent('default')">Back</a>
                    <h2>Add Users</h2>
                    <form id="addUserForm">
                        <div class="form-break">
                            <label for="name">Username:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-break">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-break">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-break">
                            <input type="submit" value="Add User">
                        </div>
                    </form>
                `;
            } else if (contentId === 'default') {
                // Load default content
                document.getElementById('content').innerHTML = `
                <h1 id="title">View and add Users</h1>
                    <div class="whereto">
                        <li><a href="#" onclick="loadContent('view-users')">View Users</a></li>
                        <li><a href="#" onclick="loadContent('add-users')">Add Users</a></li>
                    </div>`;
            } else if (contentId === "viewadmin") {
                document.getElementById('content').innerHTML = `
                <h1><?php echo $admin['firstname'];?></h1>
                <a class="back" href="#" onclick="loadContent('view-users')">Back</a>
                `
            } else {
                // Handle invalid contentId
                console.error('Invalid contentId:', contentId);
            }
            // Prevent the default link behavior
            return false;
        }
    </script>
    
</html>