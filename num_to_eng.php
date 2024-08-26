<?php
// num_to_eng.php

function convert_to_words($number)
{
    $units = [
        '',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine'
    ];
    $teens = [
        'ten',
        'eleven',
        'twelve',
        'thirteen',
        'fourteen',
        'fifteen',
        'sixteen',
        'seventeen',
        'eighteen',
        'nineteen'
    ];
    $tens = [
        '',
        '',
        'twenty',
        'thirty',
        'forty',
        'fifty',
        'sixty',
        'seventy',
        'eighty',
        'ninety'
    ];

    if ($number == 0) {
        return 'zero';
    }

    $thousands = intval($number / 1000);
    $hundreds = intval(($number % 1000) / 100);
    $remainder = $number % 100;

    $words = '';

    // Handle thousands
    if ($thousands > 0) {
        $words .= $units[$thousands] . ' thousand';
        if ($thousands > 1) {
            $words .= 's';
        }
        $words .= ', ';
    }

    // Handle hundreds
    if ($hundreds > 0) {
        $words .= $units[$hundreds] . ' hundred';
        if ($hundreds > 1) {
            $words .= 's';
        }
        if ($remainder > 0) {
            $words .= ' and ';
        }
    }

    // Handle remainder
    if ($remainder > 0) {
        if ($remainder < 10) {
            $words .= $units[$remainder];
        } elseif ($remainder < 20) {
            $words .= $teens[$remainder - 10];
        } else {
            $words .= $tens[intval($remainder / 10)];
            if ($remainder % 10 > 0) {
                $words .= '-' . $units[$remainder % 10];
            }
        }
    }

    return $words;
}

// check correct number of arguments
if ($argc != 2) {
    echo "Usage: php num_to_eng.php <number>\n";
    exit(1);
}

// get second argument
$number = intval($argv[1]);

if ($number < 0 || $number >= 10000) {
    echo "Error: Number must be between 0 and 9999.\n";
    exit(1);
}

echo convert_to_words($number) . "\n";