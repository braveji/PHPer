<?php

function py2Round($value) {
    $res =  floor(abs($value) + 0.5) * ($value > 0 ? 1 : -1);
    return $res;
}

/**
 * Encodes the given [latitude, longitude] coordinates array.
 *
 * @param {Array.<Array.<Number>>} coordinates
 * @param {Number} precision
 * @return string
 */
function  encode($coordinates) {
    if (! count($coordinates)) {
        return '';
    }

    $factor = 100000;
    $output = ployEncode($coordinates[0][0], 0, $factor)  .  ployEncode($coordinates[0][1], 0, $factor);

    for($i =1; $i < count($coordinates) ; $i++){
       $a = $coordinates[$i];
       $b = $coordinates[$i-1];
       $output .= ployEncode($a[0], $b[0], $factor);
       $output .= ployEncode($a[1], $b[1], $factor);
    }

    return $output;
};


function ployEncode($current, $previous, $factor) {
    $current = py2_round($current * $factor);
    $previous = py2_round($previous * $factor);
    $coordinate = $current - $previous;
    $coordinate <<= 1;
    if ($current - $previous < 0) {
        $coordinate = ~$coordinate;
    }
    $output = '';
    while ($coordinate >= 0x20) {
        $output .= chr((0x20 | ($coordinate & 0x1f)) + 63);
        $coordinate >>= 5;
    }
    $output .= chr($coordinate + 63);
    return $output;
}


echo  encode(array(array(38.5, -120.2),array(40.7, -120.95),array(43.252, -126.453))) ;
echo "\n";

