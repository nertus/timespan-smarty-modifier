<?php

namespace Spiechu\TimeSpan;

class TimeSpanEN extends TimeSpan {

    protected function getUnit($howMany, $unitSymbol) {
        if ($howMany > 1)
            $howMany = 2;

        $units = array(
            -1 => array('s' => 'just now'),
            1 => array('s' => 'a second',
                'i' => 'a minute',
                'h' => 'an hour',
                'd' => 'a day',
                'm' => 'a month',
                'y' => 'a year'),
            2 => array('s' => 'seconds',
                'i' => 'minutes',
                'h' => 'hours',
                'd' => 'days',
                'm' => 'months',
                'y' => 'years')
        );
        return $units[$howMany][$unitSymbol];
    }

    protected function getSuffix() {
        return 'ago';
    }

}