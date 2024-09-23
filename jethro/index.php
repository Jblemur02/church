<?php include "head.php";
$currentPage = 'home'; ?>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        #landing {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url('./pictures/landingBack.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin-bottom: 20px;
            color: white;
        }

        #sides {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            justify-content: center;
        }

        #top {
            margin: 20px 0;
            height: 20%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-align: center;
            color: white;
        }

        #top h2 {
            color: wheat;
            letter-spacing: 0.8px;
        }

        #top h1 {
            font-size: 2rem;
            margin: 0;
        }

        span {
            font-weight: bold;
            font-style: italic;
            color: wheat;
        }

        #links {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        #links a {
            background-color: white;
            padding: 10px 20px;
            color: black;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #links a:hover {
            background-color: wheat;
            color: black;
        }

        #bottom {
            width: 100%;
            height: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #slideshow {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(255, 255, 255, 0.3) 0px 30px 60px -30px;
        }

        #slideshow .slide {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #slideshow img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        #locations {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            gap: 20px;
            width: 90%;
            margin: 20px auto;
        }

        .location {
            width: 45%;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 1px solid gold;
            padding: 20px;
            box-sizing: border-box;
            background-color: white;
            color: black;
        }

        .location img {
            width: 100%;
            height: 100%;
            /* Fixed height for consistency */
            object-fit: cover;
            /* Cover the area without distortion */
            border-bottom: 1px solid black;
            margin-bottom: 10px;
            /* Spacing between image and text */
        }

        .location p {
            margin: 0;
            /* Remove default margin */
        }

        .location a {
            color: black;
            text-decoration: none;
        }

        .location a:hover {
            text-decoration: underline;
        }

        @media only screen and (max-width: 768px) {
            #slideshow {
                width: 100%;
            }

            #locations {
                flex-direction: column;
            }

            .location {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div id="landing">
        <header>
            <?php include "header.php" ?>
        </header>
        <div id="sides">
            <div id="top">
                <h2>Christian Church Of Silver Spring</h2>
                <h1>"Only Believe, <span>All Things</span> Are Possible"</h1>

                <div id="links">
                    <a href="contact.php">Contact Us</a>
                    <a href="sermons.php">View Sermons</a>
                </div>
            </div>

            <div id="bottom">
                <div id="slideshow">
                    <div class="slide">
                        <img src="./pictures/slider/slide1.png" alt="Slideshow Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="locations">
        <div class="location">
            <img src="./pictures/elementary.png" alt="Canon Road Elementary">
            <p><a target="_blank" href="https://maps.app.goo.gl/yeTceYsmHxB1DkCU7">Canon Road Elementary</a><br>Sunday service 10:30 AM</p>
        </div>

        <div class="location">
            <img src="./pictures/niceChurch.jpg" alt="Hollywood Ave">
            <p><a target="_blank" href="https://maps.app.goo.gl/oWB268582vsbakxv7">807 Hollywood Ave</a><br>Wednesday and Sunday night service 7:30 PM</p>
        </div>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>