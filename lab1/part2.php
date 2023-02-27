<?php
header("Content-Type: text/plain");


function print_alphabet() {
    echo "Part 2, subtask1\n";
    $letters = ["a", "ā", "b", "c", "č", "d", "e", "ē", "f", "g", "ģ", "h", "i", "ī", "j", "k", "ķ", "l", "ļ", "m", "n", "ņ", "o", "p", "r", "s", "š","t","u","ū","v","z","ž"];

    $string= "";
    foreach ($letters as $letter) {
        $string .= $letter;
        echo "{$string}\n";
    }
}

function get_first_monday($year) {
    for ($day=1; $day<=7 ;$day++){
        $date = mktime(0, 0, 0, 1, $day, $year);
        if (date("D", $date) === "Mon")
            return $date;
    }
}

function ordinal($number) {
    $ends = ["th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th"];
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number . "th";
    else
        return $number . $ends[$number % 10];
}

print_alphabet();
echo "\n";

assert_options(date("d-m-Y", get_first_monday(2023))=="02-01-2023");
assert_options(date("d-m-Y", get_first_monday(2022))=="03-01-2022");
assert_options(date("d-m-Y", get_first_monday(2021))=="04-01-2021");
echo date("d-m-Y", get_first_monday(2023))."\n";
echo date("d-m-Y", get_first_monday(2022))."\n";
echo date("d-m-Y", get_first_monday(2021))."\n";
echo "\n";

$years = [2023,2030,2016,2017];
foreach ($years as $year) {
    $date = ordinal((int)date("d", get_first_monday($year)));
    echo "The first Monday of year {$year} is {$date} January\n";
}

?>   

