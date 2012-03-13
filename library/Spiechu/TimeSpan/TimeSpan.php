<?php

namespace Spiechu\TimeSpan;

abstract class TimeSpan {

    /**
     * @var int seconds to show 'just now' instead of exact units 
     */
    protected $_justNow = 10;

    /**
     * @var bool show 'ago' suffix in return string 
     */
    protected $_showSuffix = true;

    /**
     * @var DateTime|null DateTime from which we measure DateInterval from now
     */
    protected $_startDate = null;

    /**
     * Returns proper time unit string according to number of units.
     * 
     * @param int $howMany -1 means 'just now' unit
     * @param string $unitSymbol it can be s,i,h,d,m,y
     * @return string
     */
    abstract protected function getUnit($howMany, $unitSymbol);

    /**
     * Returns translated 'ago' string.
     * 
     * @return string
     */
    abstract protected function getSuffix();

    /**
     * @param bool $suffix 
     */
    public function showSuffix($suffix) {
        $this->_showSuffix = $suffix;
        return $this;
    }

    public function setStartDate(\DateTime $startDate) {
        $this->_startDate = $startDate;
        return $this;
    }

    /**
     * Returns translated string.
     * 
     * @return string
     */
    public function getTimeSpan() {
        $interval = $this->getInterval();
        $timeUnit = $this->getUnit($interval['counter'], $interval['unit']);

        $suffix = ($this->_showSuffix) ? ' ' . $this->getSuffix() : '';

        if ($interval['counter'] > 1) {
            return $interval['counter'] . ' ' . $timeUnit . $suffix;
        } elseif ($interval['counter'] == 1) {
            // in case we don't have to show number of units
            return $timeUnit . $suffix;
        } else {
            // in case of -1 'just now' offset
            return $timeUnit;
        }
    }

    protected function getInterval() {
        $curDate = new \DateTime('now');
        $diff = $curDate->diff($this->_startDate);
        if ($diff->y > 0) {
            $unit = 'y';
            $counter = $diff->y;
        } elseif ($diff->m > 0) {
            $unit = 'm';
            $counter = $diff->m;
        } elseif ($diff->d > 0) {
            $unit = 'd';
            $counter = $diff->d;
        } elseif ($diff->h > 0) {
            $unit = 'h';
            $counter = $diff->h;
        } elseif ($diff->i > 0) {
            $unit = 'i';
            $counter = $diff->i;
        } elseif ($diff->s > 0) {
            $unit = 's';
            $counter = ($diff->s > $this->_justNow) ? $diff->s : -1;
        }
        else {
            throw new TimeSpanException('Invalid DateInterval');
        }

        return array('counter' => $counter, 'unit' => $unit);
    }

}