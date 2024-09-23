<?php include "head.php";
$currentPage = 'about'; ?>
<html>

<head>
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url('./pictures/aboutBack.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        #about {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 90%;
            height: 100%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(255, 255, 255, 0.3) 0px 30px 60px -30px;
            border-radius: 20px;
        }

        #ministers {
            display: flex;
            gap: 20px;
            width: 100%;
            align-items: stretch;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .bio {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 40px;
            border-radius: 20px;
            width: 40%;
            font-size: 1.1rem;
            text-align: center;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
            height: 100%;
        }

        .bio img {
            width: 80%;
            margin: 0 auto;
            height: auto;
            object-fit: cover;
            border-radius: 50%;
        }

        p {
            margin-bottom: 10px;
        }

        @media screen and (max-width: 600px) {

            #our-story,
            #ministers {
                flex-direction: column;
                align-items: center;
            }

            #about {
                width: 100%;
            }

            #about img {
                width: 100%;
            }

            #ministers .bio {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <?php include "header.php" ?>
    </header>
    <div id="about">
        <div id="our-story">
            <h2>Our Story</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis, dignissimos? Consequuntur, earum delectus voluptatibus ad minus quidem architecto, quas vitae maxime voluptates necessitatibus, veniam quo rerum. Quod, autem! Iure, error nisi.</p>
        </div>

        <div id="ministers">
            <div class="bio">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="Picture Of the pastor">
                <div class="text">
                    <h3>Pastor Vladiminr Pinchinat</h3>
                    <p>Pastor Vladimyr Pinchinat has been a guiding light and a pillar of faith for the Christian Church of Silver Spring for many years. Born into a devout Christian family, Pastor Pinchinat's journey with God began early in his life. From a young age, he felt a strong calling to serve the Lord and bring His message of love, hope, and redemption to others.</p>

                    <p>After completing his theological studies, Pastor Pinchinat embarked on a mission to spread the Word of God far and wide. His passion for ministry and his deep understanding of the scriptures quickly earned him a reputation as a powerful preacher and a compassionate leader. His sermons are known for their depth, clarity, and the profound impact they have on those who hear them.</p>

                    <p>In 2005, Pastor Pinchinat was called to lead the Christian Church of Silver Spring. Under his leadership, the church has grown not just in numbers but in spiritual strength. His vision has always been to create a community where everyone feels welcomed, loved, and supported in their spiritual journey. He has a unique ability to connect with people from all walks of life, understanding their struggles, and guiding them with wisdom and grace.</p>

                    <p>Pastor Pinchinat is not just a preacher but a pastor in the truest sense of the word. He is deeply involved in the lives of his congregation, offering counsel, prayer, and support to those in need. His dedication to his flock is evident in everything he does, from visiting the sick to organizing community outreach programs that serve the less fortunate.</p>

                    <p>One of the hallmarks of Pastor Pinchinat’s ministry is his unwavering commitment to the youth of the church. He believes that the future of the church lies in the hands of the younger generation and has worked tirelessly to mentor and inspire young leaders. Through youth programs, Bible studies, and personal mentorship, he has helped many young people find their purpose and place in God's plan.</p>

                </div>
            </div>
            <div class="bio">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="picture of the Minister">
                <div class="text">
                    <h3>Minster Elekwachi</h3>
                    <p>Minister Elekwachi is a dedicated and passionate servant of God, known for his unwavering commitment to spreading the message of faith and hope. His journey in ministry began with a deep calling to serve the community and lead others towards spiritual growth.</p>
                    <p>Born and raised in a devout Christian family, Minister Elekwachi's early years were marked by a strong foundation in biblical teachings. This upbringing, coupled with his personal experiences, shaped his profound understanding of the Word and his desire to share it with others.</p>
                    <p>Minister Elekwachi is widely recognized for his dynamic preaching style, which blends powerful storytelling with deep theological insights. He has a unique ability to connect with people from all walks of life, making the teachings of the Bible accessible and relatable.</p>
                    <p>Throughout his ministry, Minister Elekwachi has been instrumental in leading various community outreach programs, aimed at uplifting the less fortunate and spreading the love of Christ. His work has touched the lives of many, bringing hope and transformation to those in need.</p>
                    <p>Minister Elekwachi's leadership is characterized by humility, compassion, and a relentless pursuit of truth. He continues to inspire and mentor the next generation of believers, guiding them on their spiritual journey with wisdom and grace.</p>
                    <p>As a beloved figure in the church community, Minister Elekwachi's legacy is one of faith, service, and unwavering dedication to the gospel. His life and ministry stand as a testament to the power of a life lived in service to God and others.</p>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php' ?>

</html>