<?php include 'head.php';
require 'db_class.php';
$currentPage = 'sermons';
$db = new sql_class();
$result = $db->execute("SELECT * FROM sermons WHERE display = TRUE");
$tempdate = $result[0]['date'];
$datetime = new DateTime($tempdate);
$date = $datetime->format("F j, Y");
$temptime = $result[0]['time'];
$time = date("h:i A", strtotime($temptime));
$file = './uploads/notes/' . $result[0]['file'];
$audio = './uploads/audio/' . $result[0]['audio'];
?>

<!DOCTYPE html>
<html>

<body>

    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

        <style>
            body {
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('./pictures/sermonsBack.jpg');
                background-size: cover;
                background-repeat: none;
                background-attachment: fixed;
            }

            /* 
            .line {
                position: absolute;
                top: 0;
                height: 1000%;
                background-color: red;
                width: 2px;
                left: 50%;
                z-index: 5;
            } */

            #contnet {
                border-radius: 10px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                padding: 10px;
                width: 90%;
                margin: 0 auto;
                position: relative;
                background-color: white;
            }

            #text {
                display: flex;
                align-items: center;
                align-content: center;
                width: 100%;
                justify-content: center;
                flex-direction: column;
                backdrop-filter: blur(5px);
                -webkit-backdrop-filter: blur(5px);
                background-color: transparent;
            }


            .iframe-container {
                width: 70%;
                height: 50vh;
                border-radius: 10px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                padding: 0;
                margin: 20px auto;
            }

            iframe {
                width: 100%;
                height: 100%;
            }

            #audio-container {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                margin: 20px auto;
            }

            #pdf-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 20px;
                border-radius: 10px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                width: 60%;
                margin: 0 auto;
                position: relative;
            }

            #pdf-render {
                width: 100%;
                position: relative;
            }

            #navigation {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                margin-top: 10px;
                position: absolute;
                bottom: 10px;
                gap: 10px;
                text-align: center;
            }


            #navigation button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            #navigation button:hover {
                background-color: #0056b3;
            }

            #page-num {
                font-size: 16px;
                font-weight: bold;
            }

            #fullscreen-btn,
            #download-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            #fullscreen-btn:hover,
            #download-btn:hover {
                background-color: #0056b3;
            }

            #fullscreen-btn {
                left: 10px;
                right: auto;
            }

            /* Responsive design adjustments */
            @media (max-width: 768px) {
                #pdf-container {
                    width: 90%;
                }

                #fullscreen-btn,
                #download-btn {
                    padding: 8px;
                }

                #navigation button {
                    padding: 8px 16px;
                }

                #page-num {
                    font-size: 14px;
                }
            }

            @media (max-width: 480px) {
                #pdf-container {
                    width: 100%;
                    padding: 5px;
                }

                #fullscreen-btn,
                #download-btn {
                    top: 5px;
                    padding: 5px;
                }

                #navigation button {
                    padding: 5px 10px;
                    font-size: 14px;
                }

                #page-num {
                    font-size: 12px;
                }
            }
        </style>
    </head>

    <body>

        <header>
            <div><?php include "header.php"; ?></div>
        </header>

        <section id="contnet">
            <div id="text">
                <h2>Featured Sermon</h2>
                <h1><?php echo $result[0]['name'] ?></h1>
                <h3>By <?php echo $result[0]['preacher'], " on ", $date, " at ", $time ?></h3>
            </div>

            <div class="iframe-container">
                <iframe src=<?php echo convertToEmbedLink($result[0]['link']) ?> allowfullscreen></iframe>;
            </div>

            <div id="audio-container">
                <h2>Audio</h2>
                <div>
                    <audio controls>
                        <source src="<?php echo $audio ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>

            <div id="pdf-container">
                <h2>Notes</h2>
                <canvas id="pdf-render"></canvas>

                <!-- <button id="fullscreen-btn">Fullscreen</button> -->
                <a id="download-btn" href="<?php echo $file ?>" download>Download PDF</a>

                <div id="navigation">
                    <button id="prev-page">&#8592; Previous</button>
                    <span id="page-num"></span> / <span id="page-count"></span>
                    <button id="next-page">Next &#8594;</button>
                </div>
            </div>
        </section>

        <footer>
            <?php include 'footer.php'; ?>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const url = "<?php echo $file; ?>";
                let pdfDoc = null,
                    pageNum = 1,
                    pageIsRendering = false,
                    pageNumIsPending = null;

                const scale = 1.5,
                    canvas = document.querySelector("#pdf-render"),
                    ctx = canvas.getContext("2d");

                const renderPage = num => {
                    pageIsRendering = true;

                    pdfDoc.getPage(num).then(page => {
                        const viewport = page.getViewport({
                            scale
                        });
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        const renderCtx = {
                            canvasContext: ctx,
                            viewport
                        };

                        page.render(renderCtx).promise.then(() => {
                            pageIsRendering = false;

                            if (pageNumIsPending !== null) {
                                renderPage(pageNumIsPending);
                                pageNumIsPending = null;
                            }
                        });

                        document.querySelector("#page-num").textContent = num;
                    });
                };

                const queueRenderPage = num => {
                    if (pageIsRendering) {
                        pageNumIsPending = num;
                    } else {
                        renderPage(num);
                    }
                };

                document.querySelector("#prev-page").addEventListener("click", () => {
                    if (pageNum <= 1) {
                        return;
                    }
                    pageNum--;
                    queueRenderPage(pageNum);
                });

                document.querySelector("#next-page").addEventListener("click", () => {
                    if (pageNum >= pdfDoc.numPages) {
                        return;
                    }
                    pageNum++;
                    queueRenderPage(pageNum);
                });

                pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
                    pdfDoc = pdfDoc_;
                    document.querySelector("#page-count").textContent = pdfDoc.numPages;

                    renderPage(pageNum);
                });

                const pdfContainer = document.querySelector("#pdf-container");

                document.querySelector("#fullscreen-btn").addEventListener("click", () => {
                    if (pdfContainer.requestFullscreen) {
                        pdfContainer.requestFullscreen();
                    } else if (pdfContainer.webkitRequestFullscreen) {
                        pdfContainer.webkitRequestFullscreen();
                    } else if (pdfContainer.msRequestFullscreen) {
                        pdfContainer.msRequestFullscreen();
                    } else if (pdfContainer.mozRequestFullScreen) {
                        pdfContainer.mozRequestFullScreen();
                    }
                });

                // Exit fullscreen on mobile when the user navigates away
                document.addEventListener("fullscreenchange", function() {
                    if (!document.fullscreenElement) {
                        pdfContainer.style.width = "100%";
                    }
                });
                document.addEventListener("webkitfullscreenchange", function() {
                    if (!document.webkitFullscreenElement) {
                        pdfContainer.style.width = "100%";
                    }
                });
                document.addEventListener("mozfullscreenchange", function() {
                    if (!document.mozFullScreenElement) {
                        pdfContainer.style.width = "100%";
                    }
                });
                document.addEventListener("MSFullscreenChange", function() {
                    if (!document.msFullscreenElement) {
                        pdfContainer.style.width = "100%";
                    }
                });
            });
        </script>
    </body>

</html>