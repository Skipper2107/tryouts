<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 2/4/17
 * Time: 12:21 PM
 */

namespace App\Evklid;


class Evklid
{
    /**
     * @param $a
     * @param $b
     * @return mixed
     */
    public static function gcd($a, $b)
    {
        if ($b == 0) {
            return $a;
        }
        return static::gcd($b, $a % $b);
    }
}