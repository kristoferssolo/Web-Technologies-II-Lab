<?php
header("Content-Type: text/plain");
$start = (int)$_GET["start"];
$end = (int)$_GET["end"];


if (!is_int($start) || !is_int($end)) {
    echo "Error. Both values should be numbers.";
    return;
}


if ($start > $end) {
    echo "Error. Start number should be smaller that end number.";
    return;
}


if ($start < 0 || $end < 0) {
    echo "Error. Both numbers should be positive.";
    return;
}


function getFirstMonday($year)
{
    for ($day=1; $day<=7; $day++) {
        $date = mktime(0, 0, 0, 1, $day, $year);
        if (date("D", $date) === "Mon") {
            return $date;
        }
    }
}


for ($year = $start; $year <= $end; $year++) {
    echo date("d-m-Y", getFirstMonday($year))."\n";
}

?>
