<?php

namespace App\Traits;

trait Conversor {

    protected function fromDecimalDegreesToDegreesWithMinutesAndSeconds($number = 0) {
        $result = [];
        if ($number < 0) {
            $number *= -1;
        }
        $integerNumber = (int) $number;
        $result['degrees'] = $integerNumber;
        $decimalNumber = $number - $integerNumber;
        $minutesWithDecimal = $decimalNumber * 60;
        $integerMinutes = (int) $minutesWithDecimal;
        $result['minutes'] = $integerMinutes;
        $decimalMinutes = $minutesWithDecimal - $integerMinutes;
        $secondsWithDecimal = $decimalMinutes * 60;
        $result['seconds'] = round($secondsWithDecimal, 1);
        return $result;
    }

    protected function determineGeographicCoordinate($degrees = 0, $coordenate = 'latitude') {
        $result = '';
        if ($coordenate === 'latitude') {
            if ($degrees < 0) {
                $result = 'S';
            } else {
                $result = 'N';
            }
        }
        if ($coordenate === 'longitude') {
            if ($degrees < 0) {
                $result = 'W';
            } else {
                $result = 'E';
            }
        }
        return $result;
    }
}