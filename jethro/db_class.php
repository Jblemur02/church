<?php

class sql_class
{
    static $db = null;
    static $stmt = array();

    function __construct()
    {
        self::$db = new PDO(
            "mysql:host=localhost;dbname=jethro",
            "jethro",
            "J3thr)24",
            array(
                PDO::MYSQL_ATTR_FOUND_ROWS => true
            )
        );
    }

    function id()
    {
        return self::$db->lastInsertId();
    }

    function execute($param)
    {
        $input = array('sql' => $param, 'sql_param' => array(), 'php_param' => array()); // Initialize arrays

        if (true || !isset($input['statement'])) {
            $input['statement'] = array();
            preg_match("/(\w+)/", $input['sql'], $matches);
            $input['statement']['is_dml'] = !(count($matches) > 0 && strtoupper($matches[0]) == "SELECT");
            $input['statement']['sql'] = self::$db->prepare($input['sql'], array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE));

            // Ensure $input['sql_param'] is an array before iterating
            if (is_array($input['sql_param'])) {
                foreach ($input['sql_param'] as $v) {
                    $input['statement']['sql']->bindParam(":$v", $input['statement']['sql_param'][$v]);
                }
            }
            unset($input['sql']);
        }

        // Ensure $input['sql_param'] is an array before iterating
        if (is_array($input['sql_param'])) {
            foreach ($input['sql_param'] as $v) {
                $input['statement']['sql_param'][$v] = (isset($input['php_param'][$v]) && $input['php_param'][$v] !== "" ? $input['php_param'][$v] : null);
            }
        }
        unset($input['php_param']);

        $input['statement']['sql']->execute();
        return $input['statement']['is_dml'] ? $input['statement']['sql']->rowCount() : $input['statement']['sql']->fetchAll(PDO::FETCH_ASSOC);
    }
}



function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function convertToEmbedLink($normalLink)
{
    // Check if the provided link is a valid YouTube watch link
    if (strpos($normalLink, 'youtube.com/watch?v=') !== false) {
        // Extract the video ID from the link
        $videoID = substr($normalLink, strpos($normalLink, 'v=') + 2);
        // Build and return the embed link
        return 'https://www.youtube.com/embed/' . $videoID;
    } else {
        // If the link is not a valid YouTube watch link, return the original link
        return $normalLink;
    }
}

// Function to display the calendar

function displayCalendar($page)
{
    // Get the current month and year
    $month = isset($_GET['month']) ? $_GET['month'] : date('n');
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

    // Calculate previous and next month and year
    $prevMonth = $month == 1 ? 12 : $month - 1;
    $prevYear = $month == 1 ? $year - 1 : $year;
    $nextMonth = $month == 12 ? 1 : $month + 1;
    $nextYear = $month == 12 ? $year + 1 : $year;

    // Calculate the number of days in the current month
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Calculate the first day of the current month
    $firstDayOfWeek = date('N', strtotime("$year-$month-01"));

    // Output the calendar navigation and table
    echo '<div id="calbut">';
    echo '<a class="prev-next" href="?month=' . $prevMonth . '&year=' . $prevYear . '"><<</a>';

    // Split the month and year
    $currentMonth = date('F', strtotime("$year-$month-01"));
    $currentYear = date('Y', strtotime("$year-$month-01"));
    echo '<div id="mon-year">';
    echo '<p id="month">' . $currentMonth . '</p> ';
    echo '<p id="year">' . $currentYear . '</p>';
    echo '</div>';

    echo '<a class="prev-next" href="?month=' . $nextMonth . '&year=' . $nextYear . '">>></a>';
    echo '</div>';

    echo '<table>';
    echo '<thead>';

    // Output the table structure
    echo '<tr>';
    echo '<th style="width:14.285%">Sun</th>';
    echo '<th style="width:14.285%">Mon</th>';
    echo '<th style="width:14.285%">Tue</th>';
    echo '<th style="width:14.285%">Wed</th>';
    echo '<th style="width:14.285%">Thu</th>';
    echo '<th style="width:14.285%">Fri</th>';
    echo '<th style="width:14.285%">Sat</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Output the days of the month
    echo '<tr>';

    // Output empty cells at the beginning of the month
    for ($i = 1; $i < $firstDayOfWeek; $i++) {
        echo '<td></td>';
    }

    // Output the day numbers and IDs
    for ($day = 1; $day <= $numDays; $day++) {
        // Generate a unique ID for each day based on the date (YYYY-MM-DD)
        $dayId = date('Y-m-d', strtotime("$year-$month-$day"));

        echo '<a><td id="' . $dayId . '">'; // Output unique ID for the day
        echo $day; // Output the day number

        echo "<div class='event'>";
        $db = new sql_class();
        $events = $db->execute("SELECT * FROM events");
        // Check if there's an event for this day
        foreach ($events as $event) {
            if ($event['date'] == $dayId) {
                echo "<div class='eventlinks'>";
                echo "<br><a href='" . $page . ".php?id=" . $event['id'] . "'>";
                echo $event['title'] . '</a>';
                echo "</div>";
            }
        }
        echo "</div>";

        echo '</td></a>';

        if (($day + $firstDayOfWeek - 1) % 7 == 0) {
            echo '</tr><tr>'; // Start a new row for each week
        }
    }

    // Calculate the number of empty cells at the end of the month
    $lastRowCells = ($numDays + $firstDayOfWeek - 1) % 7;
    $emptyCells = 7 - $lastRowCells;

    if ($emptyCells < 7) {
        for ($i = 0; $i < $emptyCells; $i++) {
            echo '<td></td>'; // Output empty cells for days after the last day of the month
        }
    }

    echo '</tr>';

    echo '</tbody>';
    echo '</table>';
}

function cleanUpDate($dirtydate)
{
    $tempdate = $dirtydate;
    $datetime = new DateTime($tempdate);
    $date = $datetime->format("F j, Y");
    return $date;
}

function cleanUptime($dirtytime)
{
    $temptime = $dirtytime;
    $datetime = new DateTime($temptime);
    $time = $datetime->format("g:i a");
    return $time;
}
function ccw($numColumns)
{
    $columnWidth = 100 / $numColumns;
    return $columnWidth . '%';
}
