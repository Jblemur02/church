<?php
require 'db_class.php';
$currentPage = 'events';
include 'head.php' ?>

<html>

<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, .8)), url('./pictures/landingBack.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    #event-display {
        padding: 1%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 90%;
        margin: 0 auto;
        border-radius: 20px;
        min-height: 100vh;
        background-color: transparent;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        text-align: center;
        background-image: var(--blur);
        margin: 1% auto;
        color: wheat;
    }

    #upcoming table {
        width: 80%;
        margin: 10px auto;
        border-collapse: collapse;
        table-layout: fixed;
        background-color: white;
        text-align: center;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        color: black;
    }

    th {
        background-color: white;
    }

    #calbut {
        text-align: center;
        width: 100%;
        background-color: white;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        background-color: wheat;
        color: white;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    #mon-year {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 20px;
        font-size: 2rem;
    }

    #calender {
        width: 90%;
        margin: 10px auto;
    }

    #calender table {
        border-collapse: collapse;
        table-layout: fixed;
        width: 100%;
    }

    #calender td {
        border: 1px solid darkgray;
        text-align: right;
        vertical-align: top;
        height: 20vh;
        background-color: white;
        position: relative;
    }

    p {
        text-align: left;
    }

    .prev-next,
    .prev-next:visited {
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
        color: black;
        padding: 10px 20px;
        border-radius: 10px;
    }

    .prev-next:hover {
        background-color: black;
        color: wheat;
    }

    #mon-year {
        margin-left: 10%;
        margin-right: 10%;
        text-align: center;
    }

    .event {
        width: 100%;
        text-align: left;
    }

    .eventlinks,
    .eventlinks:visited {
        border: 1px solid black;
        border-radius: 20px;
        margin: 5px auto;
        width: 80%;
        text-align: center;
        color: black;
        display: flex;
        justify-content: center;
        padding: 10px;
    }

    .eventlinks:hover {
        background-color: burlywood;
    }

    .eventlinks a {
        color: black;
    }
</style>

<body>
    <header>
        <?php include "header.php" ?>
    </header>

    <main>
        <!-- <section id="event-display">
            <div id="recent">
                <h2>Recent Event</h2>
                <div id="slider">
                    <img src="./pictures/event1.jpg" alt="Event 1">
                    <img src="./pictures/event2.jpg" alt="Event 2">
                    <img src="./pictures/event3.jpg" alt="Event 3">
                </div>
            </div>

            <div id="upcoming">
                <h2>Upcoming events</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Event</th>
                            <th>Location</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>12/10/2022</td>
                            <td>Conference</td>
                            <td>Conference Center</td>
                        </tr>

                        <tr>
                            <td>15/11/2022</td>
                            <td>Workshop</td>
                            <td>Workshop Room</td>
                        </tr>

                        <tr>
                            <td>20/12/2022</td>
                            <td>Meeting</td>
                            <td>Meeting Room</td>
                        </tr>

                        <tr>
                            <td>25/01/2023</td>
                            <td>Presentation</td>
                            <td>Presentation Room</td>
                        </tr>

                        <tr>
                            <td>30/01/2023</td>
                            <td>Panel Discussion</td>
                            <td>Panel Room</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section> -->

        <section id="calender">
            <?php displayCalendar("event") ?>
        </section>
    </main>


    <?php include 'footer.php' ?>

</body>

</html>