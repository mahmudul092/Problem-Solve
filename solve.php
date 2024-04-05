<!DOCTYPE html>
<html>
<head>
    <title>Working Days Calculator</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Working Days Calculator</h2>

    <form method="post">
        Start Date: <input type="date" name="start_date"><br><br>
        End Date: <input type="date" name="end_date"><br><br>
        <input type="submit" name="submit" value="Calculate">
    </form>

    <?php
    function isWeekday($date) {
        // Format: Monday is 1 and Sunday is 7
        return (date('N', strtotime($date)) <= 5);
    }

    function isHoliday($date) {
        // Add your government holidays here
        $governmentHolidays = [
            '2024-04-06',  // Example holiday
            // Add more holidays as needed
        ];
        return in_array($date, $governmentHolidays);
    }

    function workingDaysBetweenDates($startDate, $endDate) {
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        $workingDays = 0;

        while ($currentDate <= $endDate) {
            if (isWeekday(date('Y-m-d', $currentDate)) && !isHoliday(date('Y-m-d', $currentDate))) {
                $workingDays++;
            }
            $currentDate = strtotime('+1 day', $currentDate);
        }

        return $workingDays;
    }

    if(isset($_POST['submit'])) {
        $date1 = $_POST['start_date'];  // Start date
        $date2 = $_POST['end_date'];  // End date

        $totalWorkingDays = workingDaysBetweenDates($date1, $date2);
        echo "<p>Total $totalWorkingDays working days in this period.</p>";
    }
    ?>

</div>

</body>
</html>
