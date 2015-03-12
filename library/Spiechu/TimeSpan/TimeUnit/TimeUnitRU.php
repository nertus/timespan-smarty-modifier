<?php

/*
 * This file is part of the TimeSpan package.
 *
 * (c) Alex Pshenichnik <belylis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spiechu\TimeSpan\TimeUnit;

class TimeUnitRU extends AbstractTimeUnit
{

    protected $_units = array(
        -1 => array('s' => 'прямо сейчас'),
        0 => array('i' => 'пол минуты',
            'h' => 'пол часа',
            'd' => 'пол дня',
            'm' => 'пол месяца',
            'y' => 'пол года'),
        1 => array('s' => 'секунда',
            'i' => 'минута',
            'h' => 'час',
            'd' => 'день',
            'm' => 'месяц',
            'y' => 'год'),
        2 => array('s' => 'секунды',
            'i' => 'минуты',
            'h' => 'часа',
            'd' => 'дня',
            'm' => 'месяца',
            'y' => 'года'),
        5 => array('s' => 'секунд',
            'i' => 'минут',
            'h' => 'часов',
            'd' => 'дней',
            'm' => 'месяцев',
            'y' => 'лет')
    );

    public function getUnitString()
    {
        $cases = array(5, 1, 2, 2, 2, 5);
        $howMany = ($this->_unitCount % 100 > 4 && $this->_unitCount % 100 < 20) ? 5 : $cases[min($this->_unitCount % 10, 5)];

        return $this->_units[$howMany][$this->_unitType];
    }

    public function getPrefix()
    {
        return 'примерно';
    }

    public function getHalf()
    {
        return 'с половиной';
    }

    public function getConjunctionWord()
    {
        return 'и';
    }

    public function getSuffix()
    {
        return 'назад';
    }

}
