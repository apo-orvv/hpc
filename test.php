<?php

function info($startDate, $endDate) {
    // Create DateTime objects from the input dates
    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);

    // Calculate the difference between the twoZ dates
    $interval = $startDateTime->diff($endDateTime);

    // Access the "days" property from the interval
    $hrdiff = ($interval->days)*24;

    // Return the number of days
    return $hrdiff;
}

$startDate = '0000-00-00';
$endDate = '2023-09-12';

$result = info($startDate, $endDate);
echo "Number of days between $startDate and $endDate: $result";

