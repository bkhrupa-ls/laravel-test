<?php

if (!function_exists('toMoney')) {
    function toMoney($money): \Cknow\Money\Money
    {
        return money(($money * 100));
    }
}
