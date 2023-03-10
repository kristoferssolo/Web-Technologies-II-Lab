<?php
header("Content-Type: text/plain");


function printAlphabet()
{
    echo "Part 2, subtask1\n";
    $letters = ["a", "ā", "b", "c", "č", "d", "e", "ē", "f", "g", "ģ", "h",
        "i", "ī", "j", "k", "ķ","l", "ļ", "m", "n", "ņ", "o", "p", "r", "s",
        "š", "t", "u", "ū", "v", "z", "ž"];

    $string= "";
    foreach ($letters as $letter) {
        $string .= $letter;
        echo "{$string}\n";
    }
}


function getFirstMonday($year)
{
    for ($day = 1; $day <= 7; $day++) {
        $date = mktime(0, 0, 0, 1, $day, $year);
        if (date("D", $date) === "Mon") {
            return $date;
        }
    }
}


function ordinal($number)
{
    if ($number == 1) {
        return $number . "st";
    } else if ($number == 2) {
        return $number . "nd";
    } else if ($number == 3) {
        return $number . "rd";
    } else {
        return $number . "th";
    }
}

printAlphabet();
echo "\n";

assert_options(date("d-m-Y", getFirstMonday(2023))=="02-01-2023");
assert_options(date("d-m-Y", getFirstMonday(2022))=="03-01-2022");
assert_options(date("d-m-Y", getFirstMonday(2021))=="04-01-2021");
echo date("d-m-Y", getFirstMonday(2023))."\n";
echo date("d-m-Y", getFirstMonday(2022))."\n";
echo date("d-m-Y", getFirstMonday(2021))."\n";
echo "\n";

$years = [2023, 2030, 2016, 2017];
foreach ($years as $year) {
    $date = ordinal((int)date("d", getFirstMonday($year)));
    echo "The first Monday of year {$year} is {$date} January\n";
}

?>
