<?php
header("Content-Type: text/plain");


function print_alphabet() {
    $SEPARATOR = "\n";
    echo "Part 2, subtask1{$SEPARATOR}";
    $letters = ["a", "ā", "b", "c", "č", "d", "e", "ē", "f", "g", "ģ", "h", "i", "ī", "j", "k", "ķ", "l", "ļ", "m", "n", "ņ", "o", "p", "r", "s", "š","t","u","ū","v","z","ž"];

    $string= "";
    foreach ($letters as $letter) {
        $string .= $letter;
        echo "{$string}{$SEPARATOR}";
    }
}

function get_first_monday($year) {
    return $year;
}

print_alphabet();

echo get_first_monday(2023);


?>

